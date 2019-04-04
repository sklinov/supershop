<?php
require "db_connect.php";

$upd=[];

$upd["id"] = isset($_POST['id']) ? intval($_POST['id']) : NULL;
$upd["name"] = isset($_POST['name']) ? $_POST['name'] : NULL;
$upd["phone"] = isset($_POST['phone']) ? $_POST['phone'] : NULL;
$upd["email"] = isset($_POST['email']) ? $_POST['email'] : NULL;
$upd["city"] = isset($_POST['city']) ? $_POST['city'] : NULL;
$upd["street"] = isset($_POST['street']) ? $_POST['street'] : NULL;
$upd["building"] = isset($_POST['building']) ? $_POST['building'] : NULL;
$upd["flat"] = isset($_POST['flat']) ? $_POST['flat'] : NULL;

//echo $upd["id"]."  ".$upd["name"]."  ".$upd["phone"]."  ".$upd["flat"];

//Update product
	$q = 'UPDATE user 
          SET name = "'.$upd["name"].'",  
			  phone = "'.$upd["phone"].'",
			  email = "'.$upd["email"].'",
			  city = "'.$upd["city"].'",
			  street = "'.$upd["street"].'",
			  building = "'.$upd["building"].'",
			  flat = "'.$upd["flat"].'"  
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