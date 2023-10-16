<?php
use app\models\Presenze;
use yii\helpers\Html;
use kartik\grid\GridView;
use sjaakp\gcharts\BarChart;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\jui\DatePicker;


/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'Presenze Report';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <h2> Tabella Entrate </h2>
<?=Html::beginForm(['presenze/periodo'],'post');?>



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
        </div>
        <div "barchart">

        <?php
        echo BarChart::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                // 'Anno',
                'Mese:string',
                'Presenze',
                'Ospiti'
            ],
            'options' => [
                'title' => 'Presenze Mensili verso Ospiti',
                'bars' => 'horizontal',
                'colors' => ['green','red'],
                'vAxis' => [ 'title' => 'Trimestre' ],
                'hAxis' => [ 'title' => 'Presenze' ],
            ],
        ]);?>


    </div>
 <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'Anno',
            'Mese',
            'Presenze',
            'Ospiti',
        ],  
]);?>
