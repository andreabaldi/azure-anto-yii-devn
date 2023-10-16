<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $ospite */
/** @var \backend\models\Tessera $tessera */


$this->title = 'Aggiorna Ospiti Tessera: ' . $ospite->id;
$this->params['breadcrumbs'][] = ['label' => 'Ospiti Tessera', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $ospite->id, 'url' => ['view', 'id' => $ospite->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ospiti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'ospite' => $ospite,
        'tessera' => $tessera,
    ]) ?>

</div>
