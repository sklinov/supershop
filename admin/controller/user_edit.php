<?php
require "db_connect.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : false;

$user_info = get_user_info($id, $mysqli);

while ($us = $user_info->fetch_assoc()) {
    render_form($us,$mysqli);
}

function render_form($user,$mysqli)
{
    echo '<h1 class="title">Просмотр пользователя</h1>';
    echo '
        <form class="form" name="user-edit" enctype="multipart/form-data">
            <input type="hidden" id="user-edit-id" value="'.$user["id"].'">
            <div class="card">
                <div class="card__title">
                    Информация о пользователе
                </div>
                <div class="card__cont">
                    <div class="card__col">
                        <label class="form__label" for="user-edit-name">ФИО:</label><br>
                        <input type="text" size="55" class="form__input-field" id="user-edit-name" value="'.$user["name"].'"><br>
                        <label class="form__label" for="user-edit-phone">Телефон:</label><br>
                        <input type="text" size="55" class="form__input-field" id="user-edit-phone" value="'.$user["phone"].'"><br>
                        <label class="form__label" for="user-edit-email">E-mail:</label><br>
                        <input type="text" size="55" class="form__input-field" id="user-edit-email" value="'.$user["email"].'"><br>           
                    </div>
                    <div class="card__col">
                        <label class="form__label" for="user-edit-city">Город</label><br>
                        <input type="text" size="20" class="form__input-field" id="user-edit-city" value="'.$user["city"].'"><br>
                        <label class="form__label" for="user-edit-street">Улица</label><br>
                        <input type="text" size="20" class="form__input-field" id="user-edit-street" value="'.$user["street"].'"><br>
                        <label class="form__label" for="user-edit-building">Дом</label>
                        <input type="text" size="10" class="form__input-field" id="user-edit-building" value="'.$user["building"].'"><br>
                        <label class="form__label" for="user-edit-flat">Квартира/офис</label>
                        <input type="text" size="10" class="form__input-field" id="user-edit-flat" value="'.$user["flat"].'"><br>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card__title">
                    История заказов
                </div>
                <div class="card__cont">';
                    $orders=get_orders_info($user["id"],$mysqli);
                    $number_of_orders = $orders->num_rows;
                    //var_dump($orders->num_rows);
                    $user_totals = 0;
                    if($number_of_orders > 0) {
                        echo '
                        <table class="table table-fixed">
                        <tr class="table__row"></tr>
                        ';
                        while ($order = $orders->fetch_assoc()) {
                            $user_totals+=$order["total"];
                            echo '
                            <tr class="table__row">
                                <td class="table__cell">'.$order["id"].'</td>
                                <td class="table__cell">'.$order["total"].'</td>
                                <td class="table__cell">'.$order["datetime"].'</td>
                                <td class="table__cell"><span class="link" id="edit-order" data-id="'.$order["id"].'">Просмотр</span></td>
                            </tr>
                            ';
                        }
                        echo '
                        <tr class="table__row">
                                <td class="table__cell" colspan="3">Итоговая сумма заказов</td>
                                <td class="table__cell"><span class="title">'.$user_totals.'</span>руб.</td>
                        </tr>
                        </table>';
                    }
                    else {
                        echo "У данного пользователя еще не было заказов";
                    }
                echo '
                </div>
            </div>
           
            <input type="button" class="button button-success" id="button-save-user" value="Сохранить">
            <input type="button" class="button button-secondary" id="button-cancel-user" value="Отменить">
            <input type="button" class="button button-danger" id="button-delete-user" value="Удалить" data-number-of-orders="'.$number_of_orders.'">      
        </form>
        ';
    echo '<div id="results"></div>';


}

function get_user_info($id, $mysqli) {
    $q = 'SELECT
            *
            FROM
                user
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

function get_orders_info($id, $mysqli) {
    $q = 'SELECT
            *
            FROM
                orders
            WHERE
                id_user = '.$id;
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