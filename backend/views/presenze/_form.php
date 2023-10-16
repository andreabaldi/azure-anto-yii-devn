<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Presenze $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ospiti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->Label() ?>

    <?= $form->field($model, 'entrata')->Label() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
