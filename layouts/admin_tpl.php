<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?=$title?></title>
        <link href="/public/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/css/font-awesome.min.css" rel="stylesheet">
        <link href="/public/css/prettyPhoto.css" rel="stylesheet">
        <link href="/public/css/price-range.css" rel="stylesheet">
        <link href="/public/css/animate.css" rel="stylesheet">
        <link href="/public/css/main.css" rel="stylesheet">
        <link href="/public/css/responsive.css" rel="stylesheet">
        <link href="/public/css/my-styles.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="/public/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/public/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/public/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/public/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/public/images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body>
        <div class="page-wrapper">

            <header id="header"><!--header-->
                <div class="header_top"><!--header_top-->
                    <div class="container">
                        <div class="row">
                        <div class="col-sm-6">
                                <div class="contactinfo">
                                <h5>
                                        <a href="/admin/"><i class="fa fa-edit"></i> На Админпанель</a>
                                 </h5>
                             
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="/"><i class="fa fa-sign-out"></i>На сайт</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header_top-->
            <header id="header">  <!--/header-->

                 <?=$content?>

<div class="page-buffer"></div>
</div>
<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2020 - <?=date("Y")?></p>
                <p class="pull-right">Интернет магазин</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->

<script src="/public/js/jquery.js"></script>
<script src="/public/js/jquery.cycle2.min.js"></script>
<script src="/public/js/jquery.cycle2.carousel.min.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/jquery.scrollUp.min.js"></script>
<script src="/public/js/price-range.js"></script>
<script src="/public/js/jquery.prettyPhoto.js"></script>
<script src="/public/js/main.js"></script>
<script src="/public/js/my-script.js"></script>

<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>

</body>
</html>
               