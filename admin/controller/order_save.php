<?php
require "db_connect.php";

$upd=[];

$upd["id"] = isset($_POST['id']) ? intval($_POST['id']) : NULL;
$upd["id_user"] = isset($_POST['id_user']) ? intval($_POST['id_user']) : NULL;
$upd["id_status"] = isset($_POST['id_status']) ? $_POST['id_status'] : NULL;
$upd["name"] = isset($_POST['name']) ? $_POST['name'] : NULL;
$upd["phone"] = isset($_POST['phone']) ? $_POST['phone'] : NULL;
$upd["email"] = isset($_POST['email']) ? $_POST['email'] : NULL;
$upd["city"] = isset($_POST['city']) ? $_POST['city'] : NULL;
$upd["street"] = isset($_POST['street']) ? $_POST['street'] : NULL;
$upd["building"] = isset($_POST['building']) ? $_POST['building'] : NULL;
$upd["flat"] = isset($_POST['flat']) ? $_POST['flat'] : NULL;
$upd["id_shipping"] = isset($_POST['id_shipping']) ? intval($_POST['id_shipping']) : NULL;
$upd["total"] = isset($_POST['total']) ? $_POST['total'] : NULL;
$upd["comment"] = isset($_POST['comment']) ? $_POST['comment'] : NULL;
$upd["id_product"] = isset($_POST['id_product']) ? $_POST['id_product'] : NULL;
$upd["product_quantity"] = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : NULL;
$upd["product_price"] = isset($_POST['product_price']) ? $_POST['product_price'] : NULL;

//Update order
	$q = 'UPDATE orders 
          SET id_user = "'.$upd["id_user"].'",
              total = "'.$upd["total"].'",  
			  id_status = "'.$upd["id_status"].'",
			  comment = "'.$upd["comment"].'",
			  id_shipping = "'.$upd["id_shipping"].'"  
          WHERE
			id='.$upd["id"];
	//echo $q;
    if($mysqli->query($q) === TRUE)
	{
		echo "Изменения в заказе сохранены<br>";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
    }

//Update user
    $q = 'UPDATE user 
    SET name = "'.$upd["name"].'",  
        phone = "'.$upd["phone"].'",
        email = "'.$upd["email"].'",
        city = "'.$upd["city"].'",
        street = "'.$upd["street"].'",
        building = "'.$upd["building"].'",
        flat = "'.$upd["flat"].'"  
    WHERE
      id='.$upd["id_user"];
    //echo $q;
    if($mysqli->query($q) === TRUE)
    {
    echo "Изменения пользователя сохранены<br>";
    }
    else
    {
    echo "Ошибка: ".$mysqli->error;
    }

//Update products in order

// //Remove old order data
    $q = 'DELETE FROM order_product 
            WHERE
            id_order='.$upd["id"];
    //echo $q;
    if($mysqli->query($q) === TRUE)
    {
    echo "Изменения сохранены";
    }
    else
    {
    echo "Ошибка: ".$mysqli->error;
    }
// Write new order data
$limit = count($upd["id_product"]);

for($i=0;$i<$limit;$i++)
    {
        $q = 'INSERT INTO order_product (id_order, id_product, price, quantity)
                VALUES ("'.$upd["id"].'",
                "'.$upd["id_product"][$i].'",
                "'.$upd["product_price"][$i].'",
                "'.$upd["product_quantity"][$i].'")';
        echo($q);
        if($mysqli->query($q) === TRUE)
        {
        echo "Изменения сохранены";
        }
        else
        {
        echo "Ошибка: ".$mysqli->error;
        }
    }
?>