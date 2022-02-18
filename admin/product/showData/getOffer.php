<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && $_POST['operation'] == 'select') {
    $id = $_POST['id'];

    $result = $obj->select('*', 'offer', "idoffer = " . $id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $arr = array($row['idoffer'], $row['offer_name'], $row['offer_detail'], $row['offer_startDate'], $row['offer_endDate'], $row['offer_discount']);

        $x = json_encode($arr);
        echo $x;
    }
}

if (isset($_POST['id']) && $_POST['operation'] == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $start = $_POST['startDate'];
    $end = $_POST['endDate'];
    $discount = $_POST['discount'];

    $result = $obj->update('offer', ['offer_name' => $name, 'offer_detail' => $desc, 'offer_startDate' => $start, 'offer_endDate' => $end, 'offer_discount' => $discount], "idoffer='{$id}'");

    if ($result) {
        echo "updated";
    }
}

if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
    $id = $_POST['id'];

    $result = $obj->delete('offer', "idoffer=" . $id);

    if (mysqli_errno($obj->connection()) == 1451) {
        echo "Can't delete. Product with this offer available in stock";
    } else {
        echo "deleted";
    }
}
