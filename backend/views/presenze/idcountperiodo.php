<?php

use app\models\Presenze;
use yii\helpers\Html;

use kartik\grid\GridView;
use kartik\daterange\DateRangePicker;
use sjaakp\gcharts\BarChart;


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */



/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'Numero IDs Nel periodo ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-4">
                <h2> Numero Nuovi Ospiti Nel  Periodo</h2>
            </div>
<?=Html::beginForm(['presenze/idcountperiodo'],'post');?>



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
        include_once "commodity.php";

        $av1 = (int)av('NuoviOspiti', $dataProvider);
        $avsummary = "Madia Nuovi Ospiti: ".$av1;

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['attribute' => 'Anno',
                    'pageSummary' => '-',
                ],
                ['attribute' => 'Mese',
                    'pageSummary' => '-',
                ],
                ['attribute' => 'NuoviOspiti',
                    'pageSummary' => (true),
                    'value' => function ($model) {
                        if ($model)
                            return $model['NuoviOspiti'];
                    }
                ],
            ],
            'showPageSummary' => true,
            'panel' => [
                'after' => $avsummary,
                'type' => 'secondary'],
            'toolbar' =>  [
                '{export}'
            ],
            'toolbar' =>  [
                '{export}'
            ],
            'exportConfig' => [
                'html' => [],
                'csv' => [],
                'txt' => [],
                'xls' => [],
                'pdf' => [],
                'json' => [] ],
            'export' => [
                'fontAwesome' => true ,
                'showConfirmAlert' => false ],

        ]);
        ?>

</div>
