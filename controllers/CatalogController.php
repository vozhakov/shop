<?php
namespace controllers;
use core\Controller;
use models\Category_model;
use models\Product_model;
use core\Pagination;

class CatalogController extends Controller {

public function indexAction() {
$model['categories'] = Category_model::getCategoriesList();
$model['subcategories'] = Category_model::getSubCategoriesList();
$model['productsList'] = Product_model::getLatestProducts(12);
$model['page'] = 'catalog';
if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Каталог', $model,'', $tpl);	
}

public function subcategoryAction() {
$model['categories'] = Category_model::getCategoriesList();
$model['subcategories'] = Category_model::getSubCategoriesList();
$model['subcategoryProducts'] = Product_model::getSubcategoryProducts($this->route[2]); //$this->route[2] - id подкатегории
$itemsPerPage = Product_model::ITEMS_PER_PAGE;
$countPosts = Product_model::$countItems;
$pagin= new Pagination();
$pagination = $pagin->show_pagination($countPosts, $itemsPerPage);

if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
 $this->view->render('Подкатегория', $model, $pagination, $tpl);	
}

} // конец класса

