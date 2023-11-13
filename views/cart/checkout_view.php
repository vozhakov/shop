<?php 
$categories = $model['categories'];
$subcategories = $model['subcategories'];
 ?>

<section>
    <div class="container">
        <div class="row">

<!-- Котегории и подкатегории  -->
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
<?php endforeach; ?> 
         </div>
    </div>                      
</div>
<!-- Конец блока: Котегории и плдкатегории  -->                     

<!--************** Блок: Оформление заказа  ***********-->  
<div class="col-sm-9 padding-right">
<div class="features_items">
<h2 class="title text-center">Оформление заказа</h2>

<?php if($var['orderAccepted']): ?>
<p>Заказ оформлен. Мы Вам перезвоним.</p>
  <?php endif; ?> 

<?php if (!$var['orderAccepted']): ?>  
<p>Выбрано товаров: <?php echo $var['totalQuantity']; ?> шт, на сумму: <?php echo $var['totalPrice']; ?> &#8381</p><br/>
         <div class="col-sm-8">
<p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>
<div class="login-form">
<form action="" method="post">
<p>Ваше имя</p>
<span class="error"><?= $var['errorUserName'] ?></span>
<input type="text" name="userName" placeholder="" value="<?php echo $var['userName']; ?>"/> 
<p>Номер телефона</p>
<span class="error"><?= $var['errorUserPhone'] ?></span>
<input type="text" name="userPhone" placeholder="" value="<?php echo $var['userPhone']; ?>"/>  
<p>Комментарий к заказу</p>
<input type="text" name="userComment" placeholder="Сообщение" value="<?php echo $var['userComment']; ?>"/>

<br/>
<br/>
<input type="submit" name="submit" class="btn btn-default btn-checkout" value="Оформить" /> 
</form>
                                </div>
                            </div>
<?php endif; ?> 

</div> <!--  <div class="features_items">  -->
</div><!-- <div class="col-sm-9 padding-right"> -->
<!-- ******************** Конец блока* ***********  -->

        </div> <!--  <div class="row">  -->
    </div> <!--  <div class="container">  -->
</section>
