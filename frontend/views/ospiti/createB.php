<?php


use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_INLINE]);
$fldConfig = ['options' => ['class' => 'form-group mb-3 mt-2 mb-2 mr-2 me-2']];
echo Form::widget([
    'model'=> $model,
    'form'=>$form,
    'attributes'=>[
         'id' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'cognome' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nome' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nascita' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'genere' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nazionalita' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
             'actions'=>['type'=>Form::INPUT_RAW, 'value'=>Html::submitButton('Save', ['class'=>'btn btn-success'])]
    ]
]);
ActiveForm::end();
