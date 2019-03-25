<?php
//include 'controller/db.php';
$mysql_host = "94.154.12.56";
$mysql_user = "superstore";
$mysql_password = "wewrDMijWFA0yxZH";
$my_database = "superstore";

// Connecting to Database
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}

$product_table = "product";
$category_table = "category";
$product_category_table = "product_category";

// Запрос всех категорий

$categories = all_categories($mysqli, $category_table, $product_category_table);

// Добавление новой категории

$newcat = isset($_POST['new-name']) ? $_POST['new-name'] : false;
var_dump($newcat);
if($newcat) {
	add_category($mysqli, $category_table, $newcat);
}
else {
	echo "Введите имя категории";
}

function add_category($mysqli, $category_table, $newcat)
{
	$q = "INSERT INTO category( id,name, title, discription) VALUES ('',".$newcat.",'','')";
	if($mysqli->query($q) === TRUE)
	{
		echo "Категория ".$newcat."добавлена";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}
}

function all_categories($mysqli, $category_table, $pr_cat_table) {
	$q="SELECT category.id, category.name, COUNT(*) as quantity FROM product_category JOIN category ON category.id=product_category.id_category JOIN product ON product.id=product_category.id_product GROUP BY category.id";
	$res = $mysqli->query($q);
	//	$res = $mysqli->query("SELECT ".$category_table.".name, ".$category_table.".id count (*) AS quantity FROM ".$pr_cat_table." JOIN ".$category_table." ON ".$category_table.".id=".$pr_cat_table.".id_category GROUP BY ".$category_table."id");
	return $res;
}


// Заголовок
echo '<h1 class="title">Категории</h1>';

// Таблица с категориями
echo '<table class="table">';
// Заголовок таблицы
echo '<tr class="table__row">
		<th class="table__head">Название товара</th>
		<th class="table__head">Количество товаров</th>
		<th class="table__head"></th>
		<th class="table__head"></th>
	  </tr>';
// Тело таблицы
while($category = $categories->fetch_assoc()) {
	echo '<tr class="table__row">
		<td class="table__cell">'.$category["name"].'</td>
		<td class="table__cell">'.$category["quantity"].'</td>;';
if($category["quantity"]==0)
{	
	echo '<td class="table__cell"><a href="">Удалить</a></td>';
}
else{
	echo '<td class="table__cell"></td>';
}
	echo '<td class="table__cell"><a href="">Просмотр</a></td>
 	  </tr>';
 }
// Конец таблицы
echo '</table>';

//Добавить категорию
echo '
	<form class="add">
		 <label for="add-cat"></label>
		 <input type="text" name="add-cat" id="add-cat"></input>
		 <a href="">Добавить категорию</a>
	</form>
	';
echo '<div id="results"></div>';
?>