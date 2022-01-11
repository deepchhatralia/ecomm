<?php

if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['discount'])) {
    include '../../../database.php';
    $obj = new Database();

    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $start = $_POST['startDate'];
    $end = $_POST['endDate'];
    $discount = $_POST['discount'];

    $result = $obj->insert('offer', ['offer_name' => $name, 'offer_detail' => $desc, 'offer_startDate' => $start, 'offer_endDate' => $end, 'offer_discount' => $discount]);

    if ($result) {
        echo 'Added';
    } else {
        // echo 'Please try again';
        echo mysqli_error($obj->connection());
    }
}
