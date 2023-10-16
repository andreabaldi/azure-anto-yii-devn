<?php

use frontend\models\Barcode;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
/** @var yii\web\View $this */
/** @var frontend\models\BarcodeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var frontend\models\Barcode $model */
/** @var yii\widgets\ActiveForm $form */
use yii\widgets\Pjax;
use kartik\export\ExportMenu;


//$this->title = 'Lettura Ingressi';
// No title to save some space
$this->params['breadcrumbs'][] = $this->title;





?>
<div class="barcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>-->
<!--        --><?php //= Html::a('Create Barcode', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->


    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
   $deleteOptions = ['class' => 'glyphicon glyphicon-trash', 'data-modal-type' => 'confirm',
    'label' => '<i class="fas fa-remove"></i>', 'data-type' => 'danger', 'data-method' =>'post',
    'data-confirm' => Yii::t('app', 'Sicuro di voler rimuovere la presenza?')];

   $gridColumns = [

        //    ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id',
                'headerOptions' => ['style' => 'width:10%'],
                'value' => function ($model, $key, $index, $widget) {
                    return "<div style='background-color:lightgreen  '>".Yii::$app->formatter->asText($model['id'])."</div>";
                   },
                   'headerOptions' => ['class' => 'kv-align-center kv-align-middle'],
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
            ],
            ['attribute' => 'entrance',
            'label' => 'Entrata',
                 'headerOptions' => ['style' => 'width:20%'],],
            ['attribute' => 'stato',
                'headerOptions' => ['style' => 'width:10%'],
                'hiddenFromExport'=>true],
            ['attribute' => 'dataScadenza',
            'hiddenFromExport'=>true,
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
            'hiddenFromExport'=>true,
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
                'contentOptions' => ['class' => 'text-center'],

                ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'header' => 'Azioni',
                'headerOptions' =>  ['style' => 'width:10%'],
                'template' => ' {id} {tessera} {info} {listpres} {delete}',



                'buttons' => [


                    'delete' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [

                            'title' => Yii::t('app', 'Rimuovi'),
                            'class' => 'btn btn-danger',
                            'data-method' =>'post',
                          //  'data-pjax' => false,
                           // 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                            // "onclick" => 'if(confirm("Sei sicuro di voler rimuovere questa entrata?")){
                            //     return true;
                            //    }else{
                            //     return false;
                            //    }'
                        ]);
                    },

                    'info' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [

                            'title' => Yii::t('app', 'Stato'),
                            'class' => 'btn btn-warning',
                        ]);
                    },
                    'tessera' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-credit-card"></span>', $url, [

                            'title' => Yii::t('app', 'Tessera'),
                            'class' => 'btn btn-info',
                        ]);
                    },

                    'id' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, [

                            'title' => Yii::t('app', 'Id'),
                            'class' => 'btn btn-info',
                        ]);
                    },
                    'listpres' => function ($url, $model) {

                        return Html::a('<span class="glyphicon glyphicon-th-list"></span>', $url, [

                            'title' => Yii::t('app', 'Lista Presenza'),
                            'class' => 'btn btn-info',
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                        $url = $action.'?id='.$model['id'];
                        return $url;
                },
            ],

        ];

?>
 <?php
 $uid = \Yii::$app->user->identity->username;
 date_default_timezone_set("Europe/Rome");

$infoh = "Operatore Mensa Padre Ernesto : ".$uid." [".date('h:i:sa')."]";
$infof = "Ingresso Mensa Toale Presense ".$dataProvider->totalCount;
?>

<?php Pjax::begin(); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,

        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'Attivo'],
        'rowOptions' => function($model,$key,$index,$widget){
            if ($model['stato'] == 'SOSPESO'){
                     return ['style' => 'background-color: orange'];
                     }
                  elseif ($model['stato'] == 'DECEDUTO'){
                      return ['style' => 'background-color: violet'];
                  }
                  elseif ($model['stato'] == 'INATTIVO'){
                      return ['style' => 'background-color: grey'];
                  }
            elseif ($model['stato'] == 'NUOVO'){
                return ['style' => 'background-color: yellow'];
            }
                  else

                      return ['style' => 'background-color: lightgrey'];
        },

        'columns' => $gridColumns,
        //'layout' => $layout,
        'bordered' => true,
        'pager' => [
            'firstPageLabel' => 'Prima',
            'lastPageLabel' => 'Ultima',
        ],
        'showPageSummary' => false,
        'striped' => false, //important striped must be false to allow teh color coding to work
        'condensed' => true,
        'hover' => true,
        'pjax'=>true,
                'pjaxSettings'=>[
            'neverTimeout'=>true,
            'beforeGrid'=>'Ultimo ingresso:',
            'afterGrid'=>'Output Info:',

     ],

     'panel' => [
        'after' => $infof,
        'heading' => '<i class="fas fa-book"></i>  Antoniano  Welcome - Web App',
        'type' => 'primary',
        'before' => '<div style="padding-top: 7px;"><em>'.$infoh.'</em></div>',
            ],
    'toolbar' =>  [
        '{export}',
        '{toggleData}'
    ],
    'exportConfig' => [
        'pdf' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
        'csv' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
        'txt' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
        'json' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],
        'xls' => ['filename' => 'Lista-Presenze-'.date("Y-m-d"),],],
    'export' => [
        'fontAwesome' => true ,
        'showConfirmAlert' => false ],


    ]);



    ?>




<?php Pjax::end();?>

    <?=Html::beginForm(['barcode/input'],'post');?>

     <label class="control-label">Inserimento dati: Lettore QR o ID : </label>
    <?= Html::input('text', 'barco', '', ['autofocus' => 'autofocus']) ?>

  <?= Html::submitButton('Inserisci ', ['class' => 'btn btn-info',]);?>
    <label class="control-label"> </label>
</div>
<br>
<?= Html::endForm();?>


<!-- <hr class="rounded"> -->


<?=Html::beginForm(['barcode/manage'],'post');?>
<div class="btn-group" role="group" aria-label="Post data">

<?= Html::submitButton('Email report', ['class' => 'btn btn-primary email', 'name' => 'submit', 'value' => 'email-report',]) ?>

<?php //= Html::submitButton('Carica Tabella ', ['class' => 'btn btn-primary canc',
//    'name' => 'submit', 'value' => 'carica',
//    "onclick" => 'if(confirm("Sei sicuro di voler caricare la tabella nel database?")){
//                     return true;
//                    }else{
//                     return false;
//                    }'
//]) ?>



<?= Html::submitButton('Chiudi Sessione Pranzo', ['class' => 'btn btn-primary chiudi', 'name' => 'submit', 'value' => 'chiudisessionepranzo',
    "onclick" => 'if(confirm("Sei sicuro di voler chiudere la sessione del giorno?")){
                     return true;
                    }else{
                     return false;
                    }',]) ?>

    <?= Html::submitButton('Chiudi Sessione Colazione', ['class' => 'btn btn-primary chiudi', 'name' => 'submit', 'value' => 'chiudisessionecolazione',
        "onclick" => 'if(confirm("Sei sicuro di voler chiudere la sessione del giorno?")){
                     return true;
                    }else{
                     return false;
                    }',]) ?>

<!--                    --><?php //= Html::submitButton('Cancella Tabella Conf', ['class' => 'btn btn-danger canc',
//    'name' => 'submit', 'value' => 'rimuovi',
//    "onclick" => 'if(confirm("Sei sicuro di voler cancellare tutte le  entrate in tabella?")){
//                     return true;
//                    }else{
//                     return false;
//                    }',]) ?>




