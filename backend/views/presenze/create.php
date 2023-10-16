<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Presenze $model */

$this->title = 'Create Ospiti';
$this->params['breadcrumbs'][] = ['label' => 'Presenze', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
