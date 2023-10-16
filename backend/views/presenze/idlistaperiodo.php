<?php

use app\models\Presenze;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */



/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'IDs Nel periodo ';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-4">
                <h2> Tabella Nuovi Ospiti Nel  Periodo</h2>
            </div>
<?=Html::beginForm(['presenze/idlistaperiodo'],'post');?>

                <div class="row">

                    <div class="col-lg-2">

                        <?=Html::beginForm(['presenze/maxpresenze'],'post');?>
                        <?php

                        //init values for $d1 and D2 are taken from teh controller that initialise to a default.
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
                <br>

<?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>
                
                    </div>
 <br>

                    <div class="row">
                        <div class="col-lg-4">
 <?php 


 include_once "commodity.php";

$res = (cmf($dataProvider));
$avsummary = "Ospiti Uomini : ".$res[0]." Ospiti Donne: ".$res[1];
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'cognome',
            'genere',
            'nazionalita',
        ],
        'panel' => [
            'after' => $avsummary,
            'type' => 'secondary'],
            'toolbar' =>  [
               '{export}'
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
        'fontAwesome' => false,
        'showConfirmAlert' => false,
    ],
]);

?>



</div>
