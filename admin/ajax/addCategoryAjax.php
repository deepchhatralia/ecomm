<?php

if (isset($_POST['category'])) {
    include '../../database.php';
    $obj = new Database();

    $category = mysqli_real_escape_string($obj->connection(), $_POST['category']);

    $result = $obj->select('*', 'product_category', "category_name='{$category}'");

    if ($result->num_rows > 0) {
        echo 'Category already exist';
    } else {
        $result = $obj->insert('product_category', ['category_name' => $category]);

        if ($result) {
            echo 'Added';
        } else {
            echo 'Try again...';
        }
    }
} else {
    include '../../pagenotfound.php';
}
