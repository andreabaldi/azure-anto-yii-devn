<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Ospiti $ospiti */
/** @var app\models\Ospiti $tessera */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="ospiti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($ospiti, 'id')->textInput() ?>

    <?= $form->field($ospiti, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ospiti, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ospiti, 'nascita')->textInput() ?>

    <?= $form->field($ospiti, 'genere')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ospiti, 'nazionalita')->textInput(['maxlength' => true]) ?>

    <?= $form->field($tessera, 'dataRilascio')->textInput() ?>

    <?= $form->field($tessera, 'dataUltimoRinnovo')->textInput() ?>

    <?= $form->field($tessera, 'dataScadenza')->textInput() ?>

    <?= $form->field($tessera, 'QRfilename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($tessera, 'TSfilename')->textInput(['maxlength' => true]) ?>





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

