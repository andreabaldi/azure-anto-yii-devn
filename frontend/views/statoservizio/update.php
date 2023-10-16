<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Statoservizio $model */

$this->title = 'Aggiorna Statoservizio: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Statoservizios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="statoservizio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formro', [
        'model' => $model,
    ]) ?>

</div>