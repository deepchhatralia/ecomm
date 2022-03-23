<?php

session_start();
if (isset($_SESSION['admin_loggedin'])) {
    include '../admin/includee/cdn.php';
    // include '../admin/includee/navbar.php';

    if (isset($_GET['q'])) {
        $q = $_GET['q'];

        if ($q == "salesreport") {
            require_once './SakilaRental.php';
            $report = new SakilaRental(array("salesstartDate" => "", "salesendDate" => ""));
        } else if ($q == "topproducts") {
            require_once "./topProducts.php";
            $report = new TopProducts;
        } else if ($q == "salesbystate") {
            require_once "./saleByState.php";
            $report = new SaleByState;
        } else if ($q == "purchasereport") {
            require_once "./purchaseReport.php";
            $report = new PurchaseReport(array("purchasestartDate" => "", "purchaseendDate" => ""));
        } else {
            return include '../pagenotfound.php';
        }
    } else if (isset($_POST['salesfromdate']) && isset($_POST['salestodate'])) {
        require_once './SakilaRental.php';
        $report = new SakilaRental(array("salesstartDate" => $_POST['salesfromdate'], "salesendDate" => $_POST['salestodate']));
    } else if (isset($_POST['purchasefromdate']) && isset($_POST['purchasetodate'])) {
        require_once './purchaseReport.php';
        $report = new PurchaseReport(array("purchasestartDate" => $_POST['purchasefromdate'], "purchaseendDate" => $_POST['purchasetodate']));
    } else {
        return '../pagenotfound.php';
    }
    $report->run()->render();
} else {
    include '../pagenotfound.php';
    // echo "login";
}
