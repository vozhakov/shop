<?php
namespace models;

class User_model {

const ITEMS_PER_PAGE = 10; // количество пользователей на страницу
public static $countItems; // количество всех пользователей в БД 

public static function auth() {
    if ($_SESSION['auth'] == false) {
    global $conn;
        // запрашиваем куки в браузере
        if ( !empty($_COOKIE['email']) and !empty($_COOKIE['key']) ) {
        //Пишем логин и ключ из КУК в переменныедля удобства работы
        $email = $_COOKIE['email']; 
        $key =     $_COOKIE['key']; //ключ из кук
        $key1 = mysqli_real_escape_string($conn, $key);
        $query = "SELECT * FROM users WHERE email='$email' AND rendKey='$key1'";
        $user = mysqli_fetch_assoc(mysqli_query($conn, $query));
        if (!empty($user)) {
            //Пишем в сессию информацию о том, что мы авторизовались:
            $_SESSION['auth'] = true; 
            $_SESSION['id'] = $user['id']; 
            $_SESSION['login'] = $user['name']; 
            }
        }
    }
}

public static function checkName($name) {
global $conn;
$name1 = htmlspecialchars( mysqli_real_escape_string($conn, $name) );
    if (mb_strlen($name1) >= 2) return $name1;
return false;
}

public static function checkEmail($email) {
global $conn;
$email1 = htmlspecialchars( mysqli_real_escape_string($conn, $email) );
     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
     }
return false;
}

/***********************************************************************/
// регистрация
public static function registerUser($data) {
global $conn;    
extract($data); // $name, $email, $password, $remember
$password = password_hash($password, PASSWORD_DEFAULT); 
$password = mysqli_real_escape_string($conn, $password); 
$sql = "SELECT * FROM users WHERE email='$email'";
$user = mysqli_fetch_assoc(mysqli_query($conn, $sql));


if( empty($user) ) { // email свободен
$query = "INSERT INTO `users` SET `name`='$name', `password`='$password', `email`='$email'";
$res = mysqli_query($conn, $query);
$reg_successfully = 'Вы успешно зарегистрированы!';
$_SESSION['auth'] = true; // пометка об авторизации
$_SESSION['login'] = $name;
$id = mysqli_insert_id($conn);
$_SESSION['id'] = $id; // пишем id пользователя в сессию

    //Проверяем, что была нажата галочка 'Запомнить меня':
    if($remember) {
    $random_str = self::vva_random(8); // случайная строка
    //Пишем куки (имя куки, значение, время жизни - сейчас+месяц)
            setcookie('email',$email, time()+60*60*24*30); 
            setcookie('key', $random_str, time()+60*60*24*30);
            $random_str = mysqli_real_escape_string($conn, $random_str);
            $query = "UPDATE users SET rendKey='$random_str' WHERE email='$email'";
         mysqli_query($conn, $query);
    } 
} // if( empty($user) )
else $reg_successfully = '<span class="error">Email занят!</span>';

return $reg_successfully;
} // function registerUser($data)

/***********************************************************************/
// Проверка наличия записи в базе при авторизации
public static function checkUserData($email, $password) {
global $conn;
$query = "SELECT * FROM users WHERE email='$email'";
$user = mysqli_fetch_assoc(mysqli_query($conn, $query)); //возвращает NULL или массив с данными  

if (!empty($user)) {
    $hash = $user['password'];
    if ( password_verify($password, $hash) ){
    //Пишем в сессию информацию о том, что мы авторизовались:
    $_SESSION['auth'] = true; 
    $_SESSION['id'] = $user['id']; 
    $_SESSION['login'] = $user['name'];
   $userData = $user;

        if ( !empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1 )  $remember = true;
            else $remember = false;
 
        if($remember) {
        $random_str = self::vva_random(8); // случайная строка
        //Пишем куки (имя куки, значение, время жизни - сейчас+месяц)
            setcookie('email',$email, time()+60*60*24*30); 
            setcookie('key', $random_str, time()+60*60*24*30);
            $random_str = mysqli_real_escape_string($conn, $random_str);
            $query = "UPDATE users SET rendKey='$random_str' WHERE email='$email'";
         mysqli_query($conn, $query);
        } 

    } else $userData = false;
} else $userData = false;
return $userData;
}

public static function getUserById($id) {
global $conn;
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
return $result;
}

/***********************************************************************/
// Обновление личных данных
public static function updateUser($data) {
global $conn;    
extract($data); // $name, $email, $password, $remember, $userId
$password = password_hash($password, PASSWORD_DEFAULT); 
$password = mysqli_real_escape_string($conn, $password); 
$sql = "SELECT * FROM users WHERE email='$email'";
$user = mysqli_fetch_assoc(mysqli_query($conn, $sql));

if( empty($user) ) { // email свободен
$query = "UPDATE `users` SET `name`='$name', `password`='$password', `email`='$email' WHERE `id`=$userId";
$res = mysqli_query($conn, $query);
$reg_successfully = 'Личные данные обновлены!';
$_SESSION['auth'] = true; // пометка об авторизации
$_SESSION['login'] = $name;

    //Проверяем, что была нажата галочка 'Запомнить меня':
    if($remember) {
    $random_str = self::vva_random(8); // случайная строка
    //Пишем куки (имя куки, значение, время жизни - сейчас+месяц)
            setcookie('email',$email, time()+60*60*24*30); 
            setcookie('key', $random_str, time()+60*60*24*30);
            $random_str = mysqli_real_escape_string($conn, $random_str);
            $query = "UPDATE users SET rendKey='$random_str' WHERE email='$email'";
         mysqli_query($conn, $query);
    } 
} // if( empty($user) )
else $reg_successfully = '<span class="error">Email занят!</span>';

return $reg_successfully;
} // function updateUser($data)

/**************************************************************/
// Получение списка всех пользователей кроме администатора с пагинацией
public static function getUsersList($id) {
global $conn;
$sql = "SELECT COUNT(id) AS count FROM users";
$result = mysqli_query($conn, $sql);
$arr = mysqli_fetch_assoc($result);
self::$countItems = $arr['count'];

// получение из БД  пользователей с учетом пагинации без текущего администратора
$numberOfPages=ceil(self::$countItems/self::ITEMS_PER_PAGE);
$paginPage = 1;

if( isset ($_GET['pagin']) ) {
    if( $_GET['pagin']>1 && $_GET['pagin']<=$numberOfPages) {  
    $paginPage = $_GET['pagin'];// текущая страница пагинации из GET параметров
    }
}

$start = self::ITEMS_PER_PAGE*($paginPage-1);
$numberRows = self::ITEMS_PER_PAGE;
$sql = "SELECT id, name, email, role, ban FROM users WHERE id!=$id ORDER BY id ASC LIMIT $start, $numberRows;";
$result = mysqli_query($conn, $sql);
    $items = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $items[] = $row;
    }
    return $items;
}

/*****************************/
// забанить
public static function userDisable($banId) {
global $conn;
$sql = "UPDATE users SET ban='да' WHERE id=$banId";
mysqli_query($conn, $sql);
}
// paзбанить
public static function userEnable($banId) {
global $conn;
$sql = "UPDATE users SET ban='нет' WHERE id=$banId";
mysqli_query($conn, $sql);
}
// убрать администратора
public static function adminDisable($controlAdminId) {
global $conn;
$sql = "UPDATE users SET role='user' WHERE id=$controlAdminId";
mysqli_query($conn, $sql);
}
// назначить администратором
public static function adminEnable($controlAdminId) {
global $conn;
$sql = "UPDATE users SET role='admin' WHERE id=$controlAdminId";
mysqli_query($conn, $sql);
}

 // Проверка: забанен или нет пользователь с данным email
public static function checkBan($email) {
global $conn;
$sql = "SELECT ban FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$baned = mysqli_fetch_assoc($result);
if($baned['ban'] == 'да') return true;
else return false;
}

/*************************************************************/ 
private static function vva_random($length = 6) {               
$chars = '!=?&-+qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
$size = strlen($chars) - 1; 
$random_str = ''; 
while($length--) {
        $random_str .= $chars[random_int(0, $size)]; 
}
return $random_str;
}

} //конец класса