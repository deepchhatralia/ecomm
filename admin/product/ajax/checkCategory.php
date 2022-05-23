<?php

if (isset($_POST['category']) && $_POST['operation'] == "check category") {
    $category = $_POST['category'];

    include '../../../database.php';
    $obj = new Database();

    $result = $obj->select('*', "product_category", "category_name LIKE '{$category}'");

    if ($result->num_rows > 0) {
        echo "exist";
    } else {
        echo "do not exist";
    }
} else {
    include '../../../pagenotfound.php';
}
