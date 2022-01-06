<?php
session_start();

if (isset($_SESSION['user_id'])) {

    if (isset($_POST['id'])) {
        include '../database.php';
        $obj = new Database();

        $id = $_POST['id'];
        $user_id = $_SESSION['user_id'];

        $result = $obj->select('*', 'cart', "product_id='{$id}' AND user_id={$user_id}");
        if ($result->num_rows > 0) {
            $result = $obj->select('*', 'cart', "user_id={$user_id} AND product_id='{$id}'");
            $row = $result->fetch_assoc();
            $quantity = $row['quantity'] + 1;

            $result = $obj->update('cart', ['quantity' => $quantity], "user_id={$user_id} AND product_id='{$id}'");
        } else {
            $result = $obj->insert('cart', ['user_id' => $user_id, 'product_id' => $id]);
        }
        // For item added to cart popup 
        if ($result) {
            echo 'Added';
        } else {
            echo 'Please try again';
        }
    }
} else {
    echo 'Please login';
}
