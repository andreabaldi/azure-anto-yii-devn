<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;
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
$gridColumns =[
    'id',
    'nome',
    'cognome',
    'entrata',

];


echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'filename' => 'Lista-Presenze-'.date("Y-m-d"),
    'exportConfig' => [
        ExportMenu::FORMAT_PDF => [
            'pdfConfig' => [
                'methods' => [
                    'SetTitle' => 'Grid Export - Krajee.com',
                    'SetSubject' => 'Generating PDF files via yii2-export extension has never been easy',
                ]
            ]
        ],
    ],
    'columnSelectorOptions'=>[
        'label' => 'Colonne ',
    ],
        'fontAwesome' => true,
        'showConfirmAlert' => false,
   // 'hiddenColumns'=>[0, 9], // SerialColumn & ActionColumn
    //'disabledColumns'=>[1, 2], // ID & Name
    
    'dropdownOptions' => [
        'label' => 'Export ',
        'class' => 'btn btn-outline-secondary btn-default',
    ],
    
]) . "<hr>\n" ?>
                    <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
]);?>

   


</div>
