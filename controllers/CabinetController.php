<?php
namespace controllers;
use core\Controller;
use models\User_model;
use models\Order_model;

class CabinetController extends Controller {

private $formParams =[];
private $remember = false;
private $errorFlag = true;

public function indexAction() {
$tpl = 'layouts/mainAuthorized_tpl .php';
$model = '';
$var = '';
$this->view->render('Кабинет', $model, $var, $tpl);   
 }

/******************************************************/
public function editAction() {
$this->formParams['name'] = '';
$this->formParams['email'] = '';
$this->formParams['nameError'] = '';
$this->formParams['emailError'] = '';
$this->formParams['passwordErrorMatch'] = '';
$this->formParams['passwordErrorLength'] = '';
$this->formParams['regSuccessfully'] = '';
// заносим данные в форму
$userId = $_SESSION['id'];
$user = User_model::getUserById($userId);
$this->formParams['name'] = $user['name'];
$this->formParams['email'] = $user['email'];

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
                    // Изменение личных данных
    if($this->errorFlag) {
    $userData['name'] = $this->formParams['name'];
    $userData['email'] = $this->formParams['email'];
    $userData['password'] = $_POST['password1'];
    $userData['remember'] = $this->remember;
    $userData['userId'] = $userId;
    $this->formParams['regSuccessfully'] = User_model::updateUser($userData);   
    }
} // if( isset($_POST['submit-reg']) )

if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Личные данные', '', $this->formParams, $tpl);
} // public function editAction() 

/******************************************************/
public function historyAction() {
$userId = $_SESSION['id'];
$model = Order_model::getHistoryOrders($userId);

$tpl = 'layouts/mainAuthorized_tpl .php';
$this->view->render('История покупок', $model, '', $tpl);


} //public function historyAction()

} // конец класса