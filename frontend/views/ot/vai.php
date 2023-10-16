<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var frontend\modelsTesseraSearch $searchModel2 */
/** @var yii\data\ActiveDataProvider $dataProvider2 */

$this->title = 'Ospiti and Tessere';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="ospiti-tessere-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ospiti Tessera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?=Html::beginForm(['ot/bulk'],'post');?>
<?=Html::dropDownList('action','',[''=>'Marca i selezionati Per: ','S'=>'Stampa','A'=>'Aggiorna'],['class'=>'dropdown',])?>
<?=Html::submitButton('Esegui', ['class' => 'btn btn-info',]);?>
<?=GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [
['class' => 'yii\grid\CheckboxColumn'],
'id',
'cognome',
'nome',
'dataScadenza',
],
]); ?>
<?= Html::endForm();?> 
    ?>


</div>
