<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $ospite */
/** @var \backend\models\Tessera $tessera */
/** @var yii\widgets\ActiveForm $form */

$this->title = $ospite->id;
$this->params['breadcrumbs'][] = ['label' => 'Ospiti Tessere', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $ospite,
        'attributes' => [
            'id',
            'cognome',
            'nome',
            'nascita',
            'genere',
            'nazionalita'
        ],
    ]) ?>


    <?= DetailView::widget([
        'model' => $tessera,
        'attributes' => [
            'dataRilascio',
            'dataUltimoRinnovo',
            'dataScadenza',
            'QRfilename',
            'TSfilename',
        ],
    ]) ?>
        <?= Html::a('Update', ['update', 'id' => $tessera->id], ['class' => 'btn btn-primary']) ?>

</div>
