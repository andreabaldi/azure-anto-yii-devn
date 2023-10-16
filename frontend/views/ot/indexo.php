<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\modelsTesseraSearch $searchModel2 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Ospiti and Tessere';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-tessere-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ospiti Tessera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'showFooter' => false,
        'summary' => "{begin} - {end} {count} {totalCount} {page} {pageCount}",
        'layout'=> "{summary}\n{pager}\n{items}",
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['style' => 'width: 20px;', 'class' => 'text-center'],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{add_custom} {list_custom}',
                'header' => 'Seleziona',
                'headerOptions' => [
                    'style' => 'width:80px; text-align:center'
                ]],

            'id',
            'cognome',
            'nome',
            'nascita',
            'genere',
            'nazionalita',
            'dataRilascio',
            'dataUltimoRinnovo',
            'dataScadenza',
            'QRfilename',
             'TSfilename',
             [
                'class' => ActionColumn::className(),
                'header' => 'Action',
                'headerOptions' => ['width' => '40'],
                'template' => '{view}  {update}',
                
            ],
            
           
            
        ],
    ]); ?>


</div>
