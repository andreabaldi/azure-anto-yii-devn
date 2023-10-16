<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \backend\models\Tessera $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tessera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'dataRilascio')->textInput() ?>

    <?= $form->field($model, 'dataUltimoRinnovo')->textInput() ?>

    <?= $form->field($model, 'dataScadenza')->textInput() ?>

    <?= $form->field($model, 'QRfilename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TSfilename')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
