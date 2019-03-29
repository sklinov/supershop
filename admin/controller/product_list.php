<?php
//Работа с базой данных

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

//var_dump($_POST);

$cat_chosen = isset($_POST['catdropdown']) ? $_POST['catdropdown'] : false;

if($cat_chosen) {
	//echo $_POST['catdropdown'];
	$cat_id = $_POST['catdropdown'];
	//echo $cat_id;
	//var_dump((int)$cat_id);  
}
else {
	//$i++;
	$cat_id = "1";
	//echo "Выберите категорию";
}
$products = all_from_category($mysqli, $product_table, $product_category_table, $cat_id);

function all_from_category($mysqli, $pr_table, $pr_cat_table, $category) {
	$res = $mysqli->query("SELECT ".$pr_table.".name, ".$pr_table.".price, ".$pr_table.".id FROM ".$pr_cat_table." JOIN ".$pr_table." ON ".$pr_table.".id=".$pr_cat_table.".id_product WHERE ".$pr_cat_table.".id_category = ".(int)$category);
	return $res;
}


// Таблица с товарами
echo '<table class="table">';
// Заготовок таблицы
echo '<tr class="table__row">
		<th class="table__head">Название товара</th>
		<th class="table__head">Стоимость</th>
		<th class="table__head"></th>
	  </tr>';
// Тело таблицы
while($product = $products->fetch_assoc()) {
	echo '<tr class="table__row">
		<td class="table__cell">'.$product["name"].'</td>
 		<td class="table__cell">'.$product["price"].'</td>
 		<td class="table__cell"><span class="link" id="edit-pr" data-id="'.$product["id"].'">Просмотр</span></td>
 	  </tr>';
 }
// Конец таблицы
echo '</table>';
?>