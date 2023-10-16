<?php

use kartik\daterange\DateRangePicker;
use kartik\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\modelsTesseraSearch $searchModel2 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Totale Presenze';
$this->params['breadcrumbs'][] = $this->title;


?>



<?php
//echo Url::home();
//echo Url::base();
//echo Url::canonical();
//Url::remember();
//echo Url::previous();
$request = Yii::$app->request;
$params = $request->bodyParams;
//var_dump($params);
?>
   

<?php  
 
// DateRangePicker in a dropdown format (uneditable/hidden input) and uses the preset dropdown.
// Note that placeholder setting in this case will be displayed when value is null
// Also the includeMonthsFilter setting will display LAST 3, 6 and 12 MONTHS filters.
echo '<label class="control-label">Date Range</label>';
echo '<div class="drp-container">';
echo DateRangePicker::widget([
    'name'=>'DataRange',
    'value'         => Yii::$app->request->post('DataRange', null),
    'presetDropdown'=>true,
    'attribute'=>'entrata ',
    'startAttribute'=>'TimeStart',
    'endAttribute'=>'TimeStop',
    'convertFormat'=>true,
    'includeMonthsFilter'=>true,
    'pluginOptions' => ['locale' => ['format' => 'Y-M-D ']],
    'options' => ['placeholder' => 'Seleziona intervallo...'],
    'language' => 'it'
]);
?>

<?=Html::beginForm(['presenze/presenzedp'],'post');?>


 <?=Html::submitButton('Esegui Report', ['class' => 'btn btn-info',]);?>
                     
<div class="Totale-presenze">

    <h1><?= Html::encode($this->title) ?></h1>

  </p>
 <p>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
             'attribute'=>'entrata',
             'value' =>'entrata',
            'filter'=>DateRangePicker::widget([
            'model' => $searchModel,
             'options' => ['class' => 'form-control', 'placeholder' => 'Search',],
            'attribute'=>'entrata',
             'name'=>'entrata',
             'startAttribute'=>'TimeStart',
             'endAttribute'=>'TimeEnd',
  
        ]),
                
],
                      [
             'attribute'=>'entrata',
              'value' => function ($model) {
              return($model->entrata);},
            'filter'=>DateRangePicker::widget([
            'model' => $searchModel,
            'attribute'=>'entrata',
             'name'=>'entrata',
             'startAttribute'=>'TimeStart',
             'endAttribute'=>'TimeEnd',
  
        ])       
],
        ], 
    
    
    ]); 
?>
   </p>  

</div>
