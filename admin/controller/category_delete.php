<?php
// Добавление новой категории
include "db_connect.php";

$product_table = "product";
$category_table = "category";
$product_category_table = "product_category";

$catid = isset($_POST['cat-id']) ? $_POST['cat-id'] : false;
//var_dump($newcat);

if($catid) {
	$q = "DELETE FROM category WHERE id=".$catid;
    if($mysqli->query($q) === TRUE)
	{
		echo "Категория ".$catid." удалена";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}
}
else {
	echo "Введите имя категории";
}

?>