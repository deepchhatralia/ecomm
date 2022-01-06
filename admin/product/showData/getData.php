<?php

include '../../../database.php';
$obj = new Database();

if (isset($_POST['id']) && $_POST['operation'] == 'select') {
    $productId = $_POST['id'];
    $result = $obj->select('*', 'product', "product_id='{$productId}'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $name = $row['product_name'];
        $feature = $row['product_feature'];
        $price = $row['product_price'];
        $category = $row['product_category'];
        $stock = $row['product_stock'];
        $company = $row['company_profile_idcompany_profile'];
        $offer = $row['offer_idoffer'];

        $arr = array($name, $price, $category, $stock, $company, $productId, $offer, $feature);

        $x = json_encode($arr);
        echo $x;
    }
}

if (isset($_POST['id']) && $_POST['operation'] == 'delete') {
    if ($_POST['operation'] == 'delete') {
        $productId = $_POST['id'];

        echo $obj->delete('product', "product_id='{$productId}'");
    }
}

if (isset($_POST['operation']) && $_POST['operation'] == 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $feature = $_POST['product_feature'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $stock = $_POST['stock'];
    $company = $_POST['company'];
    $offer = $_POST['offer'];

    echo $obj->update('product', ['product_name' => $name, 'product_feature' => $feature, 'product_price' => $price, 'product_category' => $category, 'product_stock' => $stock, 'company_profile_idcompany_profile' => $company, 'offer_idoffer' => $offer], "product_id='{$id}'");
}
