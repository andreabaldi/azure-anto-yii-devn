<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tessera $model */

$this->title = 'Create Tessera';
$this->params['breadcrumbs'][] = ['label' => 'Tesseras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//Yii::warning($params);
?>
<div class="tessera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
