<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_POST['quantityInCart']) && isset($_POST['productId'])) {
        include '../database.php';
        $obj = new Database();

        $quantityInCart = $_POST['quantityInCart'];
        $productId = $_POST['productId'];
        $user_id = $_SESSION['user_id'];

        $result = $obj->update('cart', ['quantity' => $quantityInCart], "user_id={$user_id} AND product_id='{$productId}'");
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
}
