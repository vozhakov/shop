<?php
$countProducts = lib\Cart::countItems();
if(!empty($countProducts)) {
$count = $countProducts;
$inCart = 'class="in-cart"';
} else { 
       $count = '';
        $inCart = '';
       }
?>
<!DOCTYPE html>
<html lang="ru">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="">
    <meta name="author" content="">
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/font-awesome.min.css" rel="stylesheet">
    <link href="/public/css/prettyPhoto.css" rel="stylesheet">
    <link href="/public/css/price-range.css" rel="stylesheet">
    <link href="/public/css/animate.css" rel="stylesheet">
    <link href="/public/css/main.css" rel="stylesheet">
    <link href="/public/css/responsive.css" rel="stylesheet">
    <link href="/public/css/my-styles.css" rel="stylesheet">
    <link href="/public/css/pagination.css" rel="stylesheet">
    <title><?=$title?></title>
       
 </head>
<body>
<header id="header"><!--header-->
    
<div class="header_top"><!--header_top-->
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="contactinfo">
                    <ul class="nav nav-pills">
                        <li><a href="#"><i class="fa fa-phone"></i> +11 111 111 11 11</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i> test@test.ru</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="social-icons pull-right">
                    <ul class="nav navbar-nav">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--.header_top-->

<div class="header-middle"><!--header-middle-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="logo pull-left">
                    <a href="/"><img src="/public/images/home/logo.png" alt="" /></a>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="shop-menu pull-right">
                    <ul class="nav navbar-nav">                                    
                        <li <?= $inCart ?>><a href="/cart/"><i class="fa fa-shopping-cart"></i> Корзина</a></li>
                        <li <?= $inCart ?>><a><?= $count ?></a></li>
                        <li><a href="/cart/"><i class="fa fa-user"></i><b><?= $_SESSION['login']; ?></b></a></li>
                        <li><a href="/cabinet/"><i class="fa fa-book"></i>Личный кабинет</a></li>
                        <li><a href="/user/logout"><i class="fa fa-unlock"></i>Выйти</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--.header-middle-->

<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="/" <?php if($var == 'main') echo  'class="current"'; ?>>Главная</a></li>

                        <li class="dropdown"><a href="/catalog/" <?php if(isset($model['page']) and $model['page'] == 'catalog') echo  'class="current"'; ?>>Магазин<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="/catalog/">Каталог товаров</a></li>
                                <li><a href="/cart/">Корзина</a></li> 
                            </ul>
                        </li> 
                        <li><a href="/blog">Блог</a></li> 
                        <li><a href="/about">О магазине</a></li>
                        <li><a href="/contacts">Контакты</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--.header-bottom-->
    
</header>

    <?=$content?>

<footer id="footer">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2020 - <?=date("Y")?></p>
                <p class="pull-right">Интернет магазин</p>
            </div>
        </div>
    </div>
</footer>

    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
    <script src="/public/js/jquery.scrollUp.min.js"></script>
    <script src="/public/js/price-range.js"></script>
    <script src="/public/js/jquery.prettyPhoto.js"></script>
    <script src="/public/js/main.js"></script>
   
</body>
</html>