<?php 

namespace core;

class Pagination {
public $current_page = 1;
###############################################################
public function show_pagination($number_DB_posts, $posts_per_page = 3, $var = '' ) {
$number_of_pages = ceil($number_DB_posts/$posts_per_page); // количество страниц пагинации
$pagin_start = 1;
$number_pagination = 5; // количество позиций в пагинации, 5 или 7
$number_left = floor($number_pagination/2); // количество позиций в пагинации слева - 2
$number_right = $number_left; // количество позиций в пагинации справа - 2
$prev = '';
$next = '';
if($number_of_pages <= $number_pagination) $pagin_end = $number_of_pages;
if( isset ($_GET['pagin']) ) {
if( $_GET['pagin']>1 && $_GET['pagin']<=$number_of_pages){  
 $this->current_page = $_GET['pagin'];// текущая страница пагинации из GET параметров
}
}

// 1. Нет записей в таблице posts или $number_of_pages =1
if( ($number_DB_posts == 0) or ($number_of_pages == 1) ) {
    return '';
    exit;
}

// 2. От двух до  $number_pagination страниц
if($number_of_pages <= $number_pagination) $pagin_end = $number_of_pages;

// Количество страниц больше $number_pagination
if($number_of_pages > $number_pagination) {

 $current_left = $this->current_page - 1; // текущее количество позиций слева
$current_right = $number_of_pages - $this->current_page; // текущее количество позиций справа 

    if($current_left > $number_left) {
        $prev = '...';
        $pagin_start = $this->current_page - $number_left;
        $pagin_end = $this->current_page + $number_right;
            if($pagin_end > $number_of_pages){
            $pagin_end = $number_of_pages;
           }
    }
    else {
         $pagin_start = 1;
          $pagin_end = $number_pagination;  
          }

       if($current_right > $number_right) $next = '...';
        if( $this->current_page == ($number_of_pages - 2) ) $pagin_start = $this->current_page - $number_pagination + 3;       
       if( $this->current_page == ($number_of_pages - 1) ) $pagin_start = $this->current_page - $number_pagination + 2; 
       if( $this->current_page == $number_of_pages ) $pagin_start = $this->current_page - $number_pagination + 1;  
}

if($this->current_page == 1) {$disabled1 = ' class="disabled"';} else {$disabled1 = '';}   
if($number_DB_posts == "0") {$visib1 = ' id="visib1"';} else {$visib1 = '';}
if($this->current_page == $number_of_pages) {$disabled = ' class="disabled"';} else {$disabled = '';} 
if($number_DB_posts == "0") {$visib2 = ' id="visib2"';} else {$visib2 = '';} 

$pager = '<div class="row"><nav class="center"><ul class="pagination">';
$pager .= '<li' . $disabled1 . $visib1 . '><a href="?pagin=1' . $var . '"><span>&laquo;Начало</span></a></li><li><a href="">' . $prev . '</a></li>';

for ($i = $pagin_start; $i <= $pagin_end; $i++){
    if ($i == $this->current_page) {$active = ' class="active"';}
    else{$active = "";}

$pager .= '<li' . $active . '><a href="?pagin=' . $i . $var .'">'. $i . '</a></li>';
}
$pager .= '<li><a href="">' . $next . '</a></li>';

$pager .= '<li' . $disabled . $visib2 . '><a href="?pagin=' .  $number_of_pages . $var . '"><span>Конец&raquo;</span></a></li>';
$pager .= '</ul></nav></div>';
if(isset($_GET['pagin']))$_SESSION['pager_page'] = $this->current_page;
return $pager;
}
##########################################################

} // class Pagination