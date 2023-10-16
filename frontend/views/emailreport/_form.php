<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Emailreport $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php

include "email-list.php";?>
<div class="emailreport-form">

    <?php $form = ActiveForm::begin(); ?>
    

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->dropDownList($listaemail)?>

    <?= $form->field($model, 'oggetto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corpo')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'allegato')->FileInput([])->label("Cambia/Seleziona Allegato") ?>
    <?= $form->field($model, 'allegato')->label("Allegato Corrente") ?>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
