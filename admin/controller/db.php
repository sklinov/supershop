<?php
//$mysql_host = "localhost";
$mysql_host = "94.154.12.56";
$mysql_user = "superstore";
$mysql_password = "wewrDMijWFA0yxZH";
$my_database = "superstore";

$product_table = "product";
$category_table = "category";
$product_category_table = "product_category";

// Connecting to Database
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}



//Get all the categories available
$cats= all_from_table($mysqli, $category_table);

// Getting category of product
$i=0;

$cat_chosen = isset($_POST['catdropdown']) ? $_POST['catdropdown'] : false;

if($cat_chosen) {
	//echo $_POST['catdropdown'];
	$cat_id = $_POST['catdropdown'];
	//echo $cat_id;
	//var_dump((int)$cat_id);  
	$products = all_from_category($mysqli, $product_table, $product_category_table, $cat_id);
}
else {
	//$i++;
	$cat_id = "1";
	$products = all_from_category($mysqli, $product_table, $product_category_table, $cat_id);
	//echo "Выберите категорию";
}



function all_from_table($mysqli, $my_table) {
	$res = $mysqli->query("SELECT * FROM ".$my_table);
	return $res;
}

function all_from_category($mysqli, $pr_table, $pr_cat_table, $category) {
	$res = $mysqli->query("SELECT ".$pr_table.".name, ".$pr_table.".price FROM ".$pr_cat_table." JOIN ".$pr_table." ON ".$pr_table.".id=".$pr_cat_table.".id_product WHERE ".$pr_cat_table.".id_category = ".(int)$category);
	//$res= $mysqli->query("SELECT product.name, product.price FROM `product_category` JOIN product ON  product.id=product_category.id_product WHERE product_category.id_category = ".(int)$category);
	return $res;
}

?>