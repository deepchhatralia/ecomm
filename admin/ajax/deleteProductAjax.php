<?php

session_start();

if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] == true) {
    if (isset($_POST['productId'])) {
        include '../../database.php';
        $obj = new Database();

        $productId = $_POST['productId'];

        $result = $obj->select('*', 'orders', "product_id='{$productId}'");

        if ($result->num_rows > 0) {
            echo 'active order';
        } else {
            $result = $obj->select('*', 'products', "product_id='{$productId}'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $path = '../../upload_img/' . $row['product_img'];
                if (unlink($path)) {
                    $result = $obj->delete('products', "product_id='{$productId}'");
                    if ($result) {
                        echo 'deleted';
                    } else {
                        echo 'error';
                    }
                }
            }
        }
    } else {
        include '../../pagenotfound.php';
    }
} else {
    include '../../pagenotfound.php';
}
