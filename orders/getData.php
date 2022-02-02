<?php

session_start();

if (isset($_SESSION['userlogin'])) {
    include '../database.php';
    $obj = new Database();

    if (isset($_POST['id'])) {
        $output = "";

        $result = $obj->select('*', 'order_detail', "order_detail_id=" . $_POST['id']);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $result2 = $obj->select('*', 'order', "order_id=" . $row['order_order_id']);
            $row2 = $result2->fetch_assoc();

            $result3 = $obj->select('*', 'productt', "product_id=" . $row['product_id']);
            $row3 = $result3->fetch_assoc();

            $result4 = $obj->select('*', "image", "product_product_id=" . $row['product_id']);
            $image = "";
            if ($result4->num_rows > 0) {
                $row4 = $result4->fetch_assoc();
                $image = $row4['img_path'];
            }

            $price = $row3['product_price'];
            if ($row3['offer_idoffer'] != 0) {
                $result4 = $obj->select('*', 'offer', "idoffer=" . $row3['offer_idoffer']);
                $row4 = $result4->fetch_assoc();

                $price = round($row3['product_price'] - ($row3['product_price'] * $row4['offer_discount'] / 100));
            }


            $total = $row['order_quantity'] * $price;


            $output .= '<div class="row mb-4">
            <div class="col-md-6">
            <div class="d-flex align-items-center">
            <img class="productImg mr-3" src="../admin/product/uploads/' . $image . '" alt="">
            <span class="d-none" id="product-id">' . $row3['product_id'] . '</span>
            <span class="d-none" id="order-detail-id">' . $_POST['id'] . '</span>
                                    <h6 class="h6 fw-bold">' . $row3['product_name'] . '</h6>
                                    </div>
                                    </div>
                            <div class="col-md-6">
                            <h5 class="h5">Shipping Address : </h5>
                            <p style="font-size: 14px;">' . $row2['shipping_address'] . '</p>
                            </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                <h6 class="h6">Quantity to return</h6>
                                <select id="qty-return" class="form-control">
                                <option selected value="1">1</option>';

            for ($i = 2; $i <= $row['order_quantity']; $i++) {
                $output .= '<option value="' . $i . '">' . $i . '</option>';
            }


            $output .= '</select>
                            </div>
                            <div class="col-md-6">
                                <h6 class="h6">Price</h6>
                                <input class="fix-price d-none" value="' . $price . '" />
                                <input type="number" class="form-control price" disabled value="' . $price . '" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6 class="h6">Reason <span class="text-muted">(Min. 100 characters)</span></h6>
                                <textarea rows="5" id="return-reason" class="textarea form-control"></textarea>
                            </div>
                        </div>';

            echo $output;
        } else {
            echo "Order not found";
        }
    } else if (isset($_POST['operation']) && $_POST['operation'] == "return product") {
        $result = $obj->insert('order_return', ['amount' => $_POST['amount'], 'reason' => $_POST['reason'], 'qty' => $_POST['qty'], 'order_detail_id' => $_POST['orderDetailId'], 'userid' => $_SESSION['userlogin']]);


        if ($result) {
            $result = $obj->select('*', 'order_detail', "order_detail_id=" . $_POST['orderDetailId']);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $orderQuantity =  $row['order_quantity'] - $_POST['qty'];
                $result = $obj->update('order_detail', ['order_quantity' => $orderQuantity], "order_detail_id=" . $_POST['orderDetailId']);

                if ($orderQuantity <= 0) {
                    $result = $obj->update('order_detail', ['status' => 'Return requested'], 'order_detail_id=' . $_POST['orderDetailId']);
                }
                echo "Inserted";
            }
        } else {
            echo "Try again...";
        }
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
}
