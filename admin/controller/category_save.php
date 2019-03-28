<?php
require "db_connect.php";
$upd=[];

$upd["id"] = isset($_POST['id']) ? intval($_POST['id']) : NULL;
$upd["name"] = isset($_POST['name']) ? $_POST['name'] : NULL;
$upd["title"] = isset($_POST['title']) ? $_POST['title'] : NULL;
$upd["description"] = isset($_POST['description']) ? $_POST['description'] : NULL;

//Update category
	$q = 'UPDATE category 
          SET name = "'.$upd["name"].'", 
              title = "'.$upd["title"].'", 
              description = "'.$upd["description"].'"  
          WHERE
            id='.$upd["id"];
    if($mysqli->query($q) === TRUE)
	{
		echo "Изменения сохранены";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}

?>