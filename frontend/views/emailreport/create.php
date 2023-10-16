<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Emailreport $model */

$this->title = 'Crea Rapporto Email';
$this->params['breadcrumbs'][] = ['label' => 'Rapport Email', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailreport-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
