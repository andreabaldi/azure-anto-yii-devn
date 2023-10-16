<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \frontend\models\OspitiTessera $ot */

$this->title = $ot->id;
$this->params['breadcrumbs'][] = ['label' => 'Ospiti Tessere', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <div style="width: 600px;">
    <?= DetailView::widget([
        'model' => $ot,
        'attributes' => [
            'id',
            'cognome',
            'nome',
            'nascita',
            'genere',
            'nazionalita',
            'dataRilascio',
            'dataUltimoRinnovo',
            'dataScadenza',
            ['attribute' => 'printme',
            'filter' => [0 => 'NO', 1 => 'Rinnovo', 2 => 'Pera',3 => 'Nuovo'],
        ], 
        ],
    ]) ?>
        <?= Html::a('Aggiorna', ['update', 'id' => $ot->id], ['class' => 'btn btn-primary']) ?>

</div>
