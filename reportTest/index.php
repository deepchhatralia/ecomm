<?php

session_start();
if (isset($_SESSION['admin_loggedin'])) {
    include '../admin/includee/cdn.php';
    // include '../admin/includee/navbar.php';

    if (isset($_GET['q'])) {
        $q = $_GET['q'];

        if ($q == "salesreport") {
            require_once './SakilaRental.php';
            $report = new SakilaRental;
        } else if ($q == "topproducts") {
            require_once "./topProducts.php";
            $report = new TopProducts;
        } else if ($q == "salesbystate") {
            require_once "./saleByState.php";
            $report = new SaleByState;
        } else if ($q == "purchasereport") {
            require_once "./purchaseReport.php";
            $report = new PurchaseReport;
        } else {
            return include '../pagenotfound.php';
        }
        $report->run()->render();
    } else if (isset($_POST['fromdate']) && isset($_POST['todate'])) {
        require_once './salesByMonth.php';
        // $report = new SaleByMonth(array(
        //     "fromdate" => $_POST['fromdate'],
        //     "todate" => $_POST['todate']
        // ));

        $report = new SaleByMonth;
        // $report->assignDate($_POST['fromdate'], $_POST['todate']);

        $report->run()->render();
    } else {
        include '../pagenotfound.php';
    }
} else {
    include '../pagenotfound.php';
    // echo "login";
}
