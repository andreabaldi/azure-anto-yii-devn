<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Barcode $model */

$this->title = 'Update Barcode: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Barcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="barcode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
