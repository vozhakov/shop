<?php

namespace core;

class View {

private $path;
public $params;

public function __construct($params){
$this->params = $params;
$this->path = $this->params[0] . '/' . $this->params[1] . '_view';
}

public function render($title, $model, $var = '', $tpl) {
   if( file_exists('views/' . $this->path . '.php') ) {
 	ob_start();
    require 'views/' . $this->path . '.php';
	$content = ob_get_clean();
	} else {echo 'Вид не найден: ' . $this->path . '.php';}
	
  // путь к шаблону передается в аргументе функции	$tpl  
	require $tpl;

	} // конец render()

} //конец класса