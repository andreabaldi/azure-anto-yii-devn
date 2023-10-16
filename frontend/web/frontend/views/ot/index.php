<?php


use backend\models\Ospiti;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modelsOspitiSearch $ospitisearchModel */
/** @var app\modelsTesseraSearch $tesserasearchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ospiti Tessera';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-tessera-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ospiti e Tessera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'TSfilename',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ospiti $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
