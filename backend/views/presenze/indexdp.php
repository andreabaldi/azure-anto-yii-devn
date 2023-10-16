<?php

use backend\models\Presenze;
use kartik\daterange\DateRangePicker;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

//use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Presenze';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenze-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'filterModel' => $searchModel,
        'filterModel' => DateRangePicker::widget([

        'model' => $searchModel,

        'autoUpdateOnInit' => true,

        'attribute' => 'id', // <-- this is the real attribute to be filtered

        'convertFormat' => true,

        'startAttribute' => 'entrata', // <-- these are splitted attrs

        'endAttribute' => 'entrata',

        'pluginOptions' => [

            'locale' => [

                'format' => 'Y-m-d'

            ],

            'opens' => 'left',

            'ranges' => [

                "Questo mese" => ["moment().startOf('month')", "moment().endOf('month')"],

                "Mese prossimo" => ["moment().add(1, 'month').startOf('month')", "moment().add(1, 'month').endOf('month')"],

            ],

        ],

    ]),
        

        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entrata',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Presenze $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
