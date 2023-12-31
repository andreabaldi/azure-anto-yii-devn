<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \backend\models\Tessera $model */

$this->title = 'Update Tessera: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tesseras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tessera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
