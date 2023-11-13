<?php
namespace controllers;
use core\Controller;
use models\Product_model;
use models\Category_model;

// $this->view = new View($route) - в классе Controller
class ProductController extends Controller {

public function viewAction() {

$id = $this->view->params[2]; // id товара
$model['categories'] = Category_model::getCategoriesList();
$model['subcategories'] = Category_model::getSubCategoriesList();
$model['product'] = Product_model:: getProductById($id);

if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Товар', $model, '',$tpl);	
}

}

