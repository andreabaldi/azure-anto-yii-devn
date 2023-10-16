<?php

use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use sjaakp\gcharts\BarChart;


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;

use yii\captcha\Captcha;
use yii\jui\DatePicker;


/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'Numero IDs Nel periodo ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-4">
                <h2> Numero ID nel  Periodo</h2>
<?=Html::beginForm(['presenze/idcountperiodo'],'post');?>



<?php 
$fdate = '';

echo DatePicker::widget([
    'name'  => 'from_date',
    'options' => ['placeholder' => 'Data: Da...'],
    'value' => $d1,
    'dateFormat' => 'yyyy-MM-dd',
]);

$tdate = '';
echo DatePicker::widget([
    'name'  => 'to_date',
    'options' => ['placeholder' => 'Data: A...'],
    'value' => $d2,
    'dateFormat' => 'yyyy-MM-dd',
]);?>
                <br>

<?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>
            </div>
                   
 <br>

                <div "barchart">

                <?php
                echo BarChart::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'Mese:string',
                        'NuoviOspiti'
                    ],
                    'options' => [
                        'title' => 'Nuovi ID nel Periodo',
                        'bars' => 'horizontal',
                        'colors' => ['green','red'],
                        'vAxis' => [ 'title' => 'Mese' ],
                        'hAxis' => [ 'title' => 'Nuovi id' ],
                    ],
                ]);?>


            </div>


 <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'Anno',
            'Mese',
            'NuoviOspiti',
        ],  
]);?>



</div>
