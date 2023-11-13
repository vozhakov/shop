<?php

// вывод из БД товаров

namespace models;
	
class Product_model
{

// Количество отображаемых товаров по умолчанию
const LATEST = 6;
const RECOMENDED = 6;

// для пагинации в функции getSubcategoryProducts() 
const ITEMS_PER_PAGE = 3;

// для пагинации в функции  getProductsList()
const PRODUCTS_PER_PAGE = 16;

public static $countItems; // количество товаров подкатегории $subcategoty_id

public static $countProducts; // общее количество товаров в таблице ptoducts в БД

/****************************************/
public static function getLatestProducts($count = self::LATEST) {
global $conn;
 $sql = "SELECT id, name, price, image, is_new FROM products  WHERE status = 1 ORDER BY id DESC LIMIT $count";
$result = mysqli_query($conn, $sql);
    $productsList = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
	$productsList[] = $row;
    }
    return $productsList;
}

/****************************************/
public static function getRecommendedProducts($count = self::RECOMENDED) {
global $conn;
 $sql = "SELECT id, name, price, image FROM products  WHERE is_recommended = 1 ORDER BY id DESC LIMIT $count";
$result = mysqli_query($conn, $sql);
    $recommendedList = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $recommendedList[] = $row;
    }
    return $recommendedList;
}

public static function getProductById($id) {
global $conn;
$sql = "SELECT p.id, p.name, p.code, p.price, p.brand, p.image, p.description, p.is_new,  c.name cat_name, s.name subcat_name FROM products p JOIN categories c ON p.category_id = c.id JOIN subcategories s ON p.subcategory_id = s.id WHERE p.id=$id;";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
return $product;
}

/****************************************/
 public static function getProdustsByIds($idsArray)     {
 global $conn;
// Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);
$sql = "SELECT id, name, code, price FROM products WHERE status='1' AND id IN ($idsString)";
$result = mysqli_query($conn, $sql);
$products = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $products[] = $row;
    }
   return $products;
}

/**********************************************************************/
// Получение данных из БД для  вывод всех товатов одной подкатегории

public static function getSubcategoryProducts($subcategotyId) {
global $conn;
// получение из БД количества товаров подкатегории $subcategoty_id
$sql = "SELECT COUNT(id) AS count FROM products WHERE status = 1 AND subcategory_id = $subcategotyId";
$result = mysqli_query($conn, $sql);
$arr = mysqli_fetch_assoc($result);
self::$countItems = $arr['count'];
// получение из БД  товаров подкатегории $subcategoty_id с учетом пагинации
$numberOfPages=ceil(self::$countItems/self::ITEMS_PER_PAGE);
$paginPage = 1;

if( isset ($_GET['pagin']) ) {
    if( $_GET['pagin']>1 && $_GET['pagin']<=$numberOfPages){  
    $paginPage = $_GET['pagin'];// текущая страница пагинации из GET параметров
    }
}

$start = self::ITEMS_PER_PAGE*($paginPage-1);
$numbeRows = self::ITEMS_PER_PAGE;
$sql = "SELECT p.id, p.name, p.price, p.image, p.is_new, c.name cat_name, s.name subcat_name FROM products p JOIN categories c ON p.category_id = c.id JOIN subcategories s ON p.subcategory_id = s.id WHERE p.status = 1 AND p.subcategory_id = $subcategotyId ORDER BY p.id DESC LIMIT $start, $numbeRows;";
$result = mysqli_query($conn, $sql);
    $subcategoryProducts = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $subcategoryProducts[] = $row;
    }
    return $subcategoryProducts;
}

/**********************************************************/
/**
 * Возвращает Массив с товарами с пагинацией
 */
public static function getProductsList() {
global $conn;
// получение из БД количества товаров 
$sql = "SELECT COUNT(id) AS count FROM products";
$result = mysqli_query($conn, $sql);
$arr = mysqli_fetch_assoc($result);
self::$countProducts = $arr['count'];

$numberOfPages=ceil(self::$countProducts/self::PRODUCTS_PER_PAGE);
$paginPage = 1;

if( isset ($_GET['pagin']) ) {
    if( $_GET['pagin']>1 && $_GET['pagin']<=$numberOfPages){  
    $paginPage = $_GET['pagin'];// текущая страница пагинации из GET параметров
    }
}

$start = self::PRODUCTS_PER_PAGE*($paginPage-1);
$numbeRows = self::PRODUCTS_PER_PAGE;
$sql = "SELECT id, name, code, price, is_new, is_recommended, status  FROM products ORDER BY id ASC LIMIT $start, $numbeRows";
$result = mysqli_query($conn, $sql);
$productsList = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $productsList[] = $row;
    }
return $productsList;
}

/***************************************************************/
public static function addProductByAdmin() {
global $conn;
$options['name'] = '';
$options['code'] = '';
$options['price'] = '';
$options['brand'] = '';
$options['description'] = '';
// Обработка формы
if (isset($_POST['submit'])) {
$options['name'] = SELF::checkPost($conn, 'name');
$options['code'] = SELF::checkPost($conn, 'code');
$options['price'] = SELF::checkPost($conn, 'price');
$options['category_id'] = $_POST['category_id'];

if( isset($_POST['subcategory_id']) ) $options['subcategory_id'] = $_POST['subcategory_id'];
else $options['subcategory_id'] = 0;

$options['brand'] = SELF::checkPost($conn, 'brand');
$options['description'] = mysqli_real_escape_string( $conn,  $_POST['description']);

$error = false;
foreach ($options as $value) {
    if ( empty($value) ) $error = true;
}
$options['error'] = $error;

$options['is_new'] = $_POST['is_new'];
$options['is_recommended'] = $_POST['is_recommended'];
$options['status'] = $_POST['status'];

if(!$error) { // если все поля формы заполнены
   $code = (int)$options['code'];
    $sql = "SELECT id FROM products WHERE code=$code";
    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    /******************/
    if( empty($res) ){ // артикул свободен
     $name = $options['name'];
     $category_id = (int)$options['category_id'];
     $subcategory_id = (int)$options['subcategory_id']; 
     $code = (int)$options['code'];
     $price = (float)$options['price'];
     $brand = $options['brand'];
$image= '/public/images/no-image.png';
    $description = $options['description'];
    $is_new = (int)$options['is_new'];
    $is_recommended = (int)$options['is_recommended'];
    $status = (int)$options['status'];

   $sql = "INSERT INTO `products` SET `name`='$name', `category_id`=$category_id, `subcategory_id`=$subcategory_id, `code`=$code,`price`=$price,`brand`='$brand', `image`='$image',`description`='$description',`is_new`=$is_new,`is_recommended`=$is_recommended,`status`=$status";
    $resCheck = mysqli_query($conn, $sql);
   
 // Проверим, загружалось ли через форму изображение
    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
   $sql = "SELECT MAX(id) as maxId FROM products";
    mysqli_query($conn, $sql);
   $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $productId = $res['maxId'];
    // имя файла совпадает с id товара
    $image = "/upload/{$productId}.jpg";
    $imgPath = "upload/{$productId}.jpg";
   // Если загружалось, переместим его в нужную папке, дадим новое имя
    move_uploaded_file($_FILES["image"]["tmp_name"],  $imgPath);
    // запишем в базу адрес изображения
    $sql = "UPDATE products SET image='$image' WHERE id=$productId";
    mysqli_query($conn, $sql);
    }

   $options['product_added'] = '<p class="good">Товар добавлен в БАЗУ ДАННЫХ</p>';
    }else{
          $options['product_added'] = '<p class="error">Такой артикул имеется в БАЗЕ ДАННЫХ</p>';
          }
 /******* конец блока if( empty($res) ) else ***********/

} // if(!$error)

return $options;
} // if (isset($_POST['submit']))

return 0;

}

/**********************************************/
/**
 * Редактирует товар с заданным id
 */
public static function updateProductByAdmin($id) {
global $conn;
// Выводим старые значения
if (!isset($_POST['submit'])) {
$sql = "SELECT p.name name, p.code code, p.price price, p.brand brand, p.image image, p.description description, p.is_new is_new, p.is_recommended is_recommended, p.status status, c.name cat_name, s.name subcat_name FROM products p JOIN categories c ON p.category_id = c.id JOIN subcategories s ON p.subcategory_id = s.id WHERE p.id=$id;";
$result = mysqli_query($conn, $sql);
$options = mysqli_fetch_assoc($result);
return $options;
}

if (isset($_POST['submit'])) { 
$options['name'] = SELF::checkPost($conn, 'name');
$options['code'] = SELF::checkPost($conn, 'code');
$options['price'] = SELF::checkPost($conn, 'price');
$options['category_id'] = $_POST['category_id'];

$sql = "SELECT p.image image, c.name cat_name, s.name subcat_name FROM products p JOIN categories c ON p.category_id = c.id JOIN subcategories s ON p.subcategory_id = s.id WHERE p.id=$id;";
$result = mysqli_query($conn, $sql);
$res = mysqli_fetch_assoc($result);
$options['cat_name'] = $res['cat_name'];
$options['subcat_name'] = $res['subcat_name'];
$options['image'] = $res['image'];

if( isset($_POST['subcategory_id']) ) $options['subcategory_id'] = $_POST['subcategory_id'];
else $options['subcategory_id'] = 0;

$options['brand'] = SELF::checkPost($conn, 'brand');
//$options['description'] = mysqli_real_escape_string( $conn,  $_POST['description']);
$options['description'] = $_POST['description'];

$error = false;
foreach ($options as $value) {
    if ( empty($value) ) $error = true;
}
$options['error'] = $error;

$options['is_new'] = $_POST['is_new'];
$options['is_recommended'] = $_POST['is_recommended'];
$options['status'] = $_POST['status'];

if(!$error) { // если все поля формы заполнены
   $code = (int)$options['code'];
    $sql = "SELECT id FROM products WHERE code=$code && id<>$id"  ;
    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    /******************/
    if( empty($res) ){ // артикул свободен
     $name = $options['name'];
     $category_id = (int)$options['category_id'];
     $subcategory_id = (int)$options['subcategory_id']; 
     $code = (int)$options['code'];
     $price = (float)$options['price'];
     $brand = $options['brand'];
$image= '/public/images/no-image.png';
    $description = $options['description'];
    $is_new = (int)$options['is_new'];
    $is_recommended = (int)$options['is_recommended'];
    $status = (int)$options['status'];

 // Проверим, загружалось ли через форму изображение
    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
      // имя файла совпадает с id товара
    $image = "/upload/{$id}.jpg"; // в БД
    $imgPath = "upload/{$id}.jpg";
   // Если загружалось, переместим его в нужную папке, дадим новое имя
    move_uploaded_file($_FILES["image"]["tmp_name"],  $imgPath);
   }

   $sql = "UPDATE`products` SET `name`='$name', `category_id`=$category_id, `subcategory_id`=$subcategory_id, `code`=$code,`price`=$price,`brand`='$brand', `image`='$image', `description`='$description', `is_new`=$is_new, `is_recommended`=$is_recommended, `status`=$status WHERE id=$id";
    $resCheck = mysqli_query($conn, $sql);
 
   $options['product_added'] = '<p class="good">Товар изменен в БАЗЕ ДАННЫХ</p>';
    }else{
          $options['product_added'] = '<p class="error">Такой артикул имеется в БАЗЕ ДАННЫХ</p>';
          }
 /******* конец блока if( empty($res) ) else ***********/

} // if(!$error)

return $options;
} // if (isset($_POST['submit']))
}

/********************************************/
/**
 * Удаляет товар с указанным id
 */
public static function deleteProductByAdmin($id) {
global $conn;
$sql = "DELETE FROM products WHERE id = $id";
mysqli_query($conn, $sql);
}

/*******************************************/
private static function checkPost($link, $var)
{
 return htmlspecialchars( mysqli_real_escape_string( $link,  $_POST[$var]) );
}

} // конец класса
	