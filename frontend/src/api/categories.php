<?php
require "db_connect.php";

$categories = get_all_categories($mysqli);
while($category = $categories->fetch_assoc()) {
    echo json_encode($category);
}

function get_all_categories($mysqli) {
    $q = "SELECT * from category";
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