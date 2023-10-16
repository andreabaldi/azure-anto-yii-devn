<?php

use frontend\models\Tessera;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

//use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TesseraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tesseras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tessera-index">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tessera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
           ['class' => 'yii\grid\CheckboxColumn'],

            'id',
            'dataRilascio',
            'dataUltimoRinnovo',
            'dataScadenza',
            'printme',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tessera $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{view}{update}',                ],
        ],
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
    'floatHeader' => true, // table header floats when you scroll
    'floatPageSummary' => true, // table page summary floats when you scroll
    'floatFooter' => false, // disable floating of table footer
    'pjax' => true, // pjax is set to always false for this demo
    // parameters from the demo form
    'responsive' => false,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'hover' => true,
    'showPageSummary' => true,
    'panel' => [
        'after' => '<div style="padding-top: 7px;"><em>*</em></div>',
        'heading' => '<i class="fas fa-book"></i>  Antoniano Tessere',
        'type' => 'primary',
        'before' => '<div style="padding-top: 7px;"><em> Gestione Tessere.</em></div>',
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
