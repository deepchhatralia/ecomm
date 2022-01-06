<?php

session_start();
include '../includee/config.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_POST['fullAddress']) && isset($_POST['customername']) && isset($_POST['phone']) && isset($_POST['email'])) {
        include '../database.php';
        $obj = new Database();

        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];

        $fulladdress = mysqli_real_escape_string($conn, $_POST['fullAddress']);
        $customername = mysqli_real_escape_string($conn, $_POST['customername']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $result = $obj->select('*', 'cart', "user_id={$user_id}");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['product_id'];
                $quantity = $row['quantity'];
                $user_id = $_SESSION['user_id'];

                // Insert orders into 'orders' table 
                $result3 = $obj->insert('orders', ['customer_name' => $customername, 'user_id' => $user_id, 'customer_number' => $phone, 'customer_address' => $fulladdress, 'product_id' => $productId, 'quantity' => $quantity, 'customer_email' => $email]);

                // To update the product stock in 'products' table
                $result7 = $obj->select('*', 'products', "product_id='{$productId}'");
                $row7 = $result7->fetch_assoc();
                $product_stock = $row7['product_stock'] - $quantity;

                $result5 = $obj->update('products', ['product_stock' => $product_stock], "product_id='{$productId}'");
            }

            if ($result3) {
                // Clear the cart after order successfull placed 
                $result4 = $obj->delete('cart', "user_id={$user_id}");
                echo 'Order Placed. We will email you the details regarding your order.';
            } else {
                echo 'Error while placing an order';
            }

?>


<?php
        } else {
            include '../pagenotfound.php';
        }
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
}

?>