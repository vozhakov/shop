<?php
namespace controllers;
use core\Controller;

class SiteController extends Controller {

public function blogAction() {
if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Блог', '','', $tpl);	
}

public function aboutAction() {
if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('О магазине', '','', $tpl);	
}

public function contactAction() {
if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Контакты', '','', $tpl);	
}


} // конец класса