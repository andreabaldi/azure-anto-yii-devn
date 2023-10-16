<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Statoservizio $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Statoservizios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="statoservizio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aggiorna', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'stato',
            'sospesoDa',
            'sospesoAl',
            'info:ntext',
        ],
    ]) ?>

</div>