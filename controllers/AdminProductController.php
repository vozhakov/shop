<?php
namespace controllers;
use core\Controller;
use models\Product_model;
use core\Pagination;
use models\Category_model;

class AdminProductController extends Controller {

/**
 * Действие для страницы "Управление товарами"
 */
public function indexAction() {
$access = $this->checkAdmin(); // Проверка доступа
if(!$access) die('Доступ запрещен');

$productsList = Product_model::getProductsList();
$itemsPerPage = Product_model::PRODUCTS_PER_PAGE;
$countPosts = Product_model::$countProducts;
$pagin= new Pagination();
$pagination = $pagin->show_pagination($countPosts, $itemsPerPage);
$tpl = 'layouts/admin_tpl.php';
$this->view->render('Управление товарами', $productsList, $pagination, $tpl);	
}

// Действие для страницы "Добавить новый товар"
public function createAction() {
$access = $this->checkAdmin(); // Проверка доступа
if(!$access) die('Доступ запрещен');

// Получаем список категорий для выпадающего списка
$model['categories'] = Category_model::getCategoriesListAdmin();
// добавляем товар
$model['options'] = Product_model::addProductByAdmin();

$tpl = 'layouts/admin_tpl.php';
$this->view->render('Добавить товар', $model, '', $tpl);
}

public function updateAction() {
$access = $this->checkAdmin(); // Проверка доступа
if(!$access) die('Доступ запрещен');

// Получаем список категорий для выпадающего списка
$model['categories'] = Category_model::getCategoriesListAdmin();
// обновляем товар
$productId= $this->route[2];
$model['options'] = Product_model::updateProductByAdmin($productId);
 
$tpl = 'layouts/admin_tpl.php';
$this->view->render('Редактировать товар', $model, '', $tpl);   
}

// удаление товара
public function deleteAction() {
$access = $this->checkAdmin(); // Проверка доступа
if(!$access) die('Доступ запрещен');
// удаляем товар
$productId= $this->route[2];
if ( isset($_POST['submit']) ) {
Product_model::deleteProductByAdmin($productId);
// Перенаправляем администратора на страницу управлениями товарами
header("Location: /admin/product");
}
$tpl = 'layouts/admin_tpl.php';
$this->view->render('Удалить товар', '', $productId, $tpl);   
}

} // конец класса

