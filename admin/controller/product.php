<?php

// Заголовок
echo '<h1 class="title">Товары</h1>';
// Текущая категория
echo '<label for="catdropdown" class="label">Текущая категория</label>';
echo '<select class="catdropdown" id="catdropdown">
		<option>Категория 1</option>
		<option>Категория 2</option>
		<option>Категория 3</option>
	  </select>';
// Таблица с товарами
echo '<table class="table">';
// Заготовок таблицы
echo '<tr class="table__row">
		<th class="table__head">Название товара</th>
		<th class="table__head">Стоимость</th>
		<th class="table__head"></th>
	  </tr>';
// Тело таблицы
echo '<tr class="table__row">
		<td class="table__cell">Название товара 1</td>
		<td class="table__cell">4953 руб.</td>
		<td class="table__cell"><a href="">Просмотр</a></td>
	  </tr>';
// Конец таблицы
echo '</table>';


include 'controller/db.php';
?>