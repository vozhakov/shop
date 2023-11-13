<?php
namespace controllers;
use core\Controller;
use models\Order_model;

class AdminSaleController extends Controller {

public function indexAction() {
$access = $this->checkAdmin(); // Проверка доступа
if(!$access) die('Доступ запрещен');
$sumByMonth = Order_model::getSumByMonthOrder();

$tpl = 'layouts/admin_tpl.php';
$this->view->render('Продажи', $sumByMonth, '', $tpl);
}

}