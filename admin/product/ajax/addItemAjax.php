<?php
session_start();
// isset($_POST['product_name']) && isset($_POST['desc']) && isset($_POST['feature']) && isset($_POST['product_mrp']) && isset($_POST['product_stock']) && isset($_POST['product_category']) && isset($_POST['company_profile']) && isset($_POST['offer'])
if (isset($_POST['product_mrp'])) {
    include '../../../database.php';
    $obj = new Database();

    // $feature = "";
    // foreach ($_POST['feature'] as $val) {
    //     $feature .= "<li>" . $val . "</li>";
    // }

    // $product_name = mysqli_real_escape_string($obj->connection(), $_POST['product_name']);
    // $desc = mysqli_real_escape_string($obj->connection(), $_POST['desc']);
    // $category_id = mysqli_real_escape_string($obj->connection(), $_POST['product_category']);
    $product_mrp = mysqli_real_escape_string($obj->connection(), $_POST['product_mrp']);
    // $product_stock = mysqli_real_escape_string($obj->connection(), $_POST['product_stock']);
    // $company = mysqli_real_escape_string($obj->connection(), $_POST['company_profile']);
    $offer = mysqli_real_escape_string($obj->connection(), $_POST['offer']);

    // $purchaseId = $_POST['purchaseId'];
    $price = $product_mrp;
    if ($offer != 0) {
        $result = $obj->select('*', 'offer', "idoffer=" . $offer);
        $row2 = $result->fetch_assoc();

        $todaysDate = strtotime(date('Y-m-d'));
        $startDate = strtotime($row2['offer_startDate']);
        $endDate = strtotime($row2['offer_endDate']);

        if ($todaysDate >= $startDate && $todaysDate <= $endDate) {
            $price = round($product_mrp - ($product_mrp * $row2['offer_discount'] / 100));
        }
        // $secs = $endDate - $startDate; // == <seconds between the two times>
        // $days = $secs / 86400;
    }


    // $result = $obj->insert('productt', ['product_desc' => $desc, 'product_feature' => $feature, 'product_category' => $category_id, 'product_name' => $product_name, 'product_price' => $product_mrp, 'product_stock' => $product_stock, 'company_profile_idcompany_profile' => $company, 'offer_idoffer' => $offer]);

    // if ($result) {
    //     // $result = $obj->update('purchasee', ['product_added' => 1], "purchase_id=" . $purchaseId);
    //     echo 'Added';
    // }

    // else {
    // echo 'Please try again';
    //     echo mysqli_error($obj->connection());
    // }
} else {
    include '../../pagenotfound.php';
}
