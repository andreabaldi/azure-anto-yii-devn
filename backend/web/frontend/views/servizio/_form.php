<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Statoservizio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="statoservizio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'stato')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sospesaDa')->textInput() ?>

    <?= $form->field($model, 'sospesaAl')->textInput() ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
