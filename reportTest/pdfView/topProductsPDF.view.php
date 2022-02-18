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

<body style='margin: 5px'>

    <h1 class="h1 text-center">Top Selling Products</h1>
    <p class="lead text-center">This report shows the top 5 selling products</p>

    <?php
    ColumnChart::create(array(
        "dataStore" => $this->dataStore('sale_by_month'),
        "columns" => array(
            "Product_Name" => array(
                "label" => "Product"
            ),
            "COUNT(*)" => array(
                "label" => "Number of Orders"
            )
        ),
        "width" => "100%",
    ));

    Table::create(array(
        "dataStore" => $this->dataStore('sale_by_month'),
        "columns" => array(
            "Product_Name" => array(
                "label" => "Product"
            ),
            "COUNT(*)" => array(
                "label" => "Number of Orders"
            )
        ),
        "cssClass" => array(
            "table" => "table table-hover table-bordered"
        )
    ));
    ?>
</body>

</html>