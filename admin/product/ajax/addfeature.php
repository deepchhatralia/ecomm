<?php

if (isset($_POST['feature']) && isset($_POST['product'])) {
    include '../../../database.php';
    $obj = new Database();

    $feature = $_POST['feature'];
    $product = $_POST['product'];

    $result = $obj->insert('product_feature', ['product_feature' => $feature, 'productId' => $product]);

    if ($result) {
        echo 'Added';
    } else {
        // echo 'Please try again';
        echo mysqli_error($obj->connection());
    }
}
