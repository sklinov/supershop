<?php
$mysql_host = "94.154.12.56";
$mysql_user = "superstore";
$mysql_password = "wewrDMijWFA0yxZH";
$my_database = "superstore";

// Connecting to Database
$mysqli = new mysqli($mysql_host, $mysql_user, $mysql_password, $my_database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error;
}
?>