<?php


require_once "../koolreport/core/autoload.php";
require_once "../vendor/autoload.php";

use \koolreport\KoolReport;
use \koolreport\processes\ColumnMeta;

include '../vendor/koolreport/cloudexport/Exportable.php';

class SaleByState extends KoolReport
{
    use \koolreport\cloudexport\Exportable;
    function settings()
    {
        return array(
            "dataSources" => array(
                "automaker" => array(
                    "connectionString" => "mysql:host=localhost;dbname=ecommerce",
                    "username" => "root",
                    "password" => "",
                    "charset" => "utf8"
                )
            )
        );
    }
    public function setup()
    {
        include '../database.php';
        $obj = new Database();

        $result = $obj->select('*', 'state');

        while ($row = $result->fetch_assoc()) {
            $this->src('automaker')
                ->query("SELECT SUM(total) as Total,`state`.state_name as State_Name FROM `order` JOIN `userlogin` ON `userlogin`.`userid`=`order`.`userlogin_userid` JOIN `area` ON `userlogin`.`area_idarea`=`area`.`idarea` JOIN `city` ON `area`.`city_idcity`=`city`.`idcity` JOIN `state` ON `city`.`state_idstate`=`state`.`idstate` WHERE `state`.idstate=" . $row['idstate'])
                ->pipe(new ColumnMeta(array(
                    "tooltip" => array(
                        "type" => "string",
                    )
                )))
                ->pipe($this->dataStore('sale_by_month'));
        }
    }
}
