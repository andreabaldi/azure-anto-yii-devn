<?php

use frontend\models\Statoservizio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var frontend\models\StatoservizioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stato  Servizio';
?>
<div class="statoservizio-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['attribute' =>'id',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:5%; white-space: normal;'],
                ],

            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' => 'stato',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:10%; white-space: normal;'],
                'value' => function ($model, $key, $index, $widget) {
                    if ($model->stato =='ATTIVO')
                        return "<div style='background-color:lightgreen'>".Yii::$app->formatter->asText($model->stato, 2)."</div>";
                    else if ($model->stato =='NUOVO' || $model->stato =='COLLOQUIO')
                        return "<div style='background-color:orange'>".Yii::$app->formatter->asText($model->stato, 2)."</div>";
                    else if ($model->stato =='INATTIVO')
                        return "<div style='background-color:lightslategray'>".Yii::$app->formatter->asText($model->stato, 2)."</div>";
                    else if ($model->stato =='DECEDUTO')
                        return "<div style='background-color:gray'>".Yii::$app->formatter->asText($model->stato, 2)."</div>";
                    else if ($model->stato =='ACCOGLIENZA')
                        return "<div style='background-color:orangered'>".Yii::$app->formatter->asText($model->stato, 2)."</div>";
                    else  return "<div style='background-color:red'>".Yii::$app->formatter->asText($model->stato, 2)."</div>";
                },
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
            ],
            ['attribute' =>'sospesoDa',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:10%; white-space: normal;'],
            ],
            ['attribute' =>'sospesoAl',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:10%; white-space: normal;'],
            ],
            ['attribute' =>'info',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:30%; white-space: normal;'],
            ],


            [
                'class' => ActionColumn::className(),
                'header' => 'Azioni',
                'headerOptions' =>  ['style' => 'width:15%'],
                'template' => '{view} {update}',

                'urlCreator' => function ($action, $model, $key, $index) {


                        $url = Url::toRoute(['statoservizio/view', 'id' => $model['id']]);
                        return $url;
                },
            ],

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
        'pager' => [
            'firstPageLabel' => 'Prima',
            'lastPageLabel' => 'Ultima',
        ],





    ]); ?>


</div>