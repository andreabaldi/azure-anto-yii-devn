<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $ospite */
/** @var \backend\models\Tessera $tessera */

$this->title = 'Create Ospiti Tessera ';
$this->params['breadcrumbs'][] = ['label' => 'Ospiti Tessera', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-tessera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'ospite' => $ospite,
        'tessera' => $tessera,
    ]) ?>

</div>
