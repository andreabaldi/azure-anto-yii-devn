<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Barcode $model */

$this->title = 'Create Barcode';
$this->params['breadcrumbs'][] = ['label' => 'Barcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barcode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
