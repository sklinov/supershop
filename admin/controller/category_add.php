<?php
// Добавление новой категории
include "db_connect.php";

$product_table = "product";
$category_table = "category";
$product_category_table = "product_category";

$newcat = isset($_POST['new-name']) ? $_POST['new-name'] : false;
//var_dump($newcat);

if($newcat) {
	$q = "INSERT INTO category VALUES (DEFAULT,\"".$newcat."\",DEFAULT,DEFAULT)";
    if($mysqli->query($q) === TRUE)
	{
		echo "Категория ".$newcat."добавлена";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}
}
else {
	echo "Введите имя категории";
}

function add_category($mysqli, $category_table, $newcat)
{
	
}
?>