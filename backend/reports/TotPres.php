<?php

namespace backend\reports;
use Yii;
use koolreport\inputs\Bindable;
use koolreport\inputs\POSTBinding;

//require_once dirname(__FILE__)."/koolreport/autoload.php";
class TotPres extends \koolreport\KoolReport
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


        print_r($this);
//        $d1 = $this->params["d1"];
  //      $d2 = $this->params["d2"];

    $sql = "SELECT \n"
    . "  DATE(Presenze.entrata) as PresEnt, \n"
    . "  COUNT(\n"
    . "    DATE(Presenze.entrata)\n"
    . "  ) AS TotPres \n"
    . "FROM \n"
    . "  Presenze \n"
    . "Where \n"
    . "  entrata BETWEEN \"2023-01-01\" AND  \"2023-12-31\"\n"
  //   . "  entrata BETWEEN  :d1 \n"
   //   . "  AND  :d2 \n"
    //.  " AND   \"2023-12-31\" \n"
    . "GROUP BY \n"
    . "  DATE(Presenze.entrata);";

        
        $this->src('anto_db')
        ->query($sql)
    //      ->params([':d1' => $this->params["d1"]])
      //      ->params([':d2' => $this->params["d2"]])
         //  ->params(array(":d1"=>$this->params["d1"]))
         // ->params(array(":d2"=>$this->params["d2"]))
                ->pipe($this->dataStore('antoniano'));
                
    } 

}


