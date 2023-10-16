<?php

use backend\models\Presenze;
use kartik\grid\GridView;
use sjaakp\datepager\ActiveDataProvider;
use sjaakp\datepager\DatePager;
use yii\helpers\Html;

//use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \backend\models\Presenze $model */


$this->title = 'Presenze per Anni';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
     <div class="row">
            <div class="col-lg-4">
           
                <h2> Pager</h2>


        <?php

        $query = Presenze::find()->orderBy('id');

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'dateAttribute' => 'entrata',
]);
?>

<?= DatePager::widget([
    'dataProvider' => $dataProvider,
]) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'entrata',
        'id',
    ],
    'panel' => [
        'type' => 'secondary',
    ],
    'exportConfig' => [
        'html' => [],
        'csv' => [],
        'txt' => [],
        'xls' => [],
        'pdf' => [],
        'json' => [],
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
    ],
    // set your toolbar
    'toolbar' =>  [
        '{export}',
    ],
]); ?>
   


</div>
