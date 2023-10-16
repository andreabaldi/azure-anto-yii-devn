  <?php

  use yii\helpers\Html;
  use yii\widgets\ActiveForm;

  /** @var yii\web\View $this */
/** @var \backend\models\OspitiTesseraSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ospiti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cognome') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'nascita') ?>

    <?= $form->field($model, 'genere') ?>

    <?= $form->field($model, 'nazionalita') ?>

    <?= $form->field($model, 'dataRilascio') ?>

    <?= $form->field($model, 'dataUltimoRinnovo') ?>

    <?= $form->field($model, 'dataScadenza') ?>



    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
