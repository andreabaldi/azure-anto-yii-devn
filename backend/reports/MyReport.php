<?php

namespace backend\reports;

//require_once dirname(__FILE__)."/koolreport/autoload.php";
class MyReport extends \koolreport\KoolReport
{
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "anto_db"=>array(
                    "connectionString"=>"mysql:host=localhost:8889;dbname=Antoniano",
                    "username"=>"antoniano",
                    "password"=>"1Y8P5aam$$8eNZ7DhB",

                    "charset"=>"utf8"
                )
            ),
            "assets"=>array(
                "path"=>"/Applications/MAMP/htdocs/anto-yii-devn/backend/web/assets",
            )
        );
    }   
    protected function setup()
    {
    $value = 250;
    $sql = "SELECT \n"
    . "  Ospiti.id, \n"
    . "  Ospiti.cognome, \n"
    . "  Ospiti.nome,\n"
    . "  COUNT(Presenze.id) AS TotPres \n"
    . "FROM \n"
    . "  Ospiti \n"
    . "  LEFT JOIN Presenze ON Ospiti.id = Presenze.id \n"
    . "GROUP BY \n"
    . "  Ospiti.id, \n"
    . "  Ospiti.Cognome,   \n"
    . "Ospiti.nome\n"
    . "order by TotPres DESC LIMIT "
    .$value
    .";";
   
    $sql1 = "SELECT \n"
    . "  DATE(Presenze.entrata) as PresEnt, \n"
    . "  COUNT(\n"
    . "    DATE(Presenze.entrata)\n"
    . "  ) AS TotPres \n"
    . "FROM \n"
    . "  Presenze \n"
    . "Where \n"
    . "  entrata BETWEEN \"2023-01-01 00:00:00\" \n"
    . "  AND \"2023-12-31 23:59:59\" \n"
    . "GROUP BY \n"
    . "  DATE(Presenze.entrata);";

        
        $this->src('anto_db')
        ->query($sql) 
        ->pipe($this->dataStore('antoniano'));
    } 

}