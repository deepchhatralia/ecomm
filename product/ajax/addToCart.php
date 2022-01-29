<?php

session_start();

if (isset($_SESSION['userlogin']) && isset($_POST['id'])) {
    $userid = $_SESSION['userlogin'];
    $productId = $_POST['id'];
    $howmany = 1;

    include '../../database.php';
    $obj = new Database();

    $result = $obj->select('*', 'cart', "userlogin_userid=" . $userid . " AND product_product_id=" . $productId);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $howmany = $row['cart_quantity'] + 1;

        $result = $obj->update('cart', ['cart_quantity' => $howmany, 'product_product_id' => $productId, 'userlogin_userid' => $userid], "userlogin_userid=" . $userid . " AND product_product_id=" . $productId);
    } else {
        $result = $obj->insert('cart', ['cart_quantity' => $howmany, 'product_product_id' => $productId, 'userlogin_userid' => $userid]);
    }


    if ($result) {
        echo "Added to Cart";
    } else {
        echo "Please try again";
    }
} else {
    echo false;
}
