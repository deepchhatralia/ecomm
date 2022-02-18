<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
?>

<head>
    <title>Purchase Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<div class="container mb-5">
    <div class="report-content">
        <div class="text-center">
            <h1>Purchase Report</h1>
            <p class="lead text-center">This report shows month wise purchase</p>

            <button type="submit" class="btn btn-primary" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=purchaseReport&type=cloudPDF'">Cloud PDF</button>
            <button type=" submit" class="btn btn-primary" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=purchaseReport&type=cloudJPG'">Cloud JPG</button>
        </div>

        <?php
        ColumnChart::create(array(
            "dataStore" => $this->dataStore('sale_by_month'),
            "columns" => array(
                "purchasee_date" => array(
                    "label" => "Month",
                    "type" => "datetime",
                    "format" => "Y-n",
                    "displayFormat" => "F, Y",
                ),
                "total" => array(
                    "label" => "Total",
                    "type" => "number",
                    "prefix" => "₹",
                )
            ),
            "width" => "100%",
        ));
        Table::create(array(
            "dataStore" => $this->dataStore('sale_by_month'),
            "columns" => array(
                "purchasee_date" => array(
                    "label" => "Month",
                    "type" => "datetime",
                    "format" => "Y-n",
                    "displayFormat" => "F, Y",
                ),
                "total" => array(
                    "label" => "Total",
                    "type" => "number",
                    "prefix" => "₹",
                )
            ),
            "cssClass" => array(
                "table" => "table table-hover table-bordered"
            )
        ));
        ?>
    </div>
</div>