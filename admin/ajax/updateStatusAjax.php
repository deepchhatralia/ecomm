<?php


if (isset($_POST['orderId']) && isset($_POST['statusValue'])) {
    include '../../database.php';
    $obj = new Database();

    $orderId = $_POST['orderId'];
    $statusValue = $_POST['statusValue'];

    $result = $obj->update('orders',['status'=>$statusValue],"order_id={$orderId}");

    if (!$result) {
        echo 'Try again...';
    }else{
        echo 'Updated';
    }
} else {
    include '../../pagenotfound.php';
}
