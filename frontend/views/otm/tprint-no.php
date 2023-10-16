<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ospiti and Tessere';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="ospiti-tessere-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <script type="text/javascript">

                function Select(start, stop) {
                    alert("Seleziona  :"+start.value +","+stop.value);
                    var keys = $('#abtable').yiiGridView('getSelectedRows');
                    alert(keys)
                    var items = $('#abtable').yiiGridView('getSelectedRows )

                     alert(items);
                    // var ele=document.getElementsByName('selezione[]');
                    //                     alert(" "+var+" ");
                    //  // alert(keys[0]);
                      // alert(keys[1]);
                
                       
                   // alert("vai   :"+keys[start.value]+keys[stop.value]);
                    //$.pjax.reload({container:'#abtable'});
                    
                }
        
                function Deselect(start, stop) {
                    alert("DeSeleziona  :"+start.value +","+stop.value);  
                }
        
                function FSelect(filesel) {
                    alert("Seleziona  :"+filesel.value);
                    
                    
                }
        
                function FDeselect(filedel) {
                    alert("DeSeleziona  :"+filedel.value);
                }

        </script>
        


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?=Html::beginForm(['otm/bulk'],'post');?>
                    
<?= Html::label('Intervallo', ['class' => 'label']) ?>
<?= Html::input('number', 'start', 0, ['class' => 'input',
                                         'min' => 0,
                                          'max' => 5000]) ?>
                                          
<?= Html::input('number', 'stop', 0, ['class' => 'input',
                                         'min' => 0,
                                          'max' => 5000]) ?>                                          
<?= Html::button('seleziona', [ 'class' => 'btn btn-secondary', 'onclick' => 'Select(start, stop)' ]) ?>
<?= Html::button('deseleziona',  ['class' => 'btn btn-secondary', 'onclick' => 'Deselect(start, stop)' ]) ?>
<br>
<?= Html::label('Seleziona da file', ['class' => 'label']) ?>
<?=Html::fileinput('filesel', 'filesel', ['class' => 'fileinput']); ?>
<?= Html::button('seleziona', [ 'class' => 'btn btn-secondary', 'onclick' => 'FSelect(filesel)' ]) ?>
 <?= Html::button('deseleziona',  ['class' => 'btn btn-secondary', 'onclick' => 'FDeselect(filedel)' ]) ?> 
 <br>
<?=Html::dropDownList('action','',['S'=>'Stampa','A'=>'Aggiorna'],['class'=>'dropdown',]);

?>                

<?=Html::submitButton('Esegui', ['class' => 'btn btn-info',
    'data-confirm' => "Sei sicuro di voler Stamapre le tessere?",]);?>

<?=GridView::widget([
'dataProvider' => $dataProvider,
'id'=>'abtable',
'columns' => [
['class' => 'yii\grid\CheckboxColumn',
'cssClass' => 'check' ,
'checkboxOptions' => function ($model, $key, $index, $column) {
    if ($model->id < 10)
     return ['checked' => true];
        else return ['checked' => false];
}],
'id',
'cognome',
'nome',
'dataScadenza',
],
    'rowOptions' => function($model,$key,$index,$widget){
        if ($model['dataScadenza'] < date("Y-m-d")) {
            return ['class' => 'table-danger',];
        } elseif ($model['dataScadenza']  == date("Y-m-d")) {
            return ['class' => 'table-warning',];
        }
        else return ['class' => 'table-success',];
    },
'floatFooter' => false, // disable floating of table footer
'pjax' => true, 
// parameters from the demo form
'responsive' => false,
'bordered' => true,
'striped' => true,
'condensed' => true,
'hover' => true,
'showPageSummary' => true,
'panel' => [
    'after' => '<div style="padding-top: 7px;"><em>*</em></div>',
    'heading' => '<i class="fas fa-book"></i>  Antoniano  Ospiti e Tessere',
    'type' => 'primary',
    'before' => '<div style="padding-top: 7px;"><em> Stampa Tessere.</em></div>',
],
// set the  toolbar
'toolbar' =>  [
    [
        'content' =>
            Html::a('<i class="fas fa-redo"></i>', ['tprint'], [
                'class' => 'btn btn-outline-secondary',
               
                'data-pjax' => 1, 
            ]), 
        'options' => ['class' => 'btn-group mr-2 me-2']
    ],
    '{toggleData}',
],

]); ?>
<?= Html::endForm();?> 





</div>
