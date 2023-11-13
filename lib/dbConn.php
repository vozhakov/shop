<?php
// Подключение к базе
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Ошибка соединения с БД');
mysqli_set_charset($conn, "utf8") or die('Не установлена кодировка'); 
