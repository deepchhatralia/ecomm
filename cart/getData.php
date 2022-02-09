<?php
session_start();
if (isset($_SESSION['userlogin'])) {
    if (isset($_POST['id']) && $_POST['operation'] == 'removeItem') {
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $userId = $_SESSION['userlogin'];

        include '../database.php';
        $obj = new Database();

        $result = $obj->select('*', 'productt');
        $row = $result->fetch_assoc();

        $result = $obj->update('productt', ["product_stock" => $row['product_stock'] + $qty], "product_id=" . $id);

        $result = $obj->delete('cart', "userlogin_userid=" . $userId . " AND product_product_id=" . $id);

        if ($result == 1) {
            echo "Removed";
        } else {
            echo 'Try again...';
        }
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
}
