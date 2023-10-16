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

$this->title = ' Esporta Presenze Giorno';
$this->params['breadcrumbs'][] = $this->title;

?>


<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="barcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

</div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'entrance',
                    
        ],

    'bordered' => true,
    'striped' => true,
    'hover' => true,
        'panel' => [
            'heading' => '<i class="fas fa-book"></i>  Export Presenze Del Giorno',
            'type' => 'information',
        ],
        'toolbar' =>  [
            '{export}',
            '{toggleData}'
        ],
        'exportConfig' => [
            'pdf' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
            'csv' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
            'txt' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
            'json' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
            'xls' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],],
        'export' => [
            'fontAwesome' => true ,
            'showConfirmAlert' => false ],


    ]); ?>


</div>
