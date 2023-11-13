<?php
namespace lib;

class Cart {

/** Добавление товара в корзину (сессию)
 * параметр int $id (id товара)
 * return integer - Количество товаров в корзине
 */
public static function addProduct($id) {
// Приводим $id к типу integer
$id = intval($id);

// Пустой массив для товаров в корзине
$productsInCart = array();

// Если в корзине уже есть товары (они хранятся в сессии),
// то заполним наш массив товарами
if (isset($_SESSION['products'])) {
$productsInCart = $_SESSION['products'];
}

// Проверяем есть ли уже такой товар в корзине 
if (array_key_exists($id, $productsInCart)) {
// Если такой товар есть в корзине, но был добавлен еще раз, увеличим количество на 1
$productsInCart[$id] ++;
} else {
         // Если нет, добавляем id нового товара в корзину с количеством 1
        $productsInCart[$id] = 1;
        }

// Записываем массив с товарами в сессию
$_SESSION['products'] = $productsInCart;

 // Возвращаем количество товаров в корзине
return self::countItems();
}

/**
 * Подсчет количество товаров в корзине (в сессии)
 * return int Количество товаров в корзине
 */
    public static function countItems()
    {
        // Проверка наличия товаров в корзине
        if (isset($_SESSION['products'])) {
            // Если массив с товарами есть
            // Подсчитаем и вернем их количество
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            // Если товаров нет, вернем 0
            return 0;
        }
    }


/** Возвращает массив с идентификаторами и количеством товаров в корзине
 * Если товаров нет, возвращает false; 
 */
public static function getProducts()     {
    if (isset($_SESSION['products'])) {
    return $_SESSION['products'];
    }
return false;
}

/**
 * Получаем общую стоимость переданных товаров
 * param array $products Массив с информацией о товарах
 * return integer Общая стоимость
 */
public static function getTotalPrice($products) {
// Получаем массив с идентификаторами и количеством товаров в корзине
$productsInCart = self::getProducts();
    // Подсчитываем общую стоимость
    $total = 0;
    if ($productsInCart) {
    // Если в корзине не пусто, то проходим по переданному в метод массиву товаров
        foreach ($products as $item) {
        // Находим общую стоимость: цена товара * количество товара
        $total += $item['price'] * $productsInCart[$item['id']];
            }
    }
return $total;
}

/*
 * Удаляет товар с указанным id из корзины
 * param integer $id id товара
 */
public static function deleteProduct($id) {
// Получаем массив с идентификаторами и количеством товаров в корзине
$productsInCart = self::getProducts();
// Удаляем из массива элемент с указанным id
unset($productsInCart[$id]);
// Записываем массив товаров с удаленным элементом в сессию
$_SESSION['products'] = $productsInCart;
}

 /**
  * Очищает корзину
  */
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

} // конец класса