<?php

if (isset($_POST['category']) && $_POST['operation'] == 'add') {
    include '../../../database.php';
    $obj = new Database();

    $category = $_POST['category'];

    $result = $obj->insert('product_category', ['category_name' => $category]);

    if ($result) {
        echo 'Added';
    } else {
        // echo 'Please try again';
        echo mysqli_error($obj->connection());
    }
}
