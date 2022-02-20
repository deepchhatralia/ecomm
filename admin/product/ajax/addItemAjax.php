<?php
session_start();

if (isset($_POST['product_name']) && isset($_POST['desc']) && isset($_POST['feature']) && isset($_POST['product_mrp']) && isset($_POST['product_stock']) && isset($_POST['product_category']) && isset($_POST['company_profile']) && isset($_POST['offer'])) {
    include '../../../database.php';
    $obj = new Database();

    $feature = "";
    foreach ($_POST['feature'] as $val) {
        $feature .= "<li>" . $val . "</li>";
    }

    $product_name = mysqli_real_escape_string($obj->connection(), $_POST['product_name']);
    $desc = mysqli_real_escape_string($obj->connection(), $_POST['desc']);
    $category_id = mysqli_real_escape_string($obj->connection(), $_POST['product_category']);
    $product_mrp = mysqli_real_escape_string($obj->connection(), $_POST['product_mrp']);
    $product_stock = mysqli_real_escape_string($obj->connection(), $_POST['product_stock']);
    $company = mysqli_real_escape_string($obj->connection(), $_POST['company_profile']);
    $offer = mysqli_real_escape_string($obj->connection(), $_POST['offer']);

    $purchaseId = $_POST['purchaseId'];

    $result = $obj->insert('productt', ['product_desc' => $desc, 'product_feature' => $feature, 'product_category' => $category_id, 'product_name' => $product_name, 'product_price' => $product_mrp, 'product_stock' => $product_stock, 'company_profile_idcompany_profile' => $company, 'offer_idoffer' => $offer]);

    if ($result) {
        $result = $obj->update('purchasee', ['product_added' => 1], "purchase_id=" . $purchaseId);
        echo 'Added';
    } else {
        // echo 'Please try again';
        echo mysqli_error($obj->connection());
    }
} else {
    include '../../pagenotfound.php';
}
