<?php

use yii\helpers\Html;

/** @var yii\web\View $this */

/** @var app\models\Ospiti $ospiti */
/** @var app\models\Tessera $tessera */



$this->title = 'Create Ospiti and Tessera';
$this->params['breadcrumbs'][] = ['label' => 'Ospiti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-tessera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
       // 'ospiti' => $ospiti,
       // 'tessera' => $tessera,
    ]) ?>

</div>
