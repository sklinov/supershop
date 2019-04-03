<?php
require "db_connect.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : false;

//Get category info
$info=get_product_info($id, $mysqli);

$im=get_product_images($id, $mysqli);

//Form and data
while ($pr = $info->fetch_assoc()) {
    render_form($pr,$im);
}

function render_form($product,$images) {
    //Read badge id and set checked attribute value
    for($i=7;$i<=10;$i++) { $checked[$i]="";}
    $checked[intval($product["badge_id"])]="checked";
    //Render main form
    echo '<h1 class="title">Просмотр товара</h1>';
    echo '
        <form class="form" name="pr-edit" enctype="multipart/form-data">
            <input type="hidden" id="pr-edit-id" value="'.$product["id"].'">
            <div class="card">
                <div class="card__title">
                    Информация о товаре
                </div>
                <div class="card__cont">
                    <div class="card__col">
                        <label class="form__label" for="pr-edit-name">Наименование товара</label><br>
                        <input type="text" size="55" class="form__input-field" id="pr-edit-name" value="'.$product["name"].'"><br>
                        <label class="form__label" for="pr-edit-desc">Описание товара</label><br>
                        <textarea class="form__input-field" id="pr-edit-desc" rows="5" cols="50">'.$product["description"].'</textarea><br>
                        <label class="form__label" for="pr-edit-sku">Штрих-код</label><br>
                        <input type="text" size="55" class="form__input-field" id="pr-edit-sku" value="'.$product["sku"].'"><br>
                        <label class="form__label" for="pr-edit-price">Цена</label>
                        <input type="text" size="20" class="form__input-field" id="pr-edit-price" value="'.$product["price"].'">
                        <label class="form__label" for="pr-edit-old-price">Цена до скидки</label>
                        <input type="text" size="20" class="form__input-field" id="pr-edit-old-price" value="'.$product["old_price"].'"><br>
                        <label class="form__label" for="pr-edit-quantity">Кол-во</label>
                        <input type="text" size="10" class="form__input-field" id="pr-edit-quantity" value="'.$product["quantity"].'"><br>
                    </div>
                    <div class="card__col">
                        <label class="form__label" for="pr-edit-badge">Бейджик</label><br>
                        <input type="radio" name="pr-edit-badge" value="7" '.$checked[7].'>Отсутствует</input><br>
                        <input type="radio" name="pr-edit-badge" value="8" '.$checked[8].'>NEW</input><br>
                        <input type="radio" name="pr-edit-badge" value="9" '.$checked[9].'>HOT</input><br>
                        <input type="radio" name="pr-edit-badge" value="10" '.$checked[10].'>SALE</input><br>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card__title">
                    Фотографии товара
                </div>
                <div class="card__cont">';
                    render_images($product["id"],$images);
                    render_upload($product["id"]);
                    echo '
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


function render_images($product_id, $images) {
    $IMG_DIR = "../img/product";
    while ($img = $images->fetch_assoc()) {
        $url=html_entity_decode($IMG_DIR.$img["image_url"]);
        echo '
            <div class="card__imageblock">
                <div class="card__image" style="background-image:url('.$url.');"></div>
                <span class="link link-success" id="img-change">Изменить</span>
                <span class="link link-danger" id="img-delete">Удалить</span>
            </div>
        '; 
        // echo $img["product_id"]."\n";
        // echo $img["image_url"]."\n";
        // echo $img["image_main"]."\n";
    }
}

function render_upload($product_id) {
        $IMG_DIR = "../img/product";
        $UPLOAD_IMG="/upload.png";
        $url=html_entity_decode($IMG_DIR.$UPLOAD_IMG);   
        echo '
        <div class="card__imageblock">
            <div class="card__image" style="background-image:url('.$url.');"></div>
            <input type="file" id="img-upload-file"></input>
            <span class="link" id="img-upload">Загрузить</span>
        </div>
';
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

function get_product_images($id, $mysqli) {
    $q = 'SELECT
            *
            FROM
                product_image
            WHERE
                product_id = '.$id;
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