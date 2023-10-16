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
<?=Html::beginForm(['presenze/presenzek'],'post');?>
<?php

// DateRangePicker in a dropdown format (uneditable/hidden input) and uses the preset dropdown.
// Note that placeholder setting in this case will be displayed when value is null
// Also the includeMonthsFilter setting will display LAST 3, 6 and 12 MONTHS filters.
echo '<label class="control-label">Date Range</label>';
echo '<div class="drp-container">';
echo '</div>';
echo DateRangePicker::widget([
    'name' => 'date_range',
    'value'=> $d1." - ".$d2,
    'attribute'=>'datetime_range',
    'startAttribute'=>'datetime_min',
    'endAttribute'=>'datetime_max',
    'useWithAddon' => true,
    'containerOptions' => ['style' => 'min-width: 300px'],
    'language' => 'it',             // from demo config
    'hideInput' => false,           // from demo config
    'presetDropdown' => true,
    'includeDaysFilter' => true,
    'pluginOptions' => [
        //'locale'=>['format'=>$config['format']], // from demo config
        'separator'=> '-' ,       // from demo config
        'opens'=>'right'
    ]
]);
?>
<?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>


<br>



<div class="Opsitipresenze">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2><H@ titolo/h2>

        <?=

        BarChart::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'cognome:string',
                'TotPres',
            ],
        ]); ?>

        </p>
        <p>
  </p>
 <p>

        <h1><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'nome',
                'cognome',
                'TotPres',
            ],

        ]);?>

   </p>  

</div>
