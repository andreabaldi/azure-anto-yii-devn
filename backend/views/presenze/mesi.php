<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use sjaakp\gcharts\BarChart;
//use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\Presenze $model */



$this->title = 'Presenze nei Mesi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-5">
                <h2> Tabella Entrate </h2>

            </div>
                <div "barchart">

                    <?php
                    echo BarChart::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            // 'Anno',
                            'Mese:string',
                            'Presenze',
                            'Ospiti'
                        ],
                        'options' => [
                            'title' => 'Presenze Mensili verso Ospiti',
                            'bars' => 'horizontal',
                            'colors' => ['green','red'],
                            'vAxis' => [ 'title' => 'Trimestre' ],
                            'hAxis' => [ 'title' => 'Presenze' ],
                        ],
                    ]);?>


                </div>
 <?php
 include_once "commodity.php";

$av1 = (int)av('Presenze', $dataProvider);
$av2 = (int)av('Ospiti', $dataProvider);
$avsummary = "Media Presenze: ".$av1." Media Ospiti: ".$av2;

 echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['attribute' => 'Anno',
                'pageSummary' => '-',
                ],
            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' => 'Mese',
            'enum' => [
                '1' => '<span>Gennaio</span>',
                '2' => '<span>Febbraio</span>',
                '3' => '<span>Marzo</span>',
                '4' => '<span >Aprile</span>',
                '5' => '<span >Maggio</span>',
                '6' => '<span >Giugno</span>',
                '7' => '<span >Luglio</span>',
                '8' => '<span >Agosto</span>',
                '9' => '<span >Settembre</span>',
                '10' => '<span >Ottobre</span>',
                '11' => '<span >Novembre</span>',
                '12' => '<span >Dicembre</span>',
            ],
            'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                '1' => '<span >Gennaio</span>',
                '2' => '<span >Febbraio</span>',
                '3' => '<span >Marzo</span>',
                '4' => '<span >Aprile</span>',
                '5' => '<span >Maggio</span>',
                '6' => '<span >Giugno</span>',
                '7' => '<span >Luglio</span>',
                '8' => '<span >Agosto</span>',
                '9' => '<span >Settembre</span>',
                '10' => '<span >Ottobre</span>',
                '11' => '<span >Novembre</span>',
                '12' => '<span class="text-success">Dicembre</span>',
            ],
            'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
            
                'pageSummary' => '-',
            ],
            ['attribute' => 'Presenze',
                'pageSummary' => (true),
                'value' => function ($model) {
                    if($model)
                        return  $model['Presenze'];
                }
            ],
            ['attribute' => 'Ospiti',
                'pageSummary' => (true),
                'value' => function ($model) {
                    if ($model)
                        return $model['Ospiti'];
                }
            ],
        ],

    'showPageSummary' => true,
     'panel' => [
         'after' => $avsummary,
         'type' => 'secondary'],
         'toolbar' =>  [
            '{export}'
        ],
        'toolbar' =>  [
            '{export}'
        ],
     'exportConfig' => [
         'html' => [],
         'csv' => [],
         'txt' => [],
         'xls' => [],
         'pdf' => [],
         'json' => [] ],
     'export' => [
         'fontAwesome' => true ,
         'showConfirmAlert' => false ],

     

]);?>

</div>
