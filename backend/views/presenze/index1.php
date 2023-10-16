<?php

use backend\models\Presenze;
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


    <?php echo $this->render('_searchd', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'filterModel' => $searchModel,
        

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
