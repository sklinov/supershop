<?php
require "db_connect.php";

$users = all_users($mysqli);

// Заголовок
echo '<h1 class="title">Покупатели</h1>';

// Таблица с покупателями
echo '<table class="table">';
// Заготовок таблицы
echo '<tr class="table__row">
		<th class="table__head">Имя</th>
		<th class="table__head">E-mail</th>
        <th class="table__head">Телефон</th>
        <th class="table__head"></th>
	  </tr>';
// Тело таблицы
while($user = $users->fetch_assoc()) {
	echo '<tr class="table__row">
		<td class="table__cell">'.$user["name"].'</td>
        <td class="table__cell">'.$user["email"].'</td>
        <td class="table__cell">'.$user["phone"].'</td>
 		<td class="table__cell"><span class="edit-user link" data-id="'.$user["id"].'">Просмотр</span></td>
 	  </tr>';
 }
// Конец таблицы
echo '</table>';

function all_users($mysqli){
    $q = "SELECT id, name, email, phone FROM user";
    $res = $mysqli->query($q);
	return $res;
}

?>