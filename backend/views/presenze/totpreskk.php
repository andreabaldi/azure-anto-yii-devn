
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


$this->title = 'Presenze Report';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <h2> Tabella Entrate </h2>




            <?=Html::beginForm(['presenze/presenzek'],'post');?>
            <?php

            // DateRangePicker in a dropdown format (uneditable/hidden input) and uses the preset dropdown.
            // Note that placeholder setting in this case will be displayed when value is null
            // Also the includeMonthsFilter setting will display LAST 3, 6 and 12 MONTHS filters.
            echo '<label class="control-label">Date Range</label>';
            echo '<div class="drp-container">';
            echo DateRangePicker::widget([
                'name'=>'datepicker',
                'value'         => Yii::$app->request->post('datepicker', ),
                'presetDropdown'=>true,
                'attribute'=>'datetime_range',
                'startAttribute'=>'datetime_min',
                'endAttribute'=>'datetime_max',
                // 'convertFormat'=>true,
                // 'includeMonthsFilter'=>true,
                // 'pluginOptions' => ['locale' => ['format' => 'Y-M-D']],
                //  'options' => ['placeholder' => 'Seleziona intervallo...'],
                'language' => 'it'
            ]);
            ?>

        </div>


        <?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>


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

?>