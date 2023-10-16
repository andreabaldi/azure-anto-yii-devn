<?php

use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;

use yii\captcha\Captcha;
use yii\jui\DatePicker;


/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'Presenze Ospiti  Dettaglio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-4">
                <h2> Tabella Presenze Totali</h2>
<?=Html::beginForm(['presenze/presenzeplus'],'post');?>
            </div>
 
<?php
//echo Url::home();
//echo Url::base();
//echo Url::canonical();
//Url::remember();
//echo Url::previous();
//$request = Yii::$app->request;
//var_dump($request);
?>

                <div class="row">

                    <div class="col-lg-2">

                        <?=Html::beginForm(['presenze/maxpresenze'],'post');?>
                        <?php

                        //init values for $d1 and D2 are taken from teh controller that initialise to a default.pcount
                        echo Html::label('Periodo', ['class' => 'label']);

                        echo DateRangePicker::widget([
                            
                            'name' => 'date_range',
                            'value'=> $d1." - ".$d2,
                            'attribute'=>'datetime_range',
                            'startAttribute'=>'datetime_min',
                            'endAttribute'=>'datetime_max',
                            'useWithAddon' => true,
                            'containerOptions' => ['style' => 'min-width: 100px'],
                            'language' => 'it',
                            'hideInput' => false,
                            'presetDropdown' => true,
                            'includeDaysFilter' => true,
                            'pluginOptions' => [
                                'locale'=>['format' => 'YYYY-MM-DD'],
                                'separator'=> '-' ,
                                'opens'=>'right',
                                'todayHighlight' => true,
                            ]
                        ]);

                        ?>
                
<?= Html::label('Presenze => di :  ', ['class' => 'label']) ?>
<?= Html::input('number', 'limite', $limite, ['class' => 'input',
    'min' => 0,
    'max' => 400],
) ?>

<?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>
                    </div>

 <br>
                    <div class="row">
 <div class="col-8">
 <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'cognome',
            'genere',
            'nazionalita',
            'nascita',
            'Presenze',
            ['class' => ActionColumn::className(),
            'template' => '{idinfo}',
            'buttons' => [
                'idinfo' => function ($url, $model) {

                    return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, [

                        'title' => Yii::t('app', 'IdInfo'),
                        'class' => 'btn btn-info',
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                    $url = $action.'?did='.$model['id'];
                    return $url;
            },
            
        ],
    ],
  
    'panel' => [
        'type' => 'primary',
        
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
    // set export properties
]);?>



</div>
