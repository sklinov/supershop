<?php
require "db_connect.php";

$_POST = json_decode(file_get_contents('php://input'), true);
$default = 8;
$id = isset($_POST['id']) ? $_POST['id'] : $default;
$id = json_decode($id,true);

$products = get_product_by_id($mysqli, $id);
$images   = get_images_by_product_id($mysqli,$id);

$data = [];

while($product = $products->fetch_assoc()) {
    $data["product"] = $product;
}
while($image = $images->fetch_assoc()) {
    $data["images"] = $image;
}
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($data,true);


function get_product_by_id($mysqli, $id) {
    $q =   "SELECT
                product.id AS id,
                product.name AS name,
                product.description AS description,
                product.sku AS sku,
                product.price AS price,
                product.old_price AS old_price,
                product.quantity AS quantity,
                product_image.id AS image_id,
                badge.name AS badge_name,
                badge.color AS badge_color
            FROM
                product
            JOIN
                product_image
            ON
                product_image.product_id = product.id
            JOIN
                badge
            ON
                badge.id = product.badge_id    
            WHERE
                product.id = ".$id."
            GROUP BY
                product.id";
    $result = $mysqli->query($q);
    if(isset($result)) {
        return $result;  
    }
    else
    {
        echo "SQL Error: ".$mysqli->error;  
    }
}

function get_images_by_product_id($mysqli,$id) {
    $q =   "SELECT
                *
            FROM
                product_image 
            WHERE
                product_id = ".$id;
    $result = $mysqli->query($q);
    if(isset($result)) {
        return $result;  
    }
    else
    {
        echo "SQL Error: ".$mysqli->error;  
    }
}

?>