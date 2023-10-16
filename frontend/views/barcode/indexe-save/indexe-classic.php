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

        // coding convention for the  display gives priority to RED for someone
        // that is suspended to the  SERVICE : SOSPESO.
        // then it codes with grey/yellow/orange the status of the  entrance card
        // as valid/near expired/expired/
 //Formatter based on style of teh row
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'Attivo'],
            'rowOptions' => function($model,$key,$index,$widget){
        if ($model['stato'] == 'SOSPESO'){
                   return ['style' => 'background-color: red'];}
           elseif ($model['dataScadenza'] < date("Y-m-d")) {
                return ['style' => 'background-color: orange'];
            }
          elseif ($model['dataScadenza']  == date("Y-m-d")) {
                return ['style' => 'background-color: yellow'];
            }
            else return ['style' => 'background-color: #92a8d1'];

        },
//New formatter

        'columns' => [
            ['attribute' => 'id',
                'headerOptions' => ['style' => 'width:10%'],],
            ['attribute' => 'stato',
                'headerOptions' => ['style' => 'width:10%'],],
            ['attribute' => 'entrance',
                'headerOptions' => ['style' => 'width:30%'],],
            ['attribute' => 'dataScadenza',
                ],

            [
                'class' => ActionColumn::className(),
                'header' => 'Azioni',
                'headerOptions' =>  ['style' => 'width:5%'],
                'template' => '{delete} {id} {info}',

                'buttons' => [
                    'info' => function ($url, $model) {

                        return Html::a('<div class="glyphicon glyphicon-info-sign"></div>', $url, [

                            'title' => Yii::t('app', 'Stato'),
                        ]);
                    },
                    'id' => function ($url, $model) {

                        return Html::a('<div class="glyphicon glyphicon-user"></div>', $url, [

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
        'bordered' => true,
        'striped' => false, //important striped must be false to allow teh color coding to work
        'condensed' => true,
        'hover' => true,
        'pjax'=>true,
                'pjaxSettings'=>[
            'neverTimeout'=>true,
           // 'afterGrid'=>'Input Info:',
        ]

    ]); ?>



    <?=Html::beginForm(['barcode/input'],'post');?>
     <label class="control-label">Inserimento dati: Lettore QR o ID : </label>
    <?= Html::input('text', 'barco', '', ['autofocus' => 'autofocus']) ?>

  <?= Html::submitButton('Inserisci ', ['class' => 'btn btn-info',]);?>
    <label class="control-label"> </label>
</div>
<br>
<?= Html::endForm();?>
<?php
//
//echo \kartik\popover\PopoverX::widget([
//    'header' => 'Ospite ID',
//    'type' => \kartik\popover\PopoverX::TYPE_INFO,
//    'placement' => \kartik\popover\PopoverX::ALIGN_RIGHT_TOP,
//    'content' => 'Andrea Baldi: Stato Attivo',
//    'toggleButton' => ['label'=>'Info Ospite', 'class'=>'btn btn-info'],
//]);
//
//?>


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



<?= Html::endForm();?>
</div>
