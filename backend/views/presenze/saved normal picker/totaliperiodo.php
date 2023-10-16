<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use sjaakp\gcharts\BarChart;
use sjaakp\gcharts\LineChart;
//use yii\grid\GridView;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var frontend\models\Presenze $model */


$this->title = 'Presenze Giornaliere Nel Periodo ';
$this->params['breadcrumbs'][] = $this->title;
?>


<?=Html::beginForm(['presenze/ptotali'],'post');?>
<?php
//init values for $d1 and D2 are taken from teh controller that initialise to a default.
echo Html::label('Periodo :', ['class' => 'label']);
echo DatePicker::widget([
    'name'  => 'from_date',
    'options' => ['placeholder' => 'Data: Da...'],
    'language' => 'it',
    'value' => $d1,
    'dateFormat' => 'yyyy-MM-dd',
]);
echo DatePicker::widget([
    'name'  => 'to_date',
    'options' => ['placeholder' => 'Data: A...'],
    'value' => $d2,
    'dateFormat' => 'yyyy-MM-dd',
]);?>
<br>
<?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>


<br>
<div >

    <?php
    echo BarChart::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // 'Anno',
            'PresEnt:string',
            'TotPres',

        ],
        'options' => [
            'title' => 'Istogramma DellePresenze Giornaliere Nel Periodo ',
            'bars' => 'horizontal',
            'colors' => ['green','red'],
            'vAxis' => [ 'title' => 'Periodo' ],
            'hAxis' => [ 'title' => 'Presenze' ],
        ],
    ]);?>
    <div >

        <?php
        echo LineChart::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                // 'Anno',
                'PresEnt:string',
                'TotPres',

            ],
            'options' => [
                'title' => 'Grafico DellePresenze Giornaliere Nel Periodo ',
                'bars' => 'horizontal',
                'colors' => ['green','red'],
                'vAxis' => [ 'title' => 'Trimestre' ],
                'hAxis' => [ 'title' => 'Presenze' ],
            ],
        ]);?>


    </div>

<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-5">
                <h2> Tabella Giornaliera Delle Presenze </h2>

 <?php

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'PresEnt',
            'TotPres',
        ],  
]);?>



</div>
