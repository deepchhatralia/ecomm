<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
?>

<head>
    <title>Sales Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<div class="container mb-5">
    <div class="report-content">
        <div class="text-center">
            <h1>Sales Report</h1>
            <p class="lead">This report show month wise sales</p>

            <button type="submit" class="btn btn-primary" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=salesReport&type=cloudPDF'">Cloud PDF</button>
            <button type=" submit" class="btn btn-primary" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=salesReport&type=cloudJPG'">Cloud JPG</button>
        </div>

        <?php
        ColumnChart::create(array(
            "dataStore" => $this->dataStore('sale_by_month'),
            "columns" => array(
                "order_date" => array(
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
        ?>

        <?php
        Table::create(array(
            "dataStore" => $this->dataStore('sale_by_month'),
            "columns" => array(
                "order_date" => array(
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