<?php
require "db_connect.php";

$orders = all_orders($mysqli);

//var_dump($orders);

// Заголовок
echo '<h1 class="title">Заказы</h1>';

// Таблица с покупателями
echo '<table class="table">';
// Заготовок таблицы
echo '<tr class="table__row">
		<th class="table__head">Номер заказа</th>
		<th class="table__head">Статус</th>
        <th class="table__head">Сумма</th>
        <th class="table__head">Время заказа</th>
        <th class="table__head"></th>
	  </tr>';
// Тело таблицы
while($order = $orders->fetch_assoc()) {
	echo '<tr class="table__row">
		<td class="table__cell">№'.$order["id"].' от <span class="table__cell-bold">'.$order["email"].'</span></td>
        <td class="table__cell" style="color:'.$order["status_color"].'">'.$order["status"].'</td>
        <td class="table__cell table__cell-bold">'.$order["total"].' руб.</td>
        <td class="table__cell">'.$order["datetime"].'</td>
 		<td class="table__cell"><span class="edit-order link" data-id="'.$order["id"].'">Просмотр</span></td>
 	  </tr>';
 }
// Конец таблицы
echo '</table>';

function all_orders($mysqli){
    $q = "SELECT
                orders.id AS id,
                orders.datetime AS datetime,
                orders.total AS total,
                user.email AS email,
                status.status AS status,
                status.color AS status_color
            FROM
                orders
            JOIN
                user
            ON
                user.id = orders.id_user
            JOIN
                status
            ON
                status.id = orders.id_status";
    //var_dump($q);
    //echo $mysqli->error;
    $result = $mysqli->query($q);
    if(isset($result)) {
        return $result;  
    }
    else
    {
        echo "Ошибка: ".$mysqli->error;  
    }
}
?>