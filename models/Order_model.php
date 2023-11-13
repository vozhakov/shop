<?php

namespace models;
	
class Order_model {

/**
 * Сохранение заказа 
 * param string $userName Имя
 * param string $userPhone Телефон
 * param string $userComment Комментарий
 * param integer $userId id пользователя
 * param array $products Массив с товарами: id товара => количество
 * return boolean Результат выполнения метода
 */
public static function save($userName, $userPhone, $userComment, $userId, $products) {
global $conn;
$userName = htmlspecialchars( mysqli_real_escape_string($conn, $userName) );
$userPhone = htmlspecialchars( mysqli_real_escape_string($conn, $userPhone) );
$userComment = htmlspecialchars( mysqli_real_escape_string($conn, $userComment) );
$error = false;
if( !empty($products) ){
    foreach ($products as $productId => $quantityProducts) {
        $sql = "SELECT price FROM products WHERE id=$productId";
        $res = mysqli_query($conn, $sql);
        $arrPrice = mysqli_fetch_assoc($res);
        $price = (float)$arrPrice['price'];
        $sum = $quantityProducts * $price;

    $sql = "INSERT INTO product_orders (user_name, user_phone, user_comment, user_id, product_id, quantity_products, sum, order_date) VALUES ('$userName', '$userPhone', '$userComment', $userId, $productId, $quantityProducts, $sum, NOW() )";
    $res = mysqli_query($conn, $sql); // если успешно true
    if(!$res) return true; 
    }
}
return $error;
} // public static function save

/************************************************/
public static function getHistoryOrders($userId) {
global $conn;
$sql = "SELECT po.order_date, ps.name, po.quantity_products, ps.price, ps.image FROM product_orders po INNER JOIN products ps ON po.product_id = ps.id WHERE po.user_id = $userId ORDER BY po.order_date DESC";
$result = mysqli_query($conn, $sql);
$productsList = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $productsList[] = $row;
    }
if( !empty($productsList)  ) return $productsList;
else return false;
}

/******************************************************/
public static function getSumByMonthOrder() {
global $conn;

$sql = "SELECT min(YEAR(order_date)) year FROM product_orders";
$resMinYear = mysqli_query($conn, $sql);

if( !empty($resMinYear) ) { // если есть записи в таблице БД product_osders
$arrMinYear = mysqli_fetch_assoc($resMinYear);
$MinYear = $arrMinYear['year'];
$currentYear = $MinYear;

$sql = "SELECT max(YEAR(order_date)) year FROM product_orders";
$resMaxYear = mysqli_query($conn, $sql);
$arrMaxYear = mysqli_fetch_assoc($resMaxYear);
$MaxYear = $arrMaxYear['year'];
$currentYear = $MinYear;

while($currentYear <= $MaxYear) {
// запрашиваем месяцы текущего года $currentYear
$sql = "SELECT DISTINCT MONTH(order_date) month FROM product_orders WHERE YEAR(order_date)=$currentYear";
$resMonthes=[]; // очищаем массив
$result = mysqli_query($conn, $sql);

if( !empty($result) ){
    while ( $row = mysqli_fetch_assoc($result) ) {
    $resMonthes[] = $row; // месяцы текущего  года $currentYear
    }
}
// обходим месяцы текущего  года $currentYear
    foreach ($resMonthes as  $value) {
      $month = $value["month"];
     $sql = "SELECT SUM(sum) monthSum FROM product_orders WHERE YEAR(order_date) =  $currentYear && MONTH(order_date) = $month";
    $result = mysqli_query($conn, $sql);
    $arrMonthSum = mysqli_fetch_assoc($result)  ;
      // формируем возвращаемый массив
    $sumsByMonth["$currentYear/$month"] = $arrMonthSum["monthSum"];
     } // foreach ($resMonthes as  $value)
$currentYear++;
}  // while($currentYear <= $MaxYear) 
  
} else  return false;
  // if( !empty($resMinYear) )
if( !empty($sumsByMonth) ) return $sumsByMonth;
else  return false;
} // function getSumMonthOrder()

} // конец класса
