<?php
session_start();
if (isset($_SESSION['userlogin'])) {
    if (isset($_POST['id']) && $_POST['operation'] == 'removeItem') {
        $id = $_POST['id'];
        $userId = $_SESSION['userlogin'];

        include '../database.php';
        $obj = new Database();

        $result = $obj->delete('cart', "userlogin_userid=" . $userId . " AND product_product_id=" . $id);

        if ($result) {
            echo "Removed";
        } else {
            echo 'Try again';
        }
    } else {
        include '../pagenotfound.php';
    }
} else {
    // include '../pagenotfound.php';
    echo "log";
}
