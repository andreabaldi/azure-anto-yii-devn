<?php

use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

//use kartik\date\DatePicker;

use yii\jui\DatePicker;
/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\modelsTesseraSearch $searchModel2 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Ospiti and Tessere';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="ospiti-tessere-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->isGuest):?>
        <?= Html::a('Crea Nuovo Ospite', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>

    <?php
$uid = \Yii::$app->user->identity->username;
date_default_timezone_set("Europe/Rome");
$infoh = "Operatore : ".$uid." [".date('h:i:sa')."]";
$infof = "DB Mensa Totale Ospiti ".$dataProvider->totalCount;
?>
   <?= include "commodity.php";?>
<!--    --><?php //Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns'=>true,
        'rowOptions' => function($model,$key,$index,$widget){
            if ($model['stato'] == 'SOSPESO'){
                return ['style' => 'background-color: orangered'];
            }
            elseif ($model['stato'] == 'DECEDUTO'){
                return ['style' => 'background-color: violet'];
            }
            elseif ($model['stato'] == 'INATTIVO'){
                return ['style' => 'background-color: grey'];
            }
            elseif ($model['stato'] == 'NUOVO' ||$model['stato'] == 'COLLOQUIO'){
                return ['style' => 'background-color: yellow'];
            }
            elseif ($model['stato'] == 'ACCOGLIENZA'){
                return ['style' => 'background-color: orange'];
            }
            else

                return ['style' => 'background-color: lightgrey'];
        },
        'columns' => [
            ['attribute' =>'id',
               'contentOptions' => ['class' => 'text-center', 'style' => 'width:30px; white-space: normal;']],
            ['attribute' =>'nome',
              'contentOptions' => ['class' => 'text-center', 'style' => 'width:30px; white-space: normal;']],
            ['attribute' =>'cognome',
             'contentOptions' => ['class' => 'text-center', 'style' => 'width:30px; white-space: normal;']],
            ['attribute' =>'stato',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:30px; white-space: normal;']],

            //['class' => 'yii\grid\SerialColumn'],
            //[
         //           'class' => '\kartik\grid\RadioColumn'
         //   ],
            ['attribute' =>'nascita',
            'value' => function ($model, $key, $index, $widget) {
                if ( !strcmp($model['nascita'], "1900-01-01"))
                    return "<div style='background-color:red'>".Yii::$app->formatter->asDate($model['nascita'],'yyyy-MM-dd')."</div>";
                else return "<div style='background-color:lightgreen'>".Yii::$app->formatter->asDate($model['nascita'],'yyyy-MM-dd')."</div>";},
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:25px; white-space: normal;'],
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' =>([
                    'attribute'=>'nascita',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'format' => 'yyyy-MM-dd',
                        'opens'=>'right',
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ]),
            ],
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
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:25px; white-space: normal;'],
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
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:20px; white-space: normal;'],
            ],
            [
            'attribute' =>  'dataRilascio',
             'value' => function ($model, $key, $index, $widget) {
                 return "<div>".Yii::$app->formatter->asDate($model['dataRilascio'],'yyyy-MM-dd')."</div>";
             },
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'filter' => true,
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:20px; white-space: normal;'],
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' =>([
                    'attribute'=>'dataRilascio',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'format' => 'yyyy-MM-dd',
                        'opens'=>'right',
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ]),
            ],
            [

            'attribute' => 'dataUltimoRinnovo',
            'label' => 'Ultimo Rinnovo',

             'value' => function ($model, $key, $index, $widget) {
                 return Yii::$app->formatter->asDate($model['dataRilascio'],'yyyy-MM-dd');
             },
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'filter' => true,
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:20px; white-space: normal;'],
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' =>([
                    'attribute'=>'dataUltimoRinnovo',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'format' => 'yyyy-MM-dd',
                        'opens'=>'right',
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ]),
            ],




            ['attribute' => 'dataScadenza',

            'headerOptions' => ['style' => 'width:30%'],
             'value' => function ($model, $key, $index, $widget) {
                 if ($model['dataScadenza'] < date("Y-m-d"))
                     return "<div style='background-color:red'>".Yii::$app->formatter->asDate($model['dataScadenza'],'yyyy-MM-dd')."</div>";
                    elseif ($model['dataScadenza']  == date("Y-m-d")) {
                        return "<div style='background-color:yellow'>".Yii::$app->formatter->asDate($model['dataScadenza'],'yyyy-MM-dd')."</div>";
                    }
                 else return Yii::$app->formatter->asDate($model['dataScadenza'],'yyyy-MM-dd');
                 },
            'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
            'format' => 'raw',
            'filter' => true,
            'contentOptions' => ['class' => 'text-center', 'style' => 'width:20px; white-space: normal;'],
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' =>([
                    'attribute'=>'dataScadenza',
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'format' => 'yyyy-MM-dd',
                        'startDate' => '2022-07-19',
                        'opens'=>'right',
                        'autoWidget' => true,
                        'autoclose' => true,
                    ]
                ]),
        ],

         [
            'class' => 'kartik\grid\EnumColumn',
            'attribute' => 'printme',
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
            'contentOptions' => ['class' => 'text-center', 'style' => 'width:20px; white-space: normal;'],
            'format' => 'raw',
            'format' => 'raw',
           // 'contentOptions' => ['class' => 'text-center']
        ],


            [
                'class' => ActionColumn::className(),
                 'header' => 'Azioni',
                'headerOptions' =>  ['style' => 'width:15%'],
                'template' => '{view} {update} {pres} {listpres} {printsel}',

                'buttons' => [
        
                    'printsel' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, [

                            'title' => Yii::t('app', 'In Stampa'),
                            'class' => 'btn btn-info',
                        ]);
                    },

                    'pres' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [

                            'title' => Yii::t('app', 'Aggiungi Presenze'),
                            'class' => 'btn btn-info',
                        ]);
                    },
                    'listpres' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-th-list"></span>', $url, [

                            'title' => Yii::t('app', 'Lista Presenza'),
                            'class' => 'btn btn-info',
                        ]);
                    },

                ],
                'urlCreator' => function ($action, $model, $key, $index) {

                    if ($action == 'pres')
                    {
                        $url = Url::toRoute(['barcode/inputbe', 'id' => $model['id']]);
                        return $url;
                    }
                    elseif($action == 'printsel')
                      $url = $action.'?id='.$model['id'].'&who='.'0';
                    else  $url = $action.'?id='.$model['id'];
                    return $url;
                },
            ],

        ],

        // 'rowOptions' => function($model,$key,$index,$widget){
        //     if ($model['dataScadenza'] < date("Y-m-d")) {
        //         return ['class' => 'table-danger',];
        //     } elseif ($model['dataScadenza']  == date("Y-m-d")) {
        //         return ['class' => 'table-warning',];
        //     }
        //     else return ['class' => 'table-success',];
        // },

    'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
    'floatHeader' => true, // table header floats when you scroll
    'floatPageSummary' => true, // table page summary floats when you scroll
    'floatFooter' => false, // disable floating of table footer
    'pjax' => true,
    // parameters from the demo form
    'responsive' => false,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'hover' => true,
    'showPageSummary' => true,
        'pager' => [
            'firstPageLabel' => 'Prima',
            'lastPageLabel' => 'Ultima',
        ],
    'options' =>['style' => 'width: 1700px;'],
    'panel' => [
        'after' => '<div style="padding-top: 7px;"><em>'.$infof,'</em></div>',
        'heading' => '<i class="fas fa-book"></i>  Antoniano  Welcome - Web App',
        'type' => 'default',
        'before' => '<div style="padding-top: 7px;"><em>Gestione OspitiTessere - '.$infoh.'</em></div>',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
    'toolbar' =>  [
        '{pager}',
        '{export}',
        '{toggleData}',
        [
            'content' =>
                Html::a('<i class="fas fa-redo"></i>', ['indexa'], [
                    'class' => 'btn btn-outline-secondary',
                    'data-pjax' => 1,
                ]),
            'options' => ['class' => 'btn-group mr-2 me-2']
        ],


    ],

    ]);
    ?>


</div>
