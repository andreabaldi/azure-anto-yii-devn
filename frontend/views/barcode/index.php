<?php

use frontend\models\Barcode;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\BarcodeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Barcodes';
$this->params['breadcrumbs'][] = $this->title;

?>


<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="barcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Barcode', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'entrance',
              [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Barcode $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
                    
        ],
    'floatHeader' => true, // table header floats when you scroll
    'floatPageSummary' => false, // table page summary floats when you scroll
    'floatFooter' => false, // disable floating of table footer
    'pjax' => true,
    'responsive' => true,
    'bordered' => true,
    'striped' => true,
    'condensed' => false,
    'hover' => true,
    ]); ?>
    
     <?php echo $this->render('_input', ['model' => $searchModel]); ?>
    <?php Pjax::end(); ?>

</div>
