<?php
require "db_connect.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : false;

//Get category info
$info=get_product_info($id, $mysqli);

//Form and data
while ($pr = $info->fetch_assoc()) {
    render_form($pr);
}

function render_form($product) {

echo '<h1 class="title">Просмотр товара</h1>';
echo '
    <form class="form">
        <input type="hidden" id="cat-edit-id" value="'.$product["id"].'">
        <div class="card">
            <div class="card__title">
                Информация о товаре
            </div>
            <div class="card__cont">
                <label class="form__label" for="pr-edit-title">Наименование товара</label><br>
                <input type="text" size="55" class="form__input-field" id="pr-edit-title" value="'.$product["name"].'"><br>
                <label class="form__label" for="pr-edit-desc">Описание товара</label><br>
                <textarea class="form__input-field" id="pr-edit-desc" rows="5" cols="50" value="'.$product["description"].'"></textarea><br>
            </div>
        </div>
        <div class="card">
            <div class="card__title">
                Фотографии товара
            </div>
            <div class="card__cont">
                
            </div>
        </div>
        <div class="card">
            <div class="card__title">
                Вариации товара
            </div>
            <div class="card__cont">
                
            </div>
        </div>
        <input type="button" class="button button-success" id="button-save-product" value="Сохранить">
        <input type="button" class="button button-secondary" id="button-cancel-product" value="Отменить">
        <input type="button" class="button button-danger" id="button-delete" value="Удалить">
        
    </form>
     ';
echo '<div id="results"></div>';
}

function get_product_info($id, $mysqli) {
    $q = 'SELECT
            *
            FROM
                product
            WHERE
                id = '.$id;
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