
<?php

require_once "../koolreport/core/autoload.php";
require_once "../vendor/autoload.php";

use \koolreport\KoolReport;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;

include '../vendor/koolreport/cloudexport/Exportable.php';

class PurchaseReport extends KoolReport
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
        $this->src('sakila_rental')
            ->query("SELECT purchasee_date,total FROM `purchasee`")
            ->pipe(new TimeBucket(array(
                "purchasee_date" => "month"
            )))
            ->pipe(new Group(array(
                "by" => "purchasee_date",
                "sum" => "total"
            )))
            ->pipe($this->dataStore('sale_by_month'));
    }
}
