<section>
<div class="container">
<br><h4>Суммы продаж по месяцам</h4><br>
<?php 
if( !empty($model)) {
$i = 1;
$k = 0;
foreach($model as $date => $sum) {
if($i == 1) echo '<div class="row">';
echo '<div class="col-xs-2 sum">' . $date . '<hr>' . $sum . 
' &#8381</div>';
 if($i == 6) {
echo '</div class="row">';
$i = 0;
}
$i++;
$k++;	// количество выведенных ячеек по горизонтали
}

if($k % 6 != 0) echo '</div class="row">';
} else echo '<h5>Продажи отсутствуют</h5>';
?>
<br><br>
</div>
</section>