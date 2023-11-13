<?php
namespace core;
use core\View;
use models\User_model;

abstract class Controller {

public $route;	
public $view;

public function __construct( $route) {
$this->route = $route; 
$this->view = new View($route);
}

 public function checkAdmin()  {
     // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
	if ( isset($_SESSION['id']) ) $userId = $_SESSION['id'];
	else  header("Location: /user/login");

	// Получаем информацию о текущем пользователе
	$user = User_model::getUserById($userId);

	// Если роль текущего пользователя "admin", пускаем его в админпанель
	if ($user['role'] == 'admin') {
	    return true;
	}

// Иначе завершаем работу с сообщением об закрытом доступе
 return false;
}

} // конец класса