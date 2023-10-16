<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Statoservizio $model */

$this->title = 'Crea Stato Servizio';
$this->params['breadcrumbs'][] = ['label' => 'Statoservizios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statoservizio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>