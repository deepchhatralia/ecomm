<?php

if (isset($_POST['operation'])) {
    if ($_POST['operation'] == "load products" || $_POST['operation'] == "low to high" || $_POST['operation'] == "high to low") {
        include '../../database.php';
        $obj = new Database();
        $output = '';

        if ($_POST['operation'] == "low to high") {
            $result = $obj->select('*', 'productt', 'product_stock >= 1', "offer_price");
        } else if ($_POST['operation'] == "high to low") {
            $result = $obj->select('*', 'productt', 'product_stock >= 1', "offer_price DESC");
        } else {
            $result = $obj->select('*', 'productt', 'product_stock >= 1');
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row["product_id"];
                $row2 = $obj->select('*', 'image', 'product_product_id = ' . $productId);
                if ($row2->num_rows > 0) {
                    $row2 = $row2->fetch_assoc();

                    $offerId = $row['offer_idoffer'];
                    $price = $row['product_price'];
                    if ($offerId != 0) {
                        $resultt = $obj->select('*', 'offer', "idoffer=" . $offerId);
                        $roww = $resultt->fetch_assoc();

                        $todaysDate = strtotime(date('Y-m-d'));
                        $startDate = strtotime($roww['offer_startDate']);
                        $endDate = strtotime($roww['offer_endDate']);

                        if ($todaysDate >= $startDate && $todaysDate <= $endDate) {
                            $price = round($price - ($price * $roww['offer_discount'] / 100));
                        }
                    }

                    $output .= '<div class="mb-5 col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                    <div class="product_list">
                        <div class="product_img">
                            <img class="img-responsive" src="../admin/product/uploads/' . $row2['img_path'] . '" alt="">
                        </div>
                        <div class="product_detail_btm">
                            <div class="center">
                                <h4 class="h4">
                                    <a href="http://localhost/ecomm/product/product.php?id=' . $productId . '">' . $row['product_name'] . '</a>
                                </h4>
                            </div>
                            <div class="product_price">
                                <p><span class="new_price">₹' . $price . '</span></p>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            }
            echo $output;
        }
    }
    // else if($_POST['operation'] == "low to high"){

    // }
} else {
    include '../../pagenotfound.php';
}
