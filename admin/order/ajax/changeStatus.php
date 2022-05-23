<?php

if (isset($_POST['id']) && isset($_POST['selectedValue']) && $_POST['operation'] == "change status") {
    $id = $_POST['id'];
    $val = $_POST['selectedValue'];

    include '../../../database.php';
    $obj = new Database();

    $result = $obj->update('order', ['status' => $val], "order_id={$id}");

    if ($result) {
        $result = $obj->update('order_detail', ['status' => $val], "order_order_id={$id}");

        echo "Updated";
    } else {
        echo "Try again...";
    }
}
