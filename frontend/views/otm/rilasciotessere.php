<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'Tessere: Ultimi Rilasci';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-tessere-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= $var =  'Dal :'. $d1 . "  al :".$d2;Html::encode($var) ?></h3>
    <div class="row">
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">



        <?=Html::beginForm(['otm/rilasciotessere'],'post');?>
        <?php

        //init values for $d1 and D2 are taken from the controller that initialise to a default.
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
        <br>


<?= include "commodity.php";?>        
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\CheckboxColumn'],
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
            'dataRilascio',
            'dataUltimoRinnovo',
            'dataScadenza',
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

            ['class' => ActionColumn::className(),
            'header' => 'Azioni',
           'headerOptions' =>  ['style' => 'width:15%'],
           'template' => ' {printsel}',
           'buttons' => [
        
            'printsel' => function ($url, $model) {

                return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [

                    'title' => Yii::t('app', 'Modalita\' di Stampa Tessera'),
                    'class' => 'btn btn-info',
                ]);
            },
           

           ],
           'urlCreator' => function ($action, $model, $key, $index) {
            $url = $action.'?id='.$model['id'].'&who='.'1';
            return $url;
           }
    ],
        
        ],
    'rowOptions' => function($model,$key,$index,$widget){
        if ($model['dataScadenza'] < date("Y-m-d")) {
            return ['class' => 'table-danger',];
        } elseif ($model['dataScadenza']  == date("Y-m-d")) {
            return ['class' => 'table-warning',];
        }
        else return ['class' => 'table-success',];
    },
    

    'headerContainer' => ['style' => 'top:150px', 'class' => 'kv-table-header'], // offset from top
    'floatHeader' => false, // table header floats when you scroll
    'floatPageSummary' => false, // table page summary floats when you scroll
    'floatFooter' => false, // disable floating of table footer
    'pjax' => true,
    'responsive' => false,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'hover' => true,
    'showPageSummary' => false,
    'showPageSummary' => false,
    'panel' => [
        'before' => '<div style="padding-top: 7px;"><em> In questa tabella trovi le tessere che sono state rilasciate di recente.</em></div>',
        'heading' => '<i class="fas fa-book"></i>  Antoniano Ricerca Tessera',
        'type' => 'primary',
//        'after' => '<div style="padding-top: 7px;"><em> .</em></div>',
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
    'pager' => [
        'firstPageLabel' => 'Prima',
        'lastPageLabel' => 'Ultima',
    ],
    // set your toolbar
    'toolbar' =>  [
        [
            'content' =>
                Html::a('<i class="fas fa-redo"></i>', ['rilasciotessere'], [
                    'class' => 'btn btn-outline-secondary',
                    'data-pjax' => 0, 
                ]), 
            'options' => ['class' => 'btn-group mr-2 me-2']
        ],
         '{pager}',
        '{export}',
        '{toggleData}',
    ],
    

]);?>

   


</div>
