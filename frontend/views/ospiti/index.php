<?php

use frontend\models\Ospiti;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

//use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ospiti';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    'id',
            'cognome',
            'nome',
            'nascita',
            'genere',
            'nazionalita'
];
?>
<div class="ospiti-index">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ospiti', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= include "commodity.php";?>
    <?= 
    
    GridView::widget([
         'id' => 'kvgrid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'cognome',
            'nome',
            'nascita',
            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' => 'genere',
                'enum' => [
                    'X' => '<span class="text-muted">X</span>',
                    'F' => '<span class="text-success">Donna</span>',
                    'M' => '<span class="text-success">Uomo</span>',
                ],
                'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                    'X' => 'X',
                    'F' => 'F',
                    'M' => 'M',
                ],
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center']
            ],
            ['attribute' =>'nazionalita',
            'class' => 'kartik\grid\EnumColumn',
            'enum' => $countrynames,
            'value' => function ($model, $key, $index, $widget) {
                if ( !strcmp($model['nazionalita'], "SCONOSCIUTA"))
                    return "<div style='background-color:red'>".Yii::$app->formatter->asText($model['nazionalita'])."</div>";
                else return "<div style='background-color:lightgreen'>".Yii::$app->formatter->asText($model['nazionalita'])."</div>";},
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center']
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ospiti $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{view}{update}',
                ],
        ],
    'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
    'floatHeader' => true, // table header floats when you scroll
    'floatPageSummary' => true, // table page summary floats when you scroll
    'floatFooter' => false, // disable floating of table footer
    'pjax' => false, // pjax is set to always false for this demo
    // parameters from the demo form
    'responsive' => false,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'hover' => true,
    'showPageSummary' => true,
    'panel' => [
        'after' => '<div style="padding-top: 7px;"><em>* Botton space to be used.</em></div>',
        'heading' => '<i class="fas fa-book"></i>  Antoniano  Ospiti',
        'type' => 'primary',
        'before' => '<div style="padding-top: 7px;"><em>* Gestione Degli Ospiti Antoniano .</em></div>',
    ],
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false, 
    ],
    'exportConfig' => [
        'html' => [],
        'csv' => [],
        'txt' => [],
        'xls' => [],
        'pdf' => [],
        'json' => [],
    ],
    'toolbar' =>  [
        [
            'content' =>
               Html::a('<i class="fas fa-redo"></i>', ['index'], [
                    'class' => 'btn btn-outline-secondary',
                   
                    'data-pjax' => 1, 
                ]), 
            'options' => ['class' => 'btn-group mr-2 me-2']
        ],
        '{export}',
        '{toggleData}']
        
    ]); ?>


</div>
