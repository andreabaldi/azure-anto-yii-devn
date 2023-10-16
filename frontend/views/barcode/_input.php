<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Barcode $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="barcode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>
    <?= $form->field($model, 'entrance')->textInput() ?>
    
    <div class="form-group"> 
        <?= Html::a('INPUT', ['insert', 'id' => $model->id, 'entrance' => $model->entrance,], ['class' => 'btn btn-primary']) ?>
    
    </div>

    <?php ActiveForm::end(); ?>

</div>
