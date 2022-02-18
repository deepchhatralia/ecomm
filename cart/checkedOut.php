<?php

session_start();

if (isset($_SESSION['userlogin'])) {
    if (isset($_POST['operation']) && $_POST['operation'] == "payment done") {
        include '../database.php';
        $obj = new Database();

        $result = $obj->insert('order', ['shipping_address' => $_POST['address'], 'total' => $_POST['total'], 'userlogin_userid' => $_SESSION['userlogin']]);


        if ($result) {
            $maxOrderId = $obj->select('max(order_id)', 'order');
            $row = $maxOrderId->fetch_assoc();

            $orderShipping = $obj->insert('order_shipping', ['fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'email' => $_POST['email'], 'area_id' => $_POST['areaId'], 'pincode' => $_POST['pincode'], 'address' => $_POST['address'], 'order_id' => $row['max(order_id)']]);

            if ($orderShipping) {
                $cartItems = $obj->select('*', 'cart', 'userlogin_userid=' . $_SESSION['userlogin']);
                if ($cartItems->num_rows > 0) {
                    while ($cartRow = $cartItems->fetch_assoc()) {
                        $orderDetail = $obj->insert('order_detail', ['order_quantity' => $cartRow['cart_quantity'], 'order_order_id' => $row['max(order_id)'], 'product_id' => $cartRow['product_product_id']]);
                    }

                    $removeCart = $obj->delete('cart', "userlogin_userid=" . $_SESSION['userlogin']);

                    if ($removeCart) {
                        echo "Done";
                    }
                }
            }
        }
    }
    // else {
    //     include '../pagenotfound.php';
    // }
} else {
    echo "Please login";
}
