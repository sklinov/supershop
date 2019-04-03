<?php

$uploaddir = '/img/product/';

if($_FILES['file']['size']<=1048576) {
    if($_FILES['file']['type']=='image/jpeg' || 
       $_FILES['file']['type']=='image/png'  || 
       $_FILES['file']['type']=='image/svg'  ||
       $_FILES['file']['type']=='image/gif') 
    {
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
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


?>