<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && $_POST['operation'] == 'select') {
    $id = $_POST['id'];

    $result = $obj->select('*', 'product_feature', "idproduct_feature = " . $id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_id = $row['productId'];

        $arr = array($id, $row['product_feature'], $product_id);

        $x = json_encode($arr);
        echo $x;
    }
}

if (isset($_POST['id']) && $_POST['operation'] == 'update') {
    $id = $_POST['id'];
    $feature = $_POST['feature'];
    $product_id = $_POST['product_id'];

    echo $obj->update('product_feature', ['product_feature' => $feature, 'productId' => $product_id], "idproduct_feature='{$id}'");
}

if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
    $id = $_POST['id'];

    echo $obj->delete('product_feature', "idproduct_feature='{$id}'");
}
