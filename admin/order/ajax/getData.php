<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && $_POST['operation'] == "select") {
    $id = $_POST['id'];

    $result = $obj->select('*', 'order_detail', "order_order_id=" . $id);

    if ($result->num_rows > 0) {
        $output = "";
        $total = 0;

        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];
            $resultt = $obj->select('*', 'productt', "product_id=" . $productId);
            $product = $resultt->fetch_assoc();

            $offer = $product['offer_idoffer'];
            if ($offer != '0') {
                $result2 = $obj->select('*', 'offer', "idoffer = {$offer}");
                $row2 = $result2->fetch_assoc();
                $offerName = $row2['offer_name'];

                $offerPrice = $product['product_price'] - round(($product['product_price'] * $row2['offer_discount'] / 100));
            } else {
                $offerName = 'None';
                $offerPrice = $product['product_price'];
            }

            $output .= '<tr class="border-b border-gray-200 hover:bg-gray-100">
                <td>' . $row['order_detail_id'] . '</td>
                <td>' . $product['product_name'] . '</td>
                <td>' . $offerPrice . '</td>
                <td>' . $row['order_quantity'] . '</td>
                <td>Rs ' . $offerPrice * $row['order_quantity'] . '</td>
            </tr>';

            $total += $offerPrice * $row['order_quantity'];
        }
        $arr = json_encode(array($output, $total));
        echo $arr;
    }
}
