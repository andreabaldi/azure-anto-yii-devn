<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var frontend\models\Statoservizio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="statoservizio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true, 'disabled'=>true]) ?>

    <?= $form->field($model, 'stato')->dropDownList(['NUOVO'=>'NUOVO','ATTIVO'=>'ATTIVO','INATTIVO' => 'INATTIVO', 'DECEDUTO' => 'DECEDUTO','SOSPESO'=>'SOSPESO','ACCOGLIENZA'=>'ACCOGLIENZA','COLLOQUIO'=>'COLLOQUIO']) ;?>

    <?= $form->field($model, 'sospesoDa')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($model, 'sospesoAl')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
