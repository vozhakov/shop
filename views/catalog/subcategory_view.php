<?php
$categories = $model['categories'];
$subcategories = $model['subcategories'];
$productsList = $model['subcategoryProducts'];
if( !empty($productsList) ) {
    $category_name = $productsList[0]["cat_name"];
    $subcategory_name = $productsList[0]["subcat_name"];
}
?>
<section>
<div class="container">
    <div class="row">
        
          <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Каталог</h2>
                <div class="panel-group category-products">
<!-- обходим массив категорий, взятый из БД -->
<?php foreach ($categories as $value): ?>
<div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title"><a href="" ><?= $value["name"] ?> <img src="/public/images/shop/down10.png" alt="" /></a></h4>
    <ul class="subcategory">
<!-- обходим массив подкатегорий, взятый из БД -->        
 <?php
    foreach ($subcategories as $val)
    if($value["id"] == $val["category_id"]) {
         if($val["id"] == $this->params[2]) $class = 'class="active"';
         else $class = 'class=""';
    echo '<li><a '. $class . 'href=/subcategory/' . $val["id"] .  '>' . $val["name"] . '</a></li>';
    }
?>   
    </ul>
    </div>
</div>                     
<?php endforeach ?> 

                </div>
            </div>
        </div>

        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
<p class="title text-center"><?= 'Категория товаров: <b>' . $category_name . '</b> | Подкатегория товаров: <b>' . $subcategory_name ?>  </b></p>

  <?php $i = 0 ?>              
<?php foreach ($productsList as $value): ?>
  <?php 
  if($i == 0) echo '<div class="row">'; 
  ?>  
<div class="col-sm-4">
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
                <p><a href="/cart/add/<?=  $value['id'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a></p>
            </div>
        </div>
    </div>
</div>

<?php
$i++;
if($i == 3) echo '</div><div class="row">' ;
if($i == 6) echo '</div><div class="row">' ;
if($i == 9) echo '</div><div class="row">' ;
if($i == 12) echo '</div>' ;
  ?>  
 <?php endforeach ?> 
       
            </div><!--features_items-->
        </div> <!-- <div class="col-sm-9 padding-right"> -->

    </div> <!-- <div class="row"> -->
</div> <!-- <div class="container"> -->
</section>
<div class="container">
    <div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4"><?=$var?> <!-- Пагинация -->
</div>

<div class="col-sm-4"></div>

</div>
</div>