<?php

session_start();

if (isset($_POST['id']) && $_POST['operation'] == "addtocart") {
    if (isset($_SESSION['userlogin'])) {
        $userid = $_SESSION['userlogin'];
        $productId = $_POST['id'];
        $howmany = 1;

        include '../../database.php';
        $obj = new Database();

        $result = $obj->select('*', 'productt', 'product_id=' . $productId);
        $row = $result->fetch_assoc();

        $result = $obj->update('productt', ["product_stock" => $row['product_stock'] - 1], 'product_id=' . $productId);

        if ($row['product_stock'] > 0) {
            $result = $obj->select('*', 'cart', "userlogin_userid=" . $userid . " AND product_product_id=" . $productId);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['cart_quantity'] >= 10) {
                    echo "Maximum 10 quantity allowed";
                } else {
                    $howmany = $row['cart_quantity'] + 1;

                    $result = $obj->update('cart', ['cart_quantity' => $howmany, 'product_product_id' => $productId, 'userlogin_userid' => $userid], "userlogin_userid=" . $userid . " AND product_product_id=" . $productId);

                    if ($result) {
                        echo "Added to Cart";
                    } else {
                        echo "Please try again";
                    }
                }
            } else {
                $result = $obj->update('productt', ["product_stock" => $row['product_stock'] - 1], 'product_id=' . $productId);

                $result = $obj->insert('cart', ['cart_quantity' => $howmany, 'product_product_id' => $productId, 'userlogin_userid' => $userid]);

                if ($result) {
                    echo "Added to Cart";
                } else {
                    echo "Please try again";
                }
            }
        } else {
            echo "Out of stock";
        }
    } else {
        echo "Please login";
    }
} else if (isset($_POST['star']) && isset($_POST['product']) && $_POST['operation'] == "add rating") {
    $star = $_POST['star'];
    $productId = $_POST['product'];
    $userId = $_SESSION['userlogin'];

    include '../../database.php';
    $obj = new Database();

    $result = $obj->insert('rating', ["rating_star" => $star, "userlogin_userid" => $userId, "product_id" => $productId]);

    if ($result) {
        echo "added";
    } else {
        echo "try again";
    }
} else {
    include '../../pagenotfound.php';
}
