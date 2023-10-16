  <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\modelsOspitiSearch $ospitimodel */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ospiti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($ospitimodel, 'id') ?>

    <?= $form->field($ospitimodel, 'cognome') ?>

    <?= $form->field($ospitimodel, 'nome') ?>

    <?= $form->field($ospitimodel, 'nascita') ?>

    <?= $form->field($ospitimodel, 'genere') ?>

    <?= $form->field($ospitimodel, 'nazionalita') ?>

    

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
