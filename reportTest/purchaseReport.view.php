<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
?>

<head>
    <title>Purchase Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<div class="container mb-5">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./index.php" method="POST" id="myForm">
                        <div class="mb-3">
                            <label for="purchasefromdate" class="font-bold">From</label>
                            <input required type="date" id="purchasefromdate" name="purchasefromdate" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="purchasetodate" class="font-bold">To</label>
                            <input required type="date" id="purchasetodate" name="purchasetodate" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="report-content">
        <div class="text-center">
            <h1>Purchase Report</h1>
            <p class="lead text-center">This report shows month wise purchase</p>

            <button type="submit" class="btn btn-primary" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=purchaseReport&type=cloudPDF'">Cloud PDF</button>
            <button type=" submit" class="btn btn-primary d-none" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=purchaseReport&type=cloudJPG'">Cloud JPG</button>

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Configure</button>
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
                "dealer_name" => array("label" => "Dealer"),
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