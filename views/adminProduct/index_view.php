<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <h3>Управление товарами</h3>
                
            </div>
<br>
            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>
            
            <h4>Список товаров</h4>

<p>Новый: 1-да, 0-нет | Рекомендован: 1-да, 0-нет | Статус: 1-показывается, 0-нет</p>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID товара</th>
                    <th>Артикул</th>
                    <th>Название товара</th>
                    <th>Новый</th>
                    <th>Рекомендован</th>
                    <th>Статус</th>
                    <th>Цена</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($model as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['code']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['is_new']; ?></td>
                        <td><?php echo $product['is_recommended']; ?></td>
                        <td><?php echo $product['status']; ?></td>
                        <td><?php echo $product['price']; ?></td>  
                        <td><a href="/admin/product/update/<?php echo $product['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/product/delete/<?php echo $product['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>
<div class="container">
    <div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-6"><?=$var?> <!-- Пагинация -->
</div>

<div class="col-sm-3"></div>

</div>
</div>