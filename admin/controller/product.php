<?php
require 'db.php';
// Заголовок
echo '<h1 class="title">Товары</h1>';
// Текущая категория
echo '<form method="post" action="" >
	  <label for="catdropdown" class="label">Текущая категория</label>
	  <select class="catdropdown" id="catdropdown" name="catdropdown">';
		while($category = $cats->fetch_assoc()) {
		echo "<option value=".$category["id"].">".$category["name"]."</option>";
		}
echo '</select>
<input type="submit" value="Выбрать категорию">
</form>';
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
 		<td class="table__cell"><a href="">Просмотр</a></td>
 	  </tr>';
 }
// Конец таблицы
echo '</table>';

?>