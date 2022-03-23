<?php

require_once "../koolreport/core/autoload.php";
require_once "../vendor/autoload.php";

use \koolreport\KoolReport;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;

include '../vendor/koolreport/cloudexport/Exportable.php';

class SakilaRental extends KoolReport
{
    use \koolreport\cloudexport\Exportable;
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
        if ($this->params['salesstartDate'] && $this->params['salesendDate']) {
            $this->src('sakila_rental')
                ->query("SELECT order_date,total FROM `order` WHERE order_date>= :startDate AND order_date<= :endDate")
                ->params(array(
                    ":startDate" => $this->params["salesstartDate"],
                    ":endDate" => $this->params["salesendDate"]
                ))
                ->pipe(new TimeBucket(array(
                    "order_date" => "month"
                )))
                ->pipe(new Group(array(
                    "by" => "order_date",
                    "sum" => "total"
                )))
                ->pipe($this->dataStore('sale_by_month'));
        } else {
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
}
