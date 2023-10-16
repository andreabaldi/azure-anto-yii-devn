<?php

use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use sjaakp\gcharts\BarChart;
use sjaakp\gcharts\LineChart;
//use yii\grid\GridView;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var frontend\models\Presenze $model */


$this->title = 'Presenze Giornaliere Nel Periodo ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <div class="col-lg-2">
<?=Html::beginForm(['presenze/ptotali'],'post');?>

<?php

//init values for $d1 and D2 are taken from teh controller that initialise to a default.
echo Html::label('Periodo', ['class' => 'label']);

echo DateRangePicker::widget([
    'name' => 'date_range',
    'value'=> $d1." - ".$d2,
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

    </div>
<br>
<div >

    <?php
    echo BarChart::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // 'Anno',
            'PresEnt:string',
            'TotPres',

        ],
        'options' => [
            'title' => 'Istogramma DellePresenze Giornaliere Nel Periodo ', 
            'isStacked' => true,
            'colors' => ['green','red'],
            'vAxis' => [ 'title' => 'Periodo' ], 
            'hAxis' => [ 'title' => 'Presenze' ],
        ],
    ]);?>
    <div >

        <?php
        echo LineChart::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                // 'Anno',
                'PresEnt:string',
                'TotPres',

            ],
            'options' => [
                'title' => 'Grafico DellePresenze Giornaliere Nel Periodo ',
                'bars' => 'horizontal',
                'colors' => ['green','red'],
                'vAxis' => [ 'title' => 'Trimestre' ],
                'hAxis' => [ 'title' => 'Presenze' ],
            ],

        ]);?>


    </div>

<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-5">
                <h2> Tabella Giornaliera Delle Presenze </h2>

 <?php

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'PresEnt',
            'TotPres',
        ],
    'panel' => [
        'type' => 'secondary',
    ],
    'exportConfig' => [
        'html' => [],
        'csv' => [],
        'txt' => [],
        'xls' => [],
        'pdf' => [],
        'json' => [],
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
    ],
    // set your toolbar
    'toolbar' =>  [
        '{export}',
    ],
]);?>



</div>
