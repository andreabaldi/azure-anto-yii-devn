<?php 
   
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\ColumnChart;
    use \koolreport\widgets\google\LineChart;
    require_once "../../vendor/koolreport/core/autoload.php";
    use yii\helpers\Html;
    use kartik\daterange\DateRangePicker;
?>

<div class="report-content">
    <div class="text-center">
        <h1>Antoniano Mensa Padre Ernesto Report</h1>
        <p class="lead">Totale Presenze Mensa Oggi </p>
    </div>





 <?=Html::beginForm(['kr/koolrep'],'post');?>
    <?php

    //init values for $d1 and D2 are taken from teh controller that initialise to a default.
    echo Html::label('Periodo', ['class' => 'label']);

    echo DateRangePicker::widget([
        'name' => 'date_range',
       //'value'=> $d1." - ".$d2,
      'value'=> "2023-02-12"." - "."2023-03-12",
        'attribute'=>'datetime_range',
        'startAttribute'=>'datetime_min',
        'endAttribute'=>'datetime_max',
        'useWithAddon' => true,
        'containerOptions' => ['style' => 'min-width: 100px'],
        'language' => 'it',
        'hideInput' => false,
        'presetDropdown' => true,
        'includeDaysFilter' => true,
        'pluginOptions' => [
            'locale'=>['format' => 'YYYY-MM-DD'],
            'separator'=> '-' ,
            'opens'=>'right',
            'todayHighlight' => true,
        ]
    ]);

    ?>



    <br>
    <?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>


    <br>

    <?php
    ColumnChart::create(array(
        "dataStore"=>$this->dataStore('antoniano'),  
        "columns"=>array(
            "PresEnt"=>array(
                "label"=>"PresEnt",
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
            "PresEnt"=>array(
                "label"=>"PresEnt",
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
            "PresEnt"=>array(
                "label"=>"PresEnt",
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