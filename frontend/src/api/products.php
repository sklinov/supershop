<?php
require "db_connect.php";

$products = get_all_products($mysqli);

$data = [];
while($product = $products->fetch_assoc()) {
    $data["products"][] = $product;
}
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($data,true);


function get_all_products($mysqli) {
    $q = "SELECT * FROM product JOIN product_image ON product_image.product_id=product.id";
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