<?php

use kartik\grid\GridView;
use sjaakp\gcharts\GeoChart;
use sjaakp\gcharts\PieChart;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\modelsTesseraSearch $searchModel2 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Ospiti Per Nazione';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="Distribuzione Degli Ospiti">

    <h1><?= Html::encode($this->title) ?></h1>

    
     <p>
    <?= 

    GeoChart::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nazionalita:string',
            'CountC',
        ],  
       'options' => [
        'title' => 'Nazioni Ospiti Antoniano',
         'colors' => ["#e7711c", "#4374e0"],
    ],
         
    ]); ?>

  </p>
  <?= 

    PieChart::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nazionalita:string',
            'CountC',
        ],  
       'options' => [
        'title' => 'Percentuale Ospiti Nazioni',
    ],
         
    ]); ?>

  </p>
 <p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nazionalita',
            'CountC'
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
        
    ]); 
?>
   </p>  

</div>
