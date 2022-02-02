<?php
session_start();

if (isset($_SESSION['userlogin'])) {
    $userId = $_SESSION['userlogin'];

    include '../../database.php';
    $obj = new Database();

    if (isset($_POST['id']) && $_POST['operation'] == "addToWishlist") {
        $id = $_POST['id'];
        $userId = $_SESSION['userlogin'];

        $result = $obj->insert('wishlist', ['userlogin_userid' => $userId, 'product_id' => $id]);

        if ($result) {
            echo "Added to wishlist";
        } else {
            echo "Try again...";
        }
    } else if (isset($_POST['id']) && $_POST['operation'] == "removeFromWishlist") {
        $id = $_POST['id'];

        $result = $obj->delete('wishlist', 'userlogin_userid=' . $userId . ' AND product_id=' . $id);

        if ($result) {
            echo "Removed from wishlist";
        } else {
            echo "Try again...";
        }
    } else if (isset($_POST['id']) && $_POST['operation'] == "removeItem") {
        $id = $_POST['id'];

        $result = $obj->delete('wishlist', 'userlogin_userid=' . $userId . ' AND product_id=' . $id);

        if ($result) {
            echo "Removed from wishlist";
        } else {
            echo false;
        }
    } else {
        include '../../pagenotfound.php';
    }
} else {
    include '../../pagenotfound.php';
}
