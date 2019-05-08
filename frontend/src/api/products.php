<?php
require "db_connect.php";

$_POST = json_decode(file_get_contents('php://input'), true);
$default = "TRUE";
$id = isset($_POST['id']) ? $_POST['id'] : $default;
$id = json_decode($id,true);

$products = get_all_products_by_category_id($mysqli, $id);
$category = get_category_info_by_id($mysqli, $id);


$data = [];
while($product = $products->fetch_assoc()) {
    $data["products"][] = $product;
}

while($cat = $category->fetch_assoc()) {
    $data["category"] = $cat;
}

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($data,true);


function get_all_products_by_category_id($mysqli, $id) {
    $q = "SELECT
                product_category.id_category AS id_category,
                product.id AS id,
                product.name AS name,
                product.price AS price,
                product_image.image_url AS image_url,
                badge.name AS badge_name,
                badge.color AS badge_color
            FROM 
                product_category
            JOIN
                product
            ON
                product.id = product_category.id_product
            JOIN
                product_image
            ON
                product_image.product_id = product.id AND product_image.image_main = 1
            JOIN
                badge
            ON
                badge.id = product.badge_id
            WHERE
                product_category.id_category = ".$id."
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

function get_category_info_by_id($mysqli, $id) {
    $q = "SELECT 
            *
            FROM category
            WHERE id=".$id;
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