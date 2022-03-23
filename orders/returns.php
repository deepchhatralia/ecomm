<?php

session_start();

if (isset($_SESSION['userlogin'])) {
    if (isset($_POST['orderDetailId']) && $_POST['operation'] == "return product") {
        $orderDetailId = $_POST['orderDetailId'];
        $reason = $_POST['reason'];

        include '../database.php';
        $obj = new Database();

        $result = $obj->sql("SELECT * FROM productt JOIN order_detail ON productt.product_id=order_detail.product_id WHERE order_detail.order_detail_id=" . $orderDetailId);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $qty = $row['order_quantity'];
            $total = $qty * $row['offer_price'];

            $result = $obj->insert('order_return', ["amount" => $total, "reason" => $reason, "qty" => $qty, "order_detail_id" => $orderDetailId, "userid" => $_SESSION['userlogin']]);

            if ($result) {
                $result = $obj->update('order_detail', ['status' => "Returned"], "order_detail_id=" . $orderDetailId);

                $orderId = $row['order_order_id'];

                $result2 = $obj->select('*', "order_detail", "order_order_id=" . $orderId);
                $flag = 1;

                while ($row2 = $result2->fetch_assoc()) {
                    if ($row2['status'] != "Returned") {
                        $flag = 0;
                    }
                }
                if ($flag) {
                    $result = $obj->update('order', ['status' => 'Returned'], 'order_id=' . $orderId);
                }

                echo "Returned";
            } else {
                echo "Try again...";
            }
        }
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
}
