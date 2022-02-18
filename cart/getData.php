<?php
session_start();
if (isset($_SESSION['userlogin'])) {
    include '../database.php';
    $obj = new Database();

    if (isset($_POST['id']) && $_POST['operation'] == 'removeItem') {
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $userId = $_SESSION['userlogin'];


        $result = $obj->select('*', 'productt', "product_id=" . $id);
        $row = $result->fetch_assoc();

        $result = $obj->update('productt', ["product_stock" => $row['product_stock'] + $qty], "product_id=" . $id);

        $result = $obj->delete('cart', "userlogin_userid=" . $userId . " AND product_product_id=" . $id);

        if ($result == 1) {
            echo "Removed";
        } else {
            echo 'Try again...';
        }
    } else if (isset($_POST['operation']) && $_POST['operation'] == "user details for order") {
        $result = $obj->select('*', 'userlogin', "userid=" . $_SESSION['userlogin']);

        if ($result->num_rows > 0) {

            $userRow = $result->fetch_assoc();
            $areaId = $userRow['area_idarea'];

            $result = $obj->sql("SELECT * FROM `area` JOIN `city` ON `city`.`idcity`=`area`.`city_idcity` JOIN `state` ON `city`.`state_idstate`=`state`.`idstate` WHERE `idarea`=" . $areaId);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $arr = [$userRow['user_firstname'], $userRow['user_lastname'], $userRow['user_email'], $userRow['address'], $userRow['pincode'], $row['idarea'], $row['idcity'], $row['idstate'], $row['area'], $row['city_name'], $row['state_name']];

                echo json_encode($arr);
            }
        }
    } else if (isset($_POST['qty']) && isset($_POST['productId']) && $_POST['operation'] == 'update qty from cart') {
        $qty = $_POST['qty'];
        $productId = $_POST['productId'];

        // $result = $obj->select('*', 'cart', "userlogin_userid=" . $_SESSION['userlogin'] . " AND product_product_id=" . $productId);

        $result = $obj->sql("SELECT * FROM `productt` JOIN `cart` ON `cart`.`product_product_id`=`productt`.`product_id` WHERE `userlogin_userid`=" . $_SESSION['userlogin'] . " AND `product_product_id`=" . $productId);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $orignalCartQty = $row['cart_quantity'];
            $productStock = $row['product_stock'];

            if ($orignalCartQty < $qty) {
                $updatedQty = $qty - $orignalCartQty;
                $result2 = $obj->update('productt', ['product_stock' => $productStock - $updatedQty], "product_id=" . $productId);
            } else if ($orignalCartQty > $qty) {
                $updatedQty = $orignalCartQty - $qty;
                $result2 = $obj->update('productt', ['product_stock' => $productStock + $updatedQty], "product_id=" . $productId);
            } else {
                echo "no change";
            }

            if ($result2) {
                $result3 = $obj->update('cart', ['cart_quantity' => $qty], "userlogin_userid=" . $_SESSION['userlogin'] . " AND product_product_id=" . $productId);

                if ($result3) {
                    echo "updated";
                }
            }
        }
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
}
