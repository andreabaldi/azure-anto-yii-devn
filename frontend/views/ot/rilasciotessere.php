<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;
/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'Ultimi Rilasci Tessere ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-tessere-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-10">
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

<?php 

echo GridView::widget([
    'id' => 'kvgrid',
        'dataProvider' => $dataProvider,
      // 'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'cognome',
            'nome',
            'nascita',
            'genere',
            'nazionalita',
            'dataRilascio',
            'dataUltimoRinnovo',
            'dataScadenza',
        
        ],  
    'headerContainer' => ['style' => 'top:150px', 'class' => 'kv-table-header'], // offset from top
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
        'before' => '<div style="padding-top: 7px;"><em> In questa tabella trovi le tessere che sono state rilasciate di recente.</em></div>',
        'heading' => '<i class="fas fa-book"></i>  Antoniano Ricerca',
        'type' => 'primary',
        'after' => '<div style="padding-top: 7px;"><em> .</em></div>',
    ],
    // set export properties
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
    // set your toolbar
    'toolbar' =>  [
        [
            'content' =>
                Html::a('<i class="fas fa-redo"></i>', ['myindex'], [
                    'class' => 'btn btn-outline-secondary',
                    'data-pjax' => 0, 
                ]), 
            'options' => ['class' => 'btn-group mr-2 me-2']
        ],
        '{export}',
        '{toggleData}',
    ],

]);?>

   


</div>
