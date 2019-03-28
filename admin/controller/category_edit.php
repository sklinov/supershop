<?php
require "db_connect.php";

// $product_table = "product";
// $category_table = "category";
// $product_category_table = "product_category";

$cat_id = isset($_POST['cat-id']) ? intval($_POST['cat-id']) : false;




//Get category info
$cat_info=get_category_info($cat_id, $mysqli);

//Form and data
while ($cat = $cat_info->fetch_assoc()) {
    render_form($cat);
}

function render_form($category) {
// Заголовок
echo '<p>Редактирование категории</p>';
echo '<h1 class="title">'.$category["name"].'</h1>';
echo '
    <form class="form">
        <input type="hidden" id="cat-edit-id" value='.$category["id"].'>
        <label class="form__label">Наименование категории</label>
        <input type="text" class="form__input-field" id="cat-edit-name" value='.$category["name"].'><br>
        <label class="form__label">Заголовок категории</label>
        <input type="text" class="form__input-field" id="cat-edit-title" value='.$category["title"].'><br>
        <label class="form__label">Описание категории</label>
        <input type="text" class="form__input-field" id="cat-edit-desc" value='.$category["description"].'><br>
        <input type="button" class="button button-success" id="button-save" value="Сохранить">
        <input type="button" class="button button-secondary" id="button-cancel" value="Отменить">       
    </form>
     ';
echo '<div id="results"></div>';
}

function get_category_info($cat_id, $mysqli) {
    $q = 'SELECT
            id,
            name,
            IFNULL(title, "") AS title,
            IFNULL(description,"") AS description
            FROM
                category
            WHERE
                id = '.$cat_id;
    $result = $mysqli->query($q);
    if(isset($result)) {
        return $result;  
    }
    else
    {
        echo "Ошибка: ".$mysqli->error;  
    }
    // if($mysqli->query($q) === TRUE)
    // {
    //     $result = $mysqli->query($q);	
    // }
    // else
    // {
    //     echo "Ошибка: ".$mysqli->error;
    // }
    
    //return $result;    
}


// //Update category
// if($newcat) {
// 	$q = "INSERT INTO category VALUES (DEFAULT,\"".$newcat."\",DEFAULT,DEFAULT)";
//     if($mysqli->query($q) === TRUE)
// 	{
// 		echo "Категория ".$newcat." добавлена";
// 	}
// 	else
// 	{
// 		echo "Ошибка: ".$mysqli->error;
// 	}
// }
// else {
// 	echo "Введите имя категории";
// }





?>