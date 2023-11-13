<?php
$categories = $model['categories'];
$options =  $model['options'];
?>

<section>
<div class="container">
<div class="row"><br/>
    
    <div class="breadcrumbs">
    <ol class="breadcrumb">
    <li><a href="/admin/product">На Управление товарами</a></li>
   
    </ol>
     </div>

<h4>Обновить информацию о товаре</h4><br/>
<?php 
if(isset($options['error']) && $options['error']) echo '<p class="error">Должны быть заполнены и выбраны все поля</p>';
if( isset($options['product_added']) ) echo $options['product_added'];
 ?>

    <div class="col-lg-5">
    <div class="login-form">
    <form action="" method="post" name="add-product-form" enctype="multipart/form-data">
    <p>Название товара</p>
    <input type="text" name="name" class="clear-js" placeholder="" value="<?=$options['name']?>">
    <p>Артикул</p>
    <input type="text" class="clear-js" name="code" placeholder="" value="<?=$options['code']?>">
    <p>Стоимость, &#8381</p>
    <input type="text" name="price" class="clear-js" placeholder="" value="<?=$options['price']?>">
    <p>Новая категория <span class="cleartxt-js">(Была: "<?=$options['cat_name']?>")</span> </p>
    <select name="category_id" class="categories-admin">
    <option value="0">-- Выберите категорию --</option>
    <?php foreach ($categories as $category): ?>
    <option value="<?php echo $category['id']; ?>">
        <?php echo $category['name']; ?>
    </option>
     <?php endforeach; ?>
     </select>
     <br/><br/>

    <p>Новая подкатегория <span class="cleartxt-js">(Была: "<?=$options['subcat_name']?>")</span></p>
    <select name="subcategory_id" class="subcategories-admin">>
    </select><br/><br/>

                        <p>Бренд</p>
                        <input type="text" name="brand" class="clear-js" placeholder="" value="<?=$options['brand']?>">

                        <p>Новое изображение товара</p>
                        <input type="file" name="image" placeholder="" value="">
                        <span class="cleartxt-js"> Было: <img src="<?=$options['image']?>"></span>
                       <br/>
                        <p>Детальное описание</p>
                        <textarea name="description" class="cleartxt-js" rows="5"><?=$options['description']?></textarea>

                        <br/><br/>

                       
                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>

                        <br/><br/>

                        <p>Рекомендуемые</p>
                        <select name="is_recommended">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>

                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Отображается</option>
                            <option value="0">Скрыт</option>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                       <input type="reset" id="reset-add-product">
                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>