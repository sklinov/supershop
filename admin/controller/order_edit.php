<?php
require "db_connect.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : false;

$order_info = get_order_info($id, $mysqli);

while ($or = $order_info->fetch_assoc()) {
    render_form($or,$mysqli);
}

function render_form($order,$mysqli) {
    echo '<h1 class="title">Заказ №'.$order["id"];
    echo '<select name="order-edit-id-status" class="form__input-field form__input-select font-medium">';
    $status_info = get_status_info($mysqli);
                    while ($status = $status_info->fetch_assoc()) {
                        echo '
                        <option class="status-option" value="'.$status["id"].'" ';
                        if($status["id"]==$order["id_status"]) {echo 'selected';}
                        echo ' style="color:'.$status["color"].'" >'.$status["status"].'</option>
                        ';
                    }    
    echo '</select></h1>';
    
    echo '
        <form class="form" name="order-edit" enctype="multipart/form-data">
            <input type="hidden" id="order-edit-id" value="'.$order["id"].'">
            
            <div class="card">
                <div class="card__title">
                    Содержимое заказа
                </div>
                <div class="card__cont">';
                    $products=get_order_product_info($order["id"],$mysqli);
                    $order_total = 0;
                        echo '
                        <table class="table">
                        <tr class="table__row"></tr>
                        ';
                        while ($product = $products->fetch_assoc()) {
                            $product_sum = floatval($product["price"]) * floatval($product["quantity"]);
                            $order_total+= $product_sum;
                            echo '
                            <tr class="table__row products">
                                <td class="table__cell table__cell-blue">'.$product["name"].'
                                <input type="hidden" name="order-edit-product-id" value="'.$product["id"].'"></td>
                                <td class="table__cell">'.$product["price"].' руб.
                                <input type="hidden" name="order-edit-product-price" value="'.$product["price"].'"></td>
                                <td class="table__cell"><input type="text" name="order-edit-product-quantity" size="2" value="'.$product["quantity"].'"></input></td>
                                <td class="table__cell" id="order-edit-product-sum">'.$product_sum.' .руб</td>
                                <td class="table__cell"><span class="link link-danger product-delete" data-product-id="'.$order["id"].'">Убрать из заказа</span></td>
                            </tr>
                            ';
                        }
                        echo '
                        <tr class="table__row">
                                <td class="table__cell" colspan="4">Итоговая сумма</td>
                                <td class="table__cell"><span class="title" id="order-total">'.$order_total.'</span>руб.</td>
                        </tr>
                        </table>
                        <input type="hidden" id="order-edit-total" value="'.$order_total.'">';
                    
                    
                echo '
                </div>
            </div>

            
            <div class="card">
                <div class="card__title">
                    Информация о заказе
                </div>
                <div class="card__cont">
                    <div class="card__col card__col-three">
                        <input type="hidden" id="order-edit-id-user" value="'.$order["id_user"].'">
                        <label class="form__label" for="order-edit-name">ФИО:</label><br>
                        <input type="text" size="35" class="form__input-field" id="order-edit-name" value="'.$order["name"].'"><br>
                        <label class="form__label" for="order-edit-phone">Телефон:</label><br>
                        <input type="text" size="35" class="form__input-field" id="order-edit-phone" value="'.$order["phone"].'"><br>
                        <label class="form__label" for="order-edit-email">E-mail:</label><br>
                        <input type="text" size="35" class="form__input-field" id="order-edit-email" value="'.$order["email"].'"><br>           
                    </div>
                    <div class="card__col card__col-three">
                        <label class="form__label" for="order-edit-city">Город</label><br>
                        <input type="text" size="35" class="form__input-field" id="order-edit-city" value="'.$order["city"].'"><br>
                        <label class="form__label" for="order-edit-street">Улица</label><br>
                        <input type="text" size="35" class="form__input-field" id="order-edit-street" value="'.$order["street"].'"><br>
                        <label class="form__label" for="order-edit-building">Дом</label>
                        <input type="text" size="3" class="form__input-field" id="order-edit-building" value="'.$order["building"].'"><br>
                        <label class="form__label" for="order-edit-flat">Квартира/офис</label>
                        <input type="text" size="3" class="form__input-field" id="order-edit-flat" value="'.$order["flat"].'"><br>
                    </div>
                    <div class="card__col card__col-three">
                    <label class="form__label" for="order-edit-shipping">Способ доставки</label><br>
                        <select id="order-edit-shipping" name="order-edit-shipping" class="form__input-field form__input-select">';
                    $shipping_info = get_shipping_info($mysqli);
                    while ($shipping = $shipping_info->fetch_assoc()) {
                        echo '
                        <option class="shipping-option" value="'.$shipping["id"].'" ';
                        if($shipping["id"]==$order["id_shipping"]) {echo 'selected';}
                        echo '>'.$shipping["shipping"].'</option>
                        ';
                    }
                    echo '
                        </select>
                    </div>
                    <label class="form__label" for="order-edit-comment">Комментарий к заказу</label><br>
                    <textarea id="order-edit-comment" class="form__input-field" rows="3" cols="30">'.$order["comment"].'</textarea>
                </div>
            </div>
                     
            <input type="button" class="button button-success" id="button-save-order" value="Сохранить">
            <input type="button" class="button button-secondary" id="button-cancel-order" value="Отменить">
            <input type="button" class="button button-danger" id="button-delete-order" value="Удалить" data-number-of-orders="'.$number_of_orders.'">      
        </form>
        ';
    echo '<div id="results"></div>';
}

function get_order_info($id, $mysqli) {
    $q = 'SELECT 
                orders.id AS id, 
                orders.id_status AS id_status,
                status.status AS status,
                status.color AS status_color, 
                orders.id_user AS id_user,
                user.name AS name, 
                user.phone AS phone,
                user.email AS email,
                user.city AS city,
                user.street AS street,
                user.building AS building,
                user.flat AS flat,
                orders.id_shipping AS id_shipping,
                orders.comment AS comment
            FROM orders
            JOIN user ON user.id=orders.id_user
            JOIN status ON status.id=orders.id_status
            WHERE orders.id = '.$id;
    //echo $q."\n";
    $result = $mysqli->query($q);
    if(isset($result)) {
        return $result;  
    }
    else
    {
        echo "Ошибка: ".$mysqli->error;  
    }
}

function get_order_product_info($id_order, $mysqli) {
    $q = 'SELECT 
                product.id AS id,
                product.name AS name, 
                order_product.price AS price, 
                order_product.quantity AS quantity 
            FROM order_product 
            JOIN product 
                ON product.id=order_product.id_product 
            WHERE id_order = '.$id_order;
    $result = $mysqli->query($q);
    if(isset($result)) {
        return $result;  
    }
    else
    {
        echo "Ошибка: ".$mysqli->error;  
    }
}

function get_shipping_info($mysqli) {
    $q = 'SELECT
            *
            FROM
                shipping';
    $result = $mysqli->query($q);
    if(isset($result)) {
        return $result;  
    }
    else
    {
        echo "Ошибка: ".$mysqli->error;  
    }
}

function get_status_info($mysqli) {
    $q = 'SELECT
            *
            FROM
                status';
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