<?php
session_start();

if (isset($_POST['product_name']) && isset($_POST['product_feature']) && isset($_POST['product_mrp']) && isset($_POST['product_stock']) && isset($_POST['product_category']) && isset($_POST['company_profile']) && isset($_POST['offer'])) {
    include '../../../database.php';
    $obj = new Database();

    $product_name = mysqli_real_escape_string($obj->connection(), $_POST['product_name']);
    $product_feature = $_POST['product_feature'];
    $category_id = mysqli_real_escape_string($obj->connection(), $_POST['product_category']);
    $product_mrp = mysqli_real_escape_string($obj->connection(), $_POST['product_mrp']);
    $product_stock = mysqli_real_escape_string($obj->connection(), $_POST['product_stock']);
    $company = mysqli_real_escape_string($obj->connection(), $_POST['company_profile']);
    $offer = mysqli_real_escape_string($obj->connection(), $_POST['offer']);

    $uniqueId = uniqid("gdrs", true);

    $result = $obj->insert('productt', ['product_id' => $uniqueId, 'product_feature' => $product_feature, 'product_category' => $category_id, 'product_name' => $product_name, 'product_price' => $product_mrp, 'product_stock' => $product_stock, 'company_profile_idcompany_profile' => $company, 'offer_idoffer' => $offer]);

    if ($result) {
        echo 'Added';
    } else {
        // echo 'Please try again';
        echo mysqli_error($obj->connection());
    }
} else {
    include '../../pagenotfound.php';
}
