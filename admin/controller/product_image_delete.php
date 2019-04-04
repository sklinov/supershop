<?php
require "db_connect.php";

$upd=[];

$upd["id"] = isset($_POST['id']) ? intval($_POST['id']) : NULL;
$upd["img_id"] = isset($_POST['img_id']) ? intval($_POST['img_id']) : NULL;

//var_dump($upd["id"],"  ---  ",$upd["img_id"]);

delete_img_from_product($upd["id"],$upd["img_id"],$mysqli);

function delete_img_from_product($product_id, $image_id, $mysqli) {
    $q = 'DELETE from product_image 
          WHERE product_id='.$product_id.' AND id='.$image_id;
	echo $q."\n";
    if($mysqli->query($q) === TRUE)
	{
		echo "Изображение удалено из карточки товара\n";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}
}

?>