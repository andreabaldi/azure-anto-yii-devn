<?php

use backend\models\OspitiTessera;
use backend\models\OspitiTesseraSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\field\FieldRange;
use kartik\file\FileInput;
use kartik\touchspin\TouchSpin;





/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Selezione Tessere In Stampa';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
     <div class="col-lg-4">

<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="ospiti-tessere-index">

 <h1><?= Html::encode($this->title) ?></h1>


    <div style="width: 200px;">
<?=Html::beginForm(['otm/selcheck'],'post');?>

<?=  Html::radioList('proptions', 0, [0 => 'No', 1 => 'Rinnovo', 2 => 'Persa',3 => 'Nuova']); ?>

<?= FieldRange::widget([
    'label' => '<h3> Intervallo</h3> ',
    'separator' => ' - ',
    'name1' => 'start',
    'name2' => 'stop',


]);?>



 <?=Html::submitButton('Seleziona',  ['class' => 'btn btn-secondary', 'name' => 'submit', 'value' => 'seleziona',]);?>
 <?=Html::submitButton('Tutti',  ['class' => 'btn btn-secondary', 'name' => 'submit', 'value' => 'selezionatutti',]);?>



 <?= Html::endForm();?>


    <h2>Stampa </h2>

        <hr class="rounded">
        <?=Html::beginForm(['otm/bulk'],'post');?>


<?= Html::label('Scadenza In Mesi', ['class' => 'label']) ?>
<?= TouchSpin::widget([
    'name' => 'scadenza',
        'pluginOptions' => [
            'initval' => 6,
            'min' => 1,
            'max' => 12,
            'step' => 1,
            'verticalbuttons' => true,
            'verticalup' => '<i class="fas fa-plus-circle"></i>',
           'verticaldown' => '<i class="fas fa-minus-circle"></i>',

    ]
])?>

<?=Html::submitButton('Stampa Selezionati', ['class' => 'btn btn-info',
    'data-confirm' => "Sei sicuro di voler Stamapre le tessere?",]);?>

<hr class="rounded">
</div>
</div>
<div class="main-view">
    <div class="col-lg-12">
        <div style="width: 1000px;">


<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
//'id'=>'abtable',
'columns' => [

    ['class' => 'yii\grid\CheckboxColumn',
        'contentOptions' => ['class' => 'text-center', 'style' => 'width:3%; white-space: normal;'],
    'cssClass' => 'check' ,
    'checkboxOptions' => function ($model, $key, $index, $column) {
        if ($model->printme == 1 or $model->printme == 2 or $model->printme == 3)
         return ['checked' => true];
            else return ['checked' => false];
    }],
    ['attribute' =>'id',
        'contentOptions' => ['class' => 'text-center', 'style' => 'width:10%; white-space: normal;'],
    ],
    ['attribute' =>'nome',
        'contentOptions' => ['class' => 'text-center', 'style' => 'width:20%; white-space: normal;'],
    ],
    ['attribute' =>'cognome',
        'contentOptions' => ['class' => 'text-center', 'style' => 'width:20%; white-space: normal;'],
    ],
    ['attribute' =>'dataScadenza',
        'contentOptions' => ['class' => 'text-center', 'style' => 'width:15%; white-space: normal;'],
    ],
    ['attribute' =>'dataRilascio',
        'contentOptions' => ['class' => 'text-center', 'style' => 'width:15%; white-space: normal;'],
    ],
[
    'class' => 'kartik\grid\EnumColumn',
    'attribute' => 'printme',
     'contentOptions' => ['class' => 'text-center', 'style' => 'width:5%; white-space: normal;'],
    'enum' => [
        '0' => '<span class="text-success">No</span>',
        '1' => '<span class="text-success">Rinnovo</span>',
        '2' => '<span class="text-success">Persa</span>',
        '3' => '<span class="text-success">Nuova</span>',
    ],
    'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
        '0' => 'No',
        '1' => 'Rinnovo',
        '2' => 'Persa',
        '3' => 'Nuova',
    ],
    'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
    'format' => 'raw',
    'contentOptions' => ['class' => 'text-center']
],

],
'floatFooter' => false, // disable floating of table footer
'pjax' => true, // pjax is set to always false for this demo
// parameters from the demo form
'responsive' => true,
'bordered' => true,
'striped' => true,
'condensed' => true,
'hover' => true,
'showPageSummary' => true,
'panel' => [
    'after' => '<div style="padding-top: 7px;"><em>*</em></div>',
    'heading' => '<i class="fas fa-book"></i>  Antoniano  Ospiti e Tessere',
    'type' => 'primary',
    'before' => '<div style="padding-top: 7px;"><em> Stampa Tessere.</em></div>',
],
// set the  toolbar

'toolbar' =>  [
    [
        'content' =>
            Html::a('<i class="fas fa-redo"></i>', ['tprint'], [
                'class' => 'btn btn-outline-secondary',
               
                'data-pjax' => 1,
            ]), 
        'options' => ['class' => 'btn-group mr-2 me-2']
    ],
    '{toggleData}',
],

]); ?>


<?= Html::endForm();?> 

</div>
