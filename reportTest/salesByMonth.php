<?php

require_once "../koolreport/core/autoload.php";
require_once "../vendor/autoload.php";

use \koolreport\KoolReport;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;

include '../vendor/koolreport/cloudexport/Exportable.php';

class SaleByMonth extends KoolReport
{
    function settings()
    {
        return array(
            "dataSources" => array(
                "sakila_rental" => array(
                    "connectionString" => "mysql:host=localhost;dbname=ecommerce",
                    "username" => "root",
                    "password" => "",
                    "charset" => "utf8"
                ),
            )
        );
    }
    protected function setup()
    {
        $this->src('sakila_rental')
            ->query("SELECT order_date,total FROM `order`")
            ->pipe(new TimeBucket(array(
                "order_date" => "month"
            )))
            ->pipe(new Group(array(
                "by" => "order_date",
                "sum" => "total"
            )))
            ->pipe($this->dataStore('sale_by_month'));
    }
}
