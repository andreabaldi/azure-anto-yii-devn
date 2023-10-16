<?php

/** @var yii\web\View $this */


use yii\helpers\Html;
use kartik\field\FieldRange;
use kartik\form\ActiveForm;
// on your view layout file
use kartik\icons\FontAwesomeAsset;

$this->title = 'AB Testing page ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-ab-test">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    echo "php code starts"." --: ".date('l jS \of F Y h:i:s A')."<br>";

    $array1 = array(0 => 'zero_a', 2 => 'two_a', 3 => 'three_a');
    $array2 = array(1 => 'one_b', 3 => 'three_b', 4 => 'four_b');
    $result = $array1 + $array2;
    Yii::$app->session->setFlash('success', "AB Test Code  Runned."); 
    var_dump($result);
    Yii::$app->view->on('EVENT_END_BODY', function () {
        echo date('Y-m-dd');
    });
    
    
 

$fdate = '';

$d1 = date('Y-m-d')." 23:59:59";
$d2 = date('Y-m-d', strtotime($d1. ' - 30 days'))." 00:00:00";
               
                              
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'id',
    'name',
    [
        'attribute'=>'id',
        'label'=>'Author',
        'vAlign'=>'middle',
        'width'=>'190px',
        'value'=>function ($model, $key, $index, $widget) { 
            return Html::a('Andrea', '#', []);
        },
        'format'=>'raw'
    ],
    'color',
    'publish_date',
    'status',
    ['attribute'=>'buy_amount','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
    ['attribute'=>'sell_amount','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
    ['class' => 'kartik\grid\ActionColumn', 'urlCreator'=>function(){return '#';}]
];


echo FieldRange::widget([
    'label' => 'Seleziona Intervallo',
    'separator' => ' - ',
    'name1' => 'value1',
    'name2' => 'value2',
    'type' => FieldRange::INPUT_SPIN,

    
]);


echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'columnSelectorOptions'=>[
        'label' => 'Cols...',
    ],
    'hiddenColumns'=>[0, 9], // SerialColumn & ActionColumn
    'disabledColumns'=>[1, 2], // ID & Name
    'dropdownOptions' => [
        'label' => 'Export All',
        'class' => 'btn btn-outline-secondary btn-default'
    ]
]) . "<hr>\n".
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
]);


    
    