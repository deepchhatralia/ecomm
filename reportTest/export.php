<?php

// use chromeheadlessio\Exporter;

$secretToken = '609468e960ca66806dbea814b96fcf79f34cffbd9946ef66f399c98c6a81d677';


if (isset($_GET['q']) && isset($_GET['type']) && ($_GET['type'] == "cloudPDF" || $_GET['type'] == "cloudJPG")) {
    $type = $_GET['type'];
    $q = $_GET['q'];

    if ($q == "topProducts") {
        require_once "./topProducts.php";
        $report = new TopProducts;
    } else if ($q == "salesReport") {
        require_once "./SakilaRental.php";
        $report = new SakilaRental(array("salesstartDate" => "", "salesendDate" => ""));
    } else if ($q == "salesByState") {
        require_once "./saleByState.php";
        $report = new SaleByState;
    } else if ($q == "purchaseReport") {
        require_once "./purchaseReport.php";
        $report = new PurchaseReport(array("purchasestartDate" => "", "purchaseendDate" => ""));
    } else {
        return include '../pagenotfound.php';
    }

    $report->run();

    $settings = [
        // 'useLocalTempFolder' => true,
        "pageWaiting" => "networkidle2" //load, domcontentloaded, networkidle0, networkidle2
    ];



    if ($type === 'cloudJPG') {
        $report->cloudExport("./pdfView/" . $_GET['q'] . "PDF")
            ->chromeHeadlessio($secretToken)
            ->settings($settings)
            ->jpg(array(
                // "format"=>"A4",
                // "fullPage" => false
            ))
            ->toBrowser("{$_GET['q']}.jpg");
    } else if ($type === 'cloudPDF') {
        $pdfOptions = [
            "format" => "A4",
            'landscape' => false,
            'displayHeaderFooter' => true,
            'headerTemplate' => '
            <div id="header-templat" style="font-size:10px !important; color:#808080; padding-left:10px; display: flex; justify-content: space-between; align-items: center; width: 90%;">
                <h1>GDRS</h1>
                <div class="date"></div>
            </div>
        ',
            'footerTemplate' => '
            <div id="footer-template" style="font-size:10px !important; color:#808080; padding-left:10px; display: flex; justify-content: space-between; align-items: center; width: 90%;">
                <div>
                    <h5 style="margin: 0;">Email: gdstream@gmail.com</h5>
                    <h5 style="margin: 0;">Phone: 9328324955</h5>
                </div>
                <div class="title"></div>
                <div>
                    Page <span class="pageNumber"></span> -
                    <span class="totalPages"></span>
                </div>
            </div>
        ',
            'margin' => [
                'top'    => '100px',
                'bottom' => '200px',
                'right'  => '30px',
                'left'   => '30px'
            ],
            "noRepeatTableHeader" => true,
            "noRepeatTableFooter" => true,
        ];
        $report->cloudExport("./pdfView/" . $_GET['q'] . "PDF")
            ->chromeHeadlessio($secretToken)
            ->settings($settings)
            ->pdf($pdfOptions)
            ->toBrowser("./pdfView/" . $_GET['q'] . ".pdf");
    }
} else {
    include '../pagenotfound.php';
}
