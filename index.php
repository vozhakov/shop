<?php
use core\Router;
use models\User_model;

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
//const 'ROOT' = $_SERVER['DOCUMENT_ROOT'];
require 'lib/debug.php';
require 'config/dbConf.php';
// Подключение к базе. База и таблицы созданы заранее 
require 'lib/dbConn.php';
                              
session_start();
if(!isset($_SESSION['auth'])) $_SESSION['auth'] = false;
                              
// в переменной $class будет имя класса с пространством имен
spl_autoload_register(function($class) {
$path = str_replace('\\', '/', $class) . '.php';
    if ( file_exists($path) ) {
        require_once $path; 
    }
    else { 
    	echo 'Не найден файл: ' . $path;
        exit;
        }
});

User_model::auth();
$router = new Router();
$router->run();