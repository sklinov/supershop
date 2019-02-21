<?php
$mysql_host = "localhost";
$mysql_user = "superstore";
$mysql_password = "wewrDMijWFA0yxZH";
$my_database = "superstore";

$my_table = "product";

$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}

$res = $mysqli->query("SELECT * FROM ".$my_table);
$row = $res->fetch_assoc();
echo $row;


?>