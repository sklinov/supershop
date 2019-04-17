<?php
require "db_connect.php";

$categories = get_all_categories($mysqli);

$data = [];
while($category = $categories->fetch_assoc()) {
    $data["categories"][] = $category;
}
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($data,true);


function get_all_categories($mysqli) {
    $q = "SELECT * from category";
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