
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
        if ($this->params['purchasestartDate'] && $this->params['purchaseendDate']) {
            $this->src('sakila_rental')
                ->query("SELECT `purchasee`.`purchasee_date`,`purchasee`.`total`,`dealer`.`dealer_name` FROM `purchasee` JOIN `dealer` ON `purchasee`.`dealer_id`=`dealer`.`iddealer` WHERE purchasee_date>= :startDate AND purchasee_date<= :endDate")
                ->params(array(
                    ":startDate" => $this->params["purchasestartDate"],
                    ":endDate" => $this->params["purchaseendDate"]
                ))
                ->pipe(new TimeBucket(array(
                    "purchasee_date" => "month"
                )))
                ->pipe(new Group(array(
                    "by" => "purchasee_date",
                    "sum" => "total"
                )))
                ->pipe($this->dataStore('sale_by_month'));
        } else {
            $this->src('sakila_rental')
                ->query("SELECT `purchasee`.`purchasee_date`,`purchasee`.`total`,`dealer`.`dealer_name` FROM `purchasee` JOIN `dealer` ON `purchasee`.`dealer_id`=`dealer`.`iddealer`")
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
}
