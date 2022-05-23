<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
?>

<head>
    <title>Sales Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body id="myBody">
    <div class="container mb-5">
        <div class="report-content">
            <div class="text-center">
                <h1>Sales Report</h1>
                <p class="lead">This report show month wise sales</p>

                <button type="submit" class="btn btn-primary" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=salesReport&type=cloudPDF'">Download</button>
                <button type=" submit" class="btn btn-primary d-none" onclick="window.location.href='http://localhost/ecomm/reportTest/export.php?q=salesReport&type=cloudJPG'">Cloud JPG</button>

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Configure</button>
            </div>

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
                                    <label for="salesfromdate" class="font-bold">From</label>
                                    <input required type="date" id="salesfromdate" name="salesfromdate" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="salestodate" class="font-bold">To</label>
                                    <input required type="date" id="salestodate" name="salestodate" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
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

</body>