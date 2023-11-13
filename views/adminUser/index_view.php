<section>
<div class="container">
<div class="row">
<h4>Пользователи кроме меня</h4>

<div class="table-responsive tb">
<table class="table table-striped table-bordered">
 <thead class="table-light text-center ">
    <tr>
      <th class="col-1">id<br>поль-ля</th>
      <th class="col-2">Имя</th>
      <th class="col-2">email</th>
      <th class="col-1">Пользователь<br>запрещен (Ban)</th>
      <th class="col-2">Запретить<br>пользователя (Ban)</th>
      <th class="col-2">Роль</th>
      <th class="col-2">Назначить<br>администратором</th>
    </tr>
  </thead> 
<?php 
foreach ($model as $value) {
echo '<tr>';
echo '<td>'. $value['id'] . '</td>';
echo '<td>'. $value['name'] .'</td>';
echo '<td>'. $value['email'] .'</td>';
echo '<td>'. $value['ban'] .'</td>';
echo '<td><a href="?userDisable=' . $value['id'] .  '">Запретить |<a/><a href="?userEnable=' . $value['id'] .  '"> Разрешить<a/></td>';
echo '<td>'. $value['role'] .'</td>';
echo '<td><a href="?adminEnable=' . $value['id'] .  '">Назначить |<a/><a href="?adminDisable=' . $value['id'] .  '"> Снять<a/></td>';
echo '</tr>'; 
} 
?>

</table>
</div>
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