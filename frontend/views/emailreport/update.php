<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Emailreport $model */

$this->title = 'Aggiorna Rapporto Email : ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Rapporto Email', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'email' => $model->email]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="emailreport-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
