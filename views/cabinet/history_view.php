<section>
<div class="container">
<div class="row">
  <h3>Список покупок</h3>
<div class="table-responsive tb">
<?php if ( !empty($model) ): ?>  
<table class="table table-striped table-bordered">
  <thead class="table-light">
    <tr>
      <th class="col-2">Дата</th>
      <th class="col-4">Товар</th>
      <th class="col-2">Кол.</th>
      <th class="col-2">Цена за 1 шт, &#8381</th>
      <th class="col-2">Картинка</th>
     </tr>
  </thead>
<?php 
foreach ($model as $value) {
echo '<tr>';
echo '<td>' . $value['order_date'] . '</td>';
echo '<td>'. $value['name'] .'</td>';
echo '<td>'. $value['quantity_products'] .'</td>';
echo '<td>'. $value['price'] .'</td>';
echo '<td><img src="'. $value['image'] . '" width="95" height="65" alt="Картинка"></td>';
echo '</tr>'; 
} 
?>
</table>
<?php endif; ?>
</div>
<?php if ( empty($model) ): ?> 
<h5>У Вас нет покупок</h5>
<?php endif; ?>

</div>
</div>
</section>