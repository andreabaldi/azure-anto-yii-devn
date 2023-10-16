<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $ospite */
/** @var \backend\models\Tessera $tessera */



$this->title = 'Scelta Modalita\'Stampa Tessera: ' . $tessera->id;
$this->params['breadcrumbs'][] = ['label' => 'Ospiti Tessera', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tessera->id, 'url' => ['view', 'id' => $tessera->id]];
$this->params['breadcrumbs'][] = 'StampaMi';
?>
<div class="tessera-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?php 


    $form = ActiveForm::begin();
    echo $form->field($tessera, 'printme')->dropDownList(['0'=>'NO','1'=>'Rinnovo','2'=>'Persa','3'=>'Nuova']) ;?>
     <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
