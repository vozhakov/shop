<?php
namespace core;

class Router {

private $routes;
private $params;

public function __construct() {
$this->routes = include 'config/routes.php';
}
 
 private function match() {

$uri = $_SERVER['REQUEST_URI'];
$pos = strpos($uri, '?');
if( is_numeric($pos) ) $uri = strstr($uri, '?', true); // убираем GET запросы
$uri = trim( $uri, '/'); // убираем / в начале и конце строки

	foreach ($this->routes as $uriPattern => $path) {
	$uriPattern = '#^' . $uriPattern .'$#'; // "#^news/([0-9]+)$#"
		if(preg_match( $uriPattern, $uri) ) {
		$internalRoute = preg_replace($uriPattern, $path, $uri); // строка
		$this->params = explode('/', $internalRoute); // массив
     	return true;
	    }
	}
return false;
}	

public function run() {
if( $this->match() ) {
$controllerName = 'controllers\\' . ucfirst($this->params[0]) . 'Controller';
	if( class_exists($controllerName) ) {
	$action = $this->params[1] . 'Action';
		if( method_exists($controllerName, $action) ) {
            $controller = new $controllerName($this->params);
           	$controller -> 	$action();
		} else echo 'Метод не найден: ' . $controllerName . '->' .	$action . '()';
	} else echo "Класс не найден: " . $controllerName;

} else echo 'Маршрут не найден: ' . trim($_SERVER['REQUEST_URI'], '/');

} // конец public function run()

} // конец класса