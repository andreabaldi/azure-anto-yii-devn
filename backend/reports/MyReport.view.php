<?php 
   
    use \koolreport\widgets\koolphp\Table;
    
    use \koolreport\widgets\google\ColumnChart;
    use \koolreport\widgets\google\LineChart;
    require_once "../../vendor/koolreport/core/autoload.php";



?>

<div class="report-content">
    <div class="text-center">
        <h1>Antoniano Mensa Padre Ernesto Report</h1>
        <p class="lead">Top Presenze Mensa </p>
    </div>

    <?php
    ColumnChart::create(array(
        "dataStore"=>$this->dataStore('antoniano'),  
        "columns"=>array(
            "cognome"=>array(
                "label"=>"cognome",
                "type"=>"string",
            ),
            "TotPres"=>array(
                "label"=>"TotPres",
                "type"=>"number",
            )
        ),
        "width"=>"100%",
    ));

    ?>

<?php
    LineChart::create(array(
        "dataStore"=>$this->dataStore('antoniano'),  
        "columns"=>array(
            "id"=>array(
                "label"=>"id",
                "type"=>"string",
            ),
            "TotPres"=>array(
                "label"=>"TotPres",
                "type"=>"number",
            )
        ),
        "width"=>"100%",
    ));

    ?>




    <?php
    Table::create(array(
        "dataStore"=>$this->dataStore('antoniano'),
        "columns"=>array(
            "id"=>array(
                "label"=>"Id",
                "type"=>"string",
            ),
             "nome"=>array(
                            "label"=>"nome",
                            "type"=>"string",
             ),

           "cognome"=>array(
                         "label"=>"conome",
                          "type"=>"string",
           ),
           "TotPres"=>array(
            "label"=>"TotPres",
            "type"=>"number",
        ),
        ),
        "cssClass"=>array(
            "table"=>"table table-hover table-bordered"
        )
    ));
    ?>
</div>