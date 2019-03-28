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


function all_categories($mysqli, $category_table, $pr_cat_table) {
	$q="SELECT
	product_category.id_category AS pr_cat_cat_id,
	id_product AS pr_cat_pr_id,
	product.name AS productname,
	categories.id,
	categories.name,
	COUNT(product_category.id_category) AS quantity
FROM
	product
LEFT JOIN
	product_category
ON
	product_category.id_product = product.id
RIGHT JOIN
	(
SELECT
	*
FROM
	category
) AS categories
ON
	categories.id = product_category.id_category
GROUP BY name
ORDER BY id ASC";
	
	
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
	echo '<td class="table__cell"><span id="del-cat" class="link" data-cat-id="'.$category["id"].'">Удалить</span></td>';
}
else{
	echo '<td class="table__cell"></td>';
}
	echo '<td class="table__cell"><span id="edit-cat" class="link" data-cat-id="'.$category["id"].'">Просмотр</span></td>
 	  </tr>';
 }
// Конец таблицы
echo '</table>';

//Добавить категорию
echo '<form class="add">
		 <label for="cat-name"></label>
		 <input type="text" name="cat-name" id="cat-name">
		 <input type="button" id="add-cat" value="Добавить категорию">
	  </form>';
echo '<div id="results"></div>';
?>