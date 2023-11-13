<?php
namespace controllers;
use core\Controller;

class AdminController extends Controller {

public function indexAction() {
$var = $this->checkAdmin(); // Проверка доступа
$model = '';
if ($var) $tpl = 'layouts/admin_tpl.php';
else $tpl = 'layouts/mainAuthorized_tpl .php';
$this->view->render('Админпанель', $model, $var, $tpl);	
}

}

