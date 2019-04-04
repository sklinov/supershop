<?php
require "db_connect.php";

$upd=[];

$upd["id"] = isset($_POST['id']) ? intval($_POST['id']) : NULL;

//var_dump($upd["id"],"  ---  ",$upd["img_id"]);

delete_user($upd["id"], $mysqli);

function delete_user($id, $mysqli) {
    $q = 'DELETE from user 
          WHERE id='.$id;
	//echo $q."\n";
    if($mysqli->query($q) === TRUE)
	{
		echo "Пользователь удален\n";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}
}

?>