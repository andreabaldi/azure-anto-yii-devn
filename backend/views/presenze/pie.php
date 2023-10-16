<?php

use kartik\grid\GridView;
use sjaakp\gcharts\PieChart;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\modelsTesseraSearch $searchModel2 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Ospiti Genere';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="ospiti-genere">

    <h1><?= Html::encode($this->title) ?></h1>

    
     <p>
    <?= 

    PieChart::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'genere:string',
            'CountC',
        ],

    ]); ?>

  </p>
 <p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'genere',
            'CountC',
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
