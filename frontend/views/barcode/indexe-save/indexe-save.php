<?php

use frontend\models\Barcode;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\PopoverX;
use kartik\growl\GrowlAsset;
use kartik\base\AnimateAsset;
GrowlAsset::register($this);
AnimateAsset::register($this);


/** @var yii\web\View $this */
/** @var frontend\models\BarcodeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var frontend\models\Barcode $model */
/** @var yii\widgets\ActiveForm $form */


$this->title = 'Lettura Ingressi';
$this->params['breadcrumbs'][] = $this->title;




?>
<div class="barcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?php //= Html::a('Create Barcode', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->


    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,

        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'Attivo'],
        'rowOptions' => function($model,$key,$index,$widget){
            if ($model['stato'] == 'SOSPESO'){
                     return ['style' => 'background-color: orange'];
                     }
                  else return ['style' => 'background-color: lightgrey'];
        },
        'columns' => [
            ['attribute' => 'entrance',
                'headerOptions' => ['style' => 'width:20%'],],
            ['attribute' => 'id',
                'headerOptions' => ['style' => 'width:10%'],],
            ['attribute' => 'stato',
                'headerOptions' => ['style' => 'width:10%'],],
            ['attribute' => 'dataScadenza',
                'headerOptions' => ['style' => 'width:30%'],
                'value' => function ($model, $key, $index, $widget) {
                if ($model['dataScadenza'] < date("Y-m-d"))
                    return "<div style='background-color:red'>".Yii::$app->formatter->asDate($model['dataScadenza'])."</div>";
                   elseif ($model['dataScadenza']  == date("Y-m-d")) {
                       return "<div style='background-color:yellow'>".Yii::$app->formatter->asDate($model['dataScadenza'])."</div>";
                   }
                else return Yii::$app->formatter->asDate($model['dataScadenza']);
                },
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center']
            ],

            ['attribute' => 'anagrafica',
                'headerOptions' => ['style' => 'width:10%'],
                'value' => function ($model, $key, $index, $widget) {
                    if ( !strcmp($model['nascita'], "1900-01-01")
                        || !strcmp($model['nazionalita'],  "SCONOSCIUTA")
                        || !strcmp($model['genere'],  "X"))
                         return "<div style='background-color:red'>".Yii::$app->formatter->asText("Non Aggiornata", 2)."</div>";
                    else return "<div style='background-color:lightgreen'>".Yii::$app->formatter->asText("Aggiornata", 2)."</div>";


                },
                'header' => 'Stato Anagrafica <br>',
                'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center']

                ],
            [
                'class' => ActionColumn::className(),
                'header' => 'Azioni',
                'headerOptions' =>  ['style' => 'width:10%'],
                'template' => '{delete} {id} {info}',

                'buttons' => [
                    'info' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [

                            'title' => Yii::t('app', 'Stato'),
                        ]);
                    },
                    'id' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, [

                            'title' => Yii::t('app', 'Id'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                        $url = $action.'?id='.$model['id'];
                        return $url;
                },
            ],
        
        ],
        
        //'layout' => $layout,
        'bordered' => true,
        'pager' => [
            'firstPageLabel' => 'Prima',
            'lastPageLabel' => 'Ultima',
        ],
        'striped' => false, //important striped must be false to allow teh color coding to work
        'condensed' => true,
        'hover' => true,
        'pjax'=>false,
                'pjaxSettings'=>[

            'neverTimeout'=>true,
            'beforeGrid'=>'Ultimo ingresso:',
            'afterGrid'=>'Output Info:',
        ],
      //  'showPageSummary' => true,
     'panel' => [
         'after' => 'Info:',
         'type' => 'secondary'],
     'toolbar' =>  [
         '{export}'
     ],
     'toolbar' =>  [
         '{export}'
     ],
     'exportConfig' => [ 
         'csv' => [],
         'txt' => [],
         'xls' => [], ],
     'export' => [
         'fontAwesome' => true ,
         'showConfirmAlert' => false ],


    ]); ?>



    <?=Html::beginForm(['barcode/input'],'post');?>
     <label class="control-label">Inserimento dati: Lettore QR o ID : </label>
    <?= Html::input('text', 'barco', '', ['autofocus' => 'autofocus']) ?>

  <?= Html::submitButton('Inserisci ', ['class' => 'btn btn-info',]);?>
    <label class="control-label"> </label>
</div>
<br>
<?= Html::endForm();?>


<hr class="rounded">

<?=Html::beginForm(['barcode/manage'],'post');?>

<?= Html::submitButton('Carica Tabella ', ['class' => 'btn btn-primary canc',
    'name' => 'submit', 'value' => 'carica',
    "onclick" => 'if(confirm("Sei sicuro di voler caricare la tabella nel database?")){
                     return true;
                    }else{
                     return false;
                    }'
]) ?>

<?= Html::submitButton('Cancella Tabella Conf', ['class' => 'btn btn-danger canc',
    'name' => 'submit', 'value' => 'rimuovi',
    "onclick" => 'if(confirm("Sei sicuro di voler cancellare tutte le  entrate in tabella?")){
                     return true;
                    }else{
                     return false;
                    }',]) ?>



<?= Html::submitButton('Chiudi Sessione', ['class' => 'btn btn-primary chiudi', 'name' => 'submit', 'value' => 'chiudisessione',
    "onclick" => 'if(confirm("Sei sicuro di voler chiudere la sessione del giorno?")){
                     return true;
                    }else{
                     return false;
                    }',]) ?>

<?= Html::submitButton('Email report', ['class' => 'btn btn-primary email', 'name' => 'submit', 'value' => 'email-report',
    "onclick" => 'if(confirm("Sei sicuro di voler spedire via email la sessione del giorno?")){
                     return true;
                    }else{
                     return false;
                    }',]) ?>



</div>
