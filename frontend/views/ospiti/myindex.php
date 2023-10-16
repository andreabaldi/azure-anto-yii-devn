<?php

use yii\widgets\DetailView;
use app\models\Ospiti;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Ospiti $model */


$this->title = 'Ultimi Ospiti Registrati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
       
                <h2> Tabella Ospiti</h2>


                    <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'cognome',
            'nazionalita',
            'dataRilascio',
            'dataScadenza',
        ],  
]);?>

   


</div>
