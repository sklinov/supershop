<?php
require "db_connect.php";
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/supershop/img/product/';

$upd=[];

$upd["id"] = isset($_POST['id']) ? intval($_POST['id']) : NULL;
echo $upd["id"]."\n";

if($_FILES['file']['size']<=1048576) {
    if($_FILES['file']['type']=='image/jpeg' || 
       $_FILES['file']['type']=='image/png'  || 
       $_FILES['file']['type']=='image/svg'  ||
       $_FILES['file']['type']=='image/gif') 
    {
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            update_img_to_product($upd["id"],$_FILES['file']['name'],$mysqli);
            echo "Файл ". $_FILES['file']['name'] ." был успешно загружен.\n";
        } 
        else {
            echo "Ошибка загрузки файла:".$_FILES["file"]["error"];
        }
    }
    else {
        echo "Тип файла не подходит для загрузки. Выберите jpg, png, svg, gif\n";
    }
}
else {
    echo "Размер файла больше 1Мб и он не будет загружен \n";
}

function update_img_to_product($product_id,$url,$mysqli) {
    $q = 'INSERT INTO product_image(product_id,image_url) 
          VALUES ('.$product_id.',"/'.$url.'")';
	//echo $q."\n";
    if($mysqli->query($q) === TRUE)
	{
		echo "Изображение привязано к товару\n";
	}
	else
	{
		echo "Ошибка: ".$mysqli->error;
	}
}

?>