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

echo '<p>Редактирование категории</p>';
echo '<h1 class="title">'.$category["name"].'</h1>';
echo '
    <form class="form">
        <input type="hidden" id="cat-edit-id" value="'.$category["id"].'">
        <label class="form__label" for="cat-edit-name">Наименование категории</label><br>
        <input type="text" size="55" class="form__input-field" id="cat-edit-name" value="'.$category["name"].'"><br>
        <label class="form__label" for="cat-edit-title">Заголовок категории</label><br>
        <input type="text" size="55" class="form__input-field" id="cat-edit-title" value="'.$category["title"].'"><br>
        <label class="form__label" for="cat-edit-desc">Описание категории</label><br>
        <textarea class="form__input-field" id="cat-edit-desc" rows="5" cols="50" value="'.$category["description"].'"></textarea><br>
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
}

?>