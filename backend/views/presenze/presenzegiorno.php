<?php

use kartik\grid\GridView;
use yii\helpers\Html;

//use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\Presenze $model */


$this->title = 'Presenze del Giorno';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-6">
                <h2> Tabella Entrata</h2>


                    <?php


 include_once "commodity.php";


  $tp = cp($dataProvider);

    $summary = "Presenze del giorno : ".$tp[0];

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'entrata',
            'nome',
            'cognome',
        
        ],
    'showPageSummary' => true,
    'panel' => [
         'before' => '<div style="padding-top: 7px;"><em>'.$summary.'</em></div>',
         'type' => 'secondary'],


]);?>

   


</div>
