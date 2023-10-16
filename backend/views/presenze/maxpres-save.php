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

<?=Html::beginForm(['presenze/maxpresenze'],'post');?>
<?php

//init values for $d1 and D2 are taken from teh controller that initialise to a default.
echo Html::label('Periodo', ['class' => 'label']);
echo DatePicker::widget([
    'name'  => 'from_date',
    'options' => ['placeholder' => 'Data: Da...'],
    'language' => 'it',
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
<?= Html::label('Limite', ['class' => 'label']) ?>
<?= Html::input('number', 'limite', 30, ['class' => 'input',
    'min' => 10,
    'max' => 100],
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
        
    ]); 
?>
   </p>  

</div>
