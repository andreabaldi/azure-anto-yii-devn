<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\Emailreport $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;
use \frontend\models\Emailreport;
$this->title = 'Email Rapporto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barcode-email">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       Spedisci il report della giornata all' amministratore
    </p>

    <div class="row">
        <div class="col-lg-5">
        <!-- <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?> -->

            <?= $form->field($model, 'nome')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'oggetto') ?>

            <?= $form->field($model, 'corpo')->textarea(['rows' => 6]) ?>
           <?= $form->field($model, 'allegato')->fileInput(['maxlength' => true])  ?>

            <div class="form-group">
            <?= Html::submitButton('Send Email', ['class' => 'btn btn-primary email', 'name' => 'submit', 'value' => 'sendemail',
    "onclick" => 'if(confirm("Sei sicuro di voler spedire questa email ?")){
                     return true;
                    }else{
                     return false;
                    }',]) ?>
            </div>

            <!-- <?php ActiveForm::end(); ?> -->
        </div>
    </div>

</div>
