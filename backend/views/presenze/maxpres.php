<?php

use kartik\daterange\DateRangePicker;
use kartik\grid\GridView;
use sjaakp\gcharts\BarChart;
use yii\helpers\Html;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\modelsTesseraSearch $searchModel2 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Ospiti Con Maggiore Presenza';
$this->params['breadcrumbs'][] = $this->title;


?>
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
<?= Html::label('Limite', ['class' => 'label']) ?>
<?= Html::input('number', 'limite', $limite, ['class' => 'input',
    'min' => 0,
    'max' => 500],
) ?>
<!-- --><?php //
////use kartik\daterange\DateRangePicker;
//echo DateRangePicker::widget([
//    'name' => 't1_t2',
//    'id' =>'t1_t2',
//   // 'model'=>$model,
//    'value' => '03/01/2022 - 02/28/2023',
//    'readonly' => true,
//     'presetDropdown'=>true,
//    'includeMonthsFilter'=>true,
//    'attribute'=>'datetime_range',
//    'convertFormat'=>false,
//    'pluginOptions'=>[
//        'format'=>'yyyy-MM-dd',
//    ]
//]);
?>
<br>
<?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>
    </div>
</div>
                   
 <br>

<div class="Totale-presenze">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2><?= $var =  'Nel Periodo :'. $d1 . " :".$d2;Html::encode($var) ?></h2>

    <?=

    BarChart::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'cognome:string',
            'TotPres',
        ],
        'options' => [
            'title' => 'Gli ospiti più assidui della mensa',
            'bars' => 'horizontal',
            'colors' => ['green'],
            'vAxis' => [ 'title' => 'Opsite' ],
            'hAxis' => [ 'title' => 'Presenze' ],
            ]

    ]); ?>

  </p>
 <p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
             'cognome',
             'TotPres',
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
