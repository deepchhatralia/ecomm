<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;

?>

<html>

<head>
    <style>
        @media print {
            #table1 .break-row td {
                padding: 0 !important;
            }

            * {
                -webkit-print-color-adjust: exact !important;
            }

        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body style='margin: 1in'>

    <h1 class="h1 text-center">State Wise Sales Report</h1>
    <p class="lead text-center">This report shows state wise sales report</p>

    <?php
    ColumnChart::create(array(
        "dataStore" => $this->dataStore('sale_by_month'),
        "columns" => array(
            "State_Name" => array(
                "label" => "Month",
                "type" => "datetime",
                "format" => "Y",
                "displayFormat" => "F, Y",
            ),
            "Total" => array(
                "label" => "Total",
                "type" => "number",
                "prefix" => "&#8377;",
            )
        ),
        "width" => "100%",
    ));

    Table::create(array(
        "dataStore" => $this->dataStore('sale_by_month'),
        "columns" => array(
            "State_Name" => array(
                "label" => "Month",
                "type" => "datetime",
                "format" => "Y-n",
                "displayFormat" => "F, Y",
            ),
            "Total" => array(
                "label" => "Total",
                "type" => "number",
                "prefix" => "&#8377;",
            )
        ),
        "cssClass" => array(
            "table" => "table table-hover table-bordered"
        )
    ));
    ?>

</body>

</html>