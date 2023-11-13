<?php
$categories = $model['categories'];
$subcategories = $model['subcategories'];
$product = $model['product'];
?>
  <section>
<div class="container">
  
<div class="row placement">
 <div class="col-sm-4"></div>
 <div class="col-sm-3">Категория: <?= $product['cat_name'] ?></div>
<div class="col-sm-5">Подкатегория: <?= $product['subcat_name'] ?></div>
</div>

    <div class="row">
        <!--**************начало каталога***************************-->
         <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Каталог</h2>
                <div class="panel-group category-products">

<?php foreach ($categories as $value): ?>
<div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title"><a href="" ><?= $value["name"] ?> <img src="/public/images/shop/down10.png" alt="" /></a></h4>
    <ul class="subcategory">
 <?php
    foreach ($subcategories as $val)
    if($value["id"] == $val["category_id"])
    echo '<li><a href=/subcategory/' . $val["id"] . '>' . $val["name"] . '</a></li>';
?>   
    </ul>
    </div>
</div>                     
<?php endforeach ?> 

                </div>
            </div>
        </div>
<!--**************конец каталога***************************-->
        
        <div class="col-sm-9 padding-right">
            <div class="product-details"><!--product-details-->

 <!--*************начало ряда***************************-->             
<div class="row">
    <div class="col-sm-5">
        <div class="view-product">
            <img src="<?=  $product['image'] ?>" alt="" />
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
<?php
  if($product['is_new'] == 1)  echo '<img src="/public/images/product-details/new.jpg" class="newarrival" alt="" />'; 
?>
            <h2><?=  $product['name'] ?></h2>
            <p>Код товара: <?=  $product['code'] ?></p>
            <span>
                <span><?=  $product['price'] ?> &#8381</span>
                <button type="button" class="btn btn-fefault cart">
                    <a href="/cart/add/<?=  $product['id'] ?>">
                    <i class="fa fa-shopping-cart"></i>
                    В корзину
                </a>
                </button>
            </span>
            
            <p><b>Бренд:</b> <?= $product['brand'] ?></p>
        </div><!--/product-information-->
    </div>
</div>
<!--*************конец ряда***************************--> 

                <div class="row">                                
                    <div class="col-sm-12">
                        <h5>Описание товара</h5>
                        <?= $product['description'] ?>
                    </div>
                </div>

            </div><!--/product-details-->

        </div>
    </div>
</div>
</section>        

        <br/>
        <br/>
        