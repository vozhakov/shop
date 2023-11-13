<?php
namespace controllers;
use core\Controller;
use models\User_model;

class UserController extends Controller {

 	private $formParams =[];
    private $remember = false;
    private $errorFlag = true;

public function registerAction() {
$this->formParams['name'] = '';
$this->formParams['email'] = '';
$this->formParams['nameError'] = '';
$this->formParams['emailError'] = '';
$this->formParams['passwordErrorMatch'] = '';
$this->formParams['passwordErrorLength'] = '';
$this->formParams['regSuccessfully'] = '';

if( isset($_POST['submit-reg']) ) {
	//Получаем данные из формы
	$resultCheck =User_model::checkName($_POST['name']);
if( !empty( $resultCheck ) ) {
$this->formParams['name'] = $resultCheck;
 }
 else{
 $this->formParams['nameError'] = 'Логин должен быть не менее 2-х символов';
 $this->errorFlag = false;
}

if( !empty( User_model::checkEmail($_POST['email']) ) ) {
$this->formParams['email'] = User_model::checkEmail($_POST['email']);
 }
 else{
 $this->formParams['emailError'] = 'Не правильный email';
 $this->errorFlag = false;
}

if($_POST['password1'] != $_POST['password2']) {
$this->formParams['passwordErrorMatch'] = 'Не совпадают пароли';   
 $this->errorFlag = false;
}
 if ( mb_strlen($_POST['password1'] ) < 2 or  mb_strlen($_POST['password2']) < 2 ) {
 $this->formParams['passwordErrorLength'] = 'Пароль должен быть не менее двух символов';
 $this->errorFlag = false;	
 }	 

if( isset($_POST['remember']) and $_POST['remember'] == '1') {
 $this->remember = true;
}

                    // регистрация
if($this->errorFlag) {
	$userData['name'] = $this->formParams['name'];
    $userData['email'] = $this->formParams['email'];
    $userData['password'] = $_POST['password1'];
    $userData['remember'] = $this->remember;
$this->formParams['regSuccessfully'] = User_model::registerUser($userData);   
}
 
} // if( isset($_POST['submit-reg']) )

if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Регистрация', '', $this->formParams, $tpl);
		
} // registerAction()

public function logoutAction() {
    //Если переменная auth из сессии не пуста и равна true 
    if (!empty($_SESSION['auth']) and $_SESSION['auth']) {
        session_destroy(); //разрушаем сессию для пользователя

        //Удаляем куки авторизации путем установления времени их жизни на текущий момент:
        setcookie('email', '', time()); //удаляем логин
        setcookie('key', '', time()); //удаляем ключ
        header('Location: /');
    }
}

public function loginAction() {

$this->formParams['userOK'] = '';
$this->formParams['passwordErrorLength'] = '';
$this->formParams['email'] = '';
$this->formParams['emailError'] = '';


if( isset($_POST['submit-log']) )  {

// Проверка: забанен или нет
       $email =  $_POST['email']; 
       $ban = User_model::checkBan($email); 
       if($ban) die('Доступ запрещен. Вы забанены');

    if ( mb_strlen($_POST['password']) < 2) {
    $this->formParams['passwordErrorLength'] = 'Пароль должен быть не менее двух символов';
    $this->errorFlag = false;  
    }   

    if( !empty( User_model::checkEmail($_POST['email']) ) ) {
    $this->formParams['email'] = User_model::checkEmail($_POST['email']);
    }
    else{
    $this->formParams['emailError'] = 'Не правильный email';
    $this->errorFlag = false;
        }

    if($this->errorFlag) {
           // Проверяем существует ли пользователь 
       $userData = User_model::checkUserData( $this->formParams['email'], $_POST['password']);

       if(!empty($userData))header("Location: /");
       else $this->formParams['userOK'] = 'Не совпал логин или пароль';
      }
 }  // if( isset($_POST['submit-log']) )         

if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Вход', '',$this->formParams, $tpl);   
}

} // конец класса

