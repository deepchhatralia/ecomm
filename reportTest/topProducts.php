<?php

require_once "../koolreport/core/autoload.php";
require_once "../vendor/autoload.php";

use \koolreport\KoolReport;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;
use koolreport\processes\Limit;
use koolreport\processes\Sort;

include '../vendor/koolreport/cloudexport/Exportable.php';

class TopProducts extends KoolReport
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
        include '../database.php';
        $obj = new Database();
        $arr = [];
        $counter = 0;

        $result = $obj->select('*', 'productt');
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productId = $row['product_id'];
                $result2 = $obj->select('COUNT(*)', 'order_detail', "product_id=" . $productId);

                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    $arr[$productId] = $row2['COUNT(*)'];
                }
            }
        }
        arsort($arr);
        foreach ($arr as $key => $value) {
            $counter = $counter + 1;
            if ($counter < 6 && $value > 0) {
                $this->src('sakila_rental')
                    ->query("SELECT COUNT(*),`productt`.`product_name` as Product_Name FROM `order_detail` JOIN `productt` ON `order_detail`.`product_id`=`productt`.`product_id` WHERE `productt`.`product_id`=" . $key)
                    ->pipe($this->dataStore('sale_by_month'));
            }
        }
    }
}
