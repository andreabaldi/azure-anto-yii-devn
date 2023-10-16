<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use sjaakp\gcharts\BarChart;
//use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\Presneze $model */


$this->title = 'Presenze nei Trimestri';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-8">
                <h2> Tabella Entrate</h2>

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
            ['attribute' => 'Trimestre',
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
        <div >



</div>
