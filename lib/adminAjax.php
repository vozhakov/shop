<?php
require_once '../config/dbConf.php';
require_once 'dbConn.php';
require_once 'debug.php';

if( !empty($_POST['id']) ) {
$categotyId = intval($_POST['id']);
$sql = "SELECT id, name FROM subcategories WHERE category_id=$categotyId";
$result = mysqli_query($conn, $sql);
    while ( $row = mysqli_fetch_assoc($result) ) {
	$subcat[] = $row;
    }
$optionSubcat = '<option value="0">-- Выберите подкатегорию --</option>';
	foreach ($subcat as $val) {
	$optionSubcat .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
	}
echo $optionSubcat;
}