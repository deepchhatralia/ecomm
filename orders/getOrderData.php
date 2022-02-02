<?php

session_start();

if (isset($_SESSION['userlogin'])) {
    include '../database.php';
    $obj = new Database();

    if (isset($_POST['orderId']) && $_POST['operation'] == "order details data") {
        $output = "";
        $total = 0;
        $orderId = $_POST['orderId'];
        $result = $obj->select('*', 'order_detail', "order_order_id=" . $orderId);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['product_id'];

                $result2 = $obj->select('*', 'productt', "product_id=" . $productId);
                $row2 = $result2->fetch_assoc();

                $offerId = $row2['offer_idoffer'];
                $price = $row2['product_price'];
                if ($offerId != '0') {
                    $result4 = $obj->select('*', 'offer', "idoffer=" . $offerId);
                    $row4 = $result4->fetch_assoc();

                    $price = round($row2['product_price'] - ($row2['product_price'] * $row4['offer_discount'] / 100));
                }

                $result2 = $obj->select('*', 'image', 'product_product_id=' . $productId);
                $image = $result2->fetch_assoc();

                $output .= '<tr>
                                <td>' . $row['order_detail_id'] . '</td>
                                <td class="d-flex">
                                    <img class="mr-3 productImg" src="../admin/product/uploads/' . $image['img_path'] . '" alt="">
                                    <h6 class="h6 fw-bold">' . $row2['product_name'] . '</h6>
                                </td>
                                <td>' . $price . '</td>
                                <td>' . $row['order_quantity'] . '</td>
                                <td>' . $row['order_quantity'] * $price . '</td>
                            </tr>';
                $total += $row['order_quantity'] * $price;
            }
            $arr = [$output, $total];
            echo json_encode($arr);
        } else {
            echo "Data not found";
        }
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
}
