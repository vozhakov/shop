<?php
namespace controllers;
use core\Controller;
use models\Category_model;
use models\Product_model;

class MainController extends Controller {
public function homeAction() {
$model['productsList'] = Product_model::getLatestProducts(4);
$model['recommendedList'] = Product_model::getRecommendedProducts();

if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Главная', $model,'main', $tpl);	
}

}

