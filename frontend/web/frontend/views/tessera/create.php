<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \backend\models\Tessera $model */

$this->title = 'Create Tessera';
$this->params['breadcrumbs'][] = ['label' => 'Tesseras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tessera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
