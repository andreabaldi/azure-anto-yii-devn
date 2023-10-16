<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use sjaakp\gcharts\ColumnChart;

//use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Presneze $model */


$this->title = 'Presenze Ospite';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-12">
                <h2> Dettaglio Entrate</h2>

<div "barchart">

<?php
echo ColumnChart::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'entrata:date',
        'id',
      
    ],
    'options' => [
        'title' => 'Grafico Presense',
        'bars' => 'horizontal',
        'colors' => ['green','red'],
        'vAxis' => [ 'title' => 'ID' ],
        'hAxis' => [ 'title' => 'Presenze' ],
    ],
]);?>


</div>
<div class="col-lg-8">
                    <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'cognome',
            'entrata',
        
        ],  
]);?>

   


</div>
