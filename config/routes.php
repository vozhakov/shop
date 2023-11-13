<?php
return array (
/* Главная страница сайта http://shop-mvc/ */
'' => 'main/home', // homeAction в MainController

 /* Страница одного товара http://shop-mvc/product/5 */
'product/([0-9]+)' => 'product/view/$1', // viewAction в ProductController
// $params в class View, $route в class Controller
// строка 'product' будет храниться в $params[0] и $route[0]
// строка 'view' будет храниться в $params[1] и $route[1]
// содержимое кармана $1 , будет храниться в $params[2] и $route[2]
// 'product/([0-9]+)' - шаблон адресной строки в браузере
/* product/view/$1:
product - контроллер, view - действие,  $1 - идентификатор продукта, берется из адресной строки  */

/* Страница Каталог http://shop-mvc/catalog */
'catalog' => 'catalog/index', // indexAction в CatalogController

 /* Страница товаров одной подкатегории http://shop-mvc/subcategory/5 */
'subcategory/([0-9]+)' => 'catalog/subcategory/$1', // subcategoryAction в CatalogController 

// Пользователь:
'user/register' => 'user/register',
'user/logout' => 'user/logout',
'user/login' => 'user/login',
'cabinet' => 'cabinet/index',
'cabinet/edit' => 'cabinet/edit',
'cabinet/history' => 'cabinet/history',

// Корзина:
'cart' => 'cart/index', // indexAction в CartController
'cart/add/([0-9]+)' => 'cart/add/$1', // addAction в CartController    
'cart/delete/([0-9]+)' => 'cart/delete/$1', // deleteAction в CartController   
 'cart/checkout' => 'cart/checkout', // checkoutAction в CartController    

/************************************************/
 // Админпанель:
'admin' => 'admin/index',

// Управление товарами:
'admin/product' => 'adminProduct/index',
'admin/product/create' => 'adminProduct/create',
'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',

//  управление пользователями
'admin/user'  => 'adminUser/index',

 //  суммы продаж по месяцам
'admin/sale'  => 'adminSale/index',

// О магазине
'blog' => 'site/blog',
'about' => 'site/about',
'contacts' => 'site/contact',
);


    



