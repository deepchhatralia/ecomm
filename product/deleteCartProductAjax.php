<?php


session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_POST['productId'])) {
        include '../database.php';
        $obj = new Database();
        $userId = $_SESSION['user_id'];
        $productId = $_POST['productId'];

        $result = $obj->delete('cart', "product_id='{$productId}' AND user_id={$userId}");

        if ($result) {
            echo "<script>alert('Deleted');</script>";
        } else {
            echo "<script>alert('Error');</script>";
        }
    } else {
        echo '<h1>Page not found</h1>';
    }
} else {
    include '../pagenotfound.php';
}
