<?php
require "db_connect.php";

$upd=[];

$upd["id"] = isset($_POST['id']) ? intval($_POST['id']) : NULL;
$upd["name"] = isset($_POST['name']) ? $_POST['name'] : NULL;
$upd["description"] = isset($_POST['description']) ? $_POST['description'] : NULL;
$upd["sku"] = isset($_POST['sku']) ? intval($_POST['sku']) : NULL;
$upd["price"] = isset($_POST['price']) ? floatval($_POST['price']) : NULL;
$upd["old_price"] = isset($_POST['id']) ? floatval($_POST['old_price']) : NULL;
$upd["quantity"] = isset($_POST['id']) ? intval($_POST['quantity']) : NULL;
$upd["badge"] = isset($_POST['badge']) ? $_POST['badge'] : NULL;

//echo $upd["id"]."  ".$upd["name"]."  ".$upd["description"]."  ".$upd["badge"];

//Update product
	$q = 'UPDATE product 
          SET name = "'.$upd["name"].'",  
			  description = "'.$upd["description"].'",
			  sku = "'.$upd["sku"].'",
			  price = "'.$upd["price"].'",
			  old_price = "'.$upd["old_price"].'",
			  quantity = "'.$upd["quantity"].'",
			  badge_id = "'.$upd["badge"].'"  
          WHERE
			id='.$upd["id"];
	//echo $q;
    if($mysqli->query($q) === TRUE)
	{
		echo "Изменения сохранены";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}

?>