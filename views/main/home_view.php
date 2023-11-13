<?php
$productsList = $model['productsList'];
$recommendedList = $model['recommendedList'];

?>
<section>
<div class="container">
    <div class="row">
        
       
        <div class="col-sm-12 padding-right">
            <div class="features_items"><!--features_items-->
                
<h2 class="title text-center">Последние товары</h2>
                
<?php foreach ($productsList as $value): ?>
<div class="col-sm-3">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <a href="/product/<?=  $value['id'] ?>">
                <img src="<?=  $value['image'] ?>" alt="" />
                </a> 
                <h2><?=  $value['price'] ?> &#8381
                <?php if($value['is_new']) 
                echo '<span class="new-product"> Новый</span>';
                ?> 
                </h2>
                <p>
                 <a href="/product/<?=  $value['id'] ?>"> 
                <?=  $value['name'] ?>
                </a> 
                </p>
                <a href="/cart/add/<?=  $value['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?> 
             </div><!--features_items-->



             <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">Рекомендуемые товары</h2>
                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

        <!--  ****************начало фрагмента****** ********************   -->
                     <div class="item active">
  <?php $i = 0; ?>  
<?php foreach ($recommendedList as $value): ?>
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <a href="/product/<?=  $value['id'] ?>">
                <img src="<?=  $value['image'] ?>" alt="" />
                </a>
                <h2><?=  $value['price'] ?> &#8381</h2>
                <p>
                  <a href="/product/<?=  $value['id'] ?>">
                    <?=  $value['name'] ?>
                  </a>    
                </p>
                <a href="/cart/add/<?=  $value['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
            </div>
        </div>
    </div>
</div>
<?php
 $i++;
 if($i == 3) echo '</div><div class="item">';
  ?>
 <?php endforeach ?> 
 </div> <!--  <div class="item ">   -->
     <!--  ***************конец фрагмента******* ********************   -->                 
                    </div> <!-- <div class="carousel-inner"> -->
                    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>            
                </div>
            </div><!--/recommended_items-->

        </div>
    </div>
</div>
</section>