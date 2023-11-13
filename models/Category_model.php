<?php

// вывод из БД списка категорий и списка подкатегорий

namespace models;

class Category_model {

public static function getCategoriesList() {
global $conn;
$sql = "SELECT id, name FROM categories WHERE status = 1  ORDER BY sort_order  ASC";
$result = mysqli_query($conn, $sql);
    $categoriesList = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
	$categoriesList[] = $row;
    }
    return $categoriesList;
}

public static function getCategoriesListAdmin() {
global $conn;
$sql = "SELECT id, name, sort_order, status FROM categories ORDER BY sort_order  ASC";
$result = mysqli_query($conn, $sql);
    $categoriesList = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $categoriesList[] = $row;
    }
    return $categoriesList;
}

public static function getSubcategoriesList() {
global $conn;
$sql = "SELECT * FROM subcategories ORDER BY category_id ASC";
$result = mysqli_query($conn, $sql);
    $subcategoriesList = array();
    while ( $row = mysqli_fetch_assoc($result) ) {
    $subcategoriesList[] = $row;
    }
    return $subcategoriesList;
}

} // конец класса