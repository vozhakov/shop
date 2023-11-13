<?php
namespace controllers;
use core\Controller;
use models\User_model;
use core\Pagination;

class AdminUserController extends Controller {

public function indexAction() {
$access = $this->checkAdmin(); // Проверка доступа
if(!$access) die('Доступ запрещен');

if( isset($_GET['userDisable']) ) {
$userDisableId = $_GET['userDisable'];	
User_model::userDisable($userDisableId);	
}

if( isset($_GET['userEnable']) ) {
$userEnableId = $_GET['userEnable'];
User_model::userEnable($userEnableId);	
}

if( isset($_GET['adminDisable']) ) {
$adminDisableId = $_GET['adminDisable'];
User_model::adminDisable($adminDisableId);	
}

if( isset($_GET['adminEnable']) ) {
$adminEnableId = $_GET['adminEnable'];
User_model::adminEnable($adminEnableId);	
}

$userId = $_SESSION['id'];
// получение пользователей кроме текущего администратора  с пагинацией
$model =  User_model::getUsersList($userId);

$usersPerPage = User_model::ITEMS_PER_PAGE;
$countUsers = User_model::$countItems;
$countUsers = $countUsers - 1;// убираем текущего администратора, он на страницу не выводится
$pagin= new Pagination();
$pagination = $pagin->show_pagination($countUsers, $usersPerPage);

$tpl = 'layouts/admin_tpl.php';
$this->view->render('Пользователи', $model, $pagination, $tpl);
}

}