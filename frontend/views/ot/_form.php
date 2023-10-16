<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $ospite */
/** @var \backend\models\Tessera $tessera */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="ospite-tessera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($ospite, 'id')->textInput() ?>

    <?= $form->field($ospite, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ospite, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ospite, 'nascita') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($ospite, 'genere')->textInput(['maxlength' => false]) ?>

    <?= $form->field($ospite, 'nazionalita')->textInput(['maxlength' => true]) ?>

    <?= $form->field($tessera, 'dataRilascio') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($tessera, 'dataUltimoRinnovo') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($tessera, 'dataScadenza') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($tessera, 'QRfilename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($tessera, 'TSfilename')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
