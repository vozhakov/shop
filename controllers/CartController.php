<?php
namespace controllers;
use core\Controller;
use models\Category_model;
use models\Product_model;
use models\User_model;
use models\Order_model;
use lib\Cart;

class CartController extends Controller {
	
/**
 * Действие для страницы "Корзина"
 */
public function indexAction() {
$model['categories'] = Category_model::getCategoriesList();
$model['subcategories'] = Category_model::getSubCategoriesList();
$model['products'] = '';
// получаем массив: ключ - id товара, значение - количество товаров
// 0 - нет товаров в корзине
$productsInCart = Cart::getProducts();
 
// Если в корзине есть товары, получаем полную информацию о товарах для списка
if ($productsInCart) {
// Получаем массив только с идентификаторами товаров
$productsIds = array_keys($productsInCart);
// Получаем массив с полной информацией о необходимых товарах
$model['products'] = Product_model::getProdustsByIds($productsIds);
}
// Получаем общую стоимость товаров
$model['totalPrice'] = Cart::getTotalPrice($model['products']);

if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Корзина', $model, $productsInCart, $tpl);    
}

/**
 * Действие для добавления товара в корзину синхронным запросом
 * param integer $id (id товара)
 */
public function addAction() {
// Добавляем товар в корзину
$id = $this->route[2];
 Cart::addProduct($id);
// Возвращаем пользователя на страницу с которой он пришел
$referrer = $_SERVER['HTTP_REFERER'];
header("Location: $referrer");
}

/**
 * Действие для удаления товара из корзины
 */
 public function deleteAction() {
// Удаляем заданный товар из корзины
$id = $this->route[2];
Cart::deleteProduct($id);
//Возвращаем пользователя в корзину
header("Location: /cart");
}

 /**
 * Действие для страницы "Оформление покупки"
 */
    public function checkoutAction()   {
$model['categories'] = Category_model::getCategoriesList();
$model['subcategories'] = Category_model::getSubCategoriesList(); 
// Получием данные из корзины      
$productsInCart = Cart::getProducts();//массив: id товара => кол. товаров
    if( !empty($productsInCart) ){
    // Находим общую стоимость
    $productsIds = array_keys($productsInCart); //массив только с id
    $products = Product_model::getProdustsByIds($productsIds);
    $var['totalPrice'] = Cart::getTotalPrice($products); 
    // Количество товаров
    $var['totalQuantity'] = Cart::countItems();
    }
// Поля для формы
$var['userName'] = '';
$var['userPhone'] = '';
$var['userComment'] = '';
$var['errorUserName'] = '';
$var['errorUserPhone'] = '';
$var['orderAccepted'] = false;
// Статус успешного оформления заказа
$var['result'] = false;

// Проверяем является авторизован ли  пользователь
if( $_SESSION['auth'] ) {
 $userId = $_SESSION['id'];
 $user = User_model::getUserById($userId);
$var['userName'] = $user['name'];
} else {
 header("Location: /user/login");
  }

if (isset($_POST['submit'])) {
$var['userName'] = $_POST['userName'];
$var['userPhone'] = $_POST['userPhone'];
$var['userComment'] = $_POST['userComment'];


if ( !User_model::checkName($var['userName']) ) $var['errorUserName'] = 'Неправильное имя';
if (strlen($var['userPhone']) >= 10) $var['errorUserPhone'] = 'Неправильный телефон';
// если нет ошибок

if( empty($var['errorUserName']) and empty($var['errorUserPhone']) ) {
$error = Order_model::save($var['userName'], $var['userPhone'], $var['userComment'], $userId, $productsInCart);

}

// Если заказ успешно сохранен
    if (!$error) {
    $adminEmail = 'manager@mail.ru';
    //$message = '<a href="http://digital-mafia.net/admin/orders">Список заказов</a>';
    $un = $var['userName'];
    $sid = $_SESSION['id'];
  $message = "Поступил заказ от клиента: $un с идентификатором $sid";  
    $subject = 'Новый заказ!';
    mail($adminEmail, $subject, $message);
    $var['orderAccepted'] = true;
    Cart::clear();
    }
} // if (isset($_POST['submit'])) {
if($_SESSION['auth']) $tpl = 'layouts/mainAuthorized_tpl .php';
else $tpl = 'layouts/main_tpl.php';
$this->view->render('Оформление заказа', $model, $var, $tpl);     
} // public function checkoutAction() 

} // конец класса

