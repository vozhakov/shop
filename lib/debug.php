<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// define('COMMENT', true); // true, false
//Пример использования if(COMMENT) echo 'Комментарий<br>';
function debug($var) {
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
	exit;
}

function deb($var) {
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

function darr($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}