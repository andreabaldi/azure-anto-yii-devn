<?php

use frontend\models\Emailreport;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var frontend\models\EmailreportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rapporto Email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailreport-index">

<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="ospiti-tessere-index">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crea Rapporto Email', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'cognome',
            'email:email',
            'oggetto',
            'corpo',
            'allegato',
            [
                'class' => ActionColumn::className(),
                'header' => 'Azioni',
                'headerOptions' =>  ['style' => 'width:15%'],

                'template' => '{view} {update} {delete} {sendemail}',
                'buttons' => [
        
                    'sendemail' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-envelope"></span>', $url, [

                            'title' => Yii::t('app', 'Email Rapporto '),
                            'class' => 'btn btn-info',
                        ]);
                    }],

                'urlCreator' => function ($action, Emailreport $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'email' => $model->email]);
                 }
            ],
        ],
    ]); ?>


</div>
