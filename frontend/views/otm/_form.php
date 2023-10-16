<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use diggindata\countrylist\CountryList;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $ospite */
/** @var \backend\models\Tessera $tessera */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="ospite-tessera-form">
    <div style="width: 700px;">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($ospite); ?>
    <?= $form->errorSummary($tessera); ?>

    <?= $form->field($ospite, 'id')->textInput(['disabled'=>true]) ?>

    <?= $form->field($ospite, 'nome')->textInput(['maxlength' => true])?>

    <?= $form->field($ospite, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($ospite, 'nascita') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>

    
    <?=$form->field($ospite, 'genere')->dropDownList(['F'=>'F','M'=>'M']) ;?>

    <?php 
    //http://www.bsourcecode.com/yiiframework2/yii2-0-display-dropdownlist/
    // Code for dropdownlist
    // $countries=CountryList::getList();
   //  var_dump($countries);?>
   <?php

include "commodity.php";?>

  <?=$form->field($ospite, 'nazionalita')->dropDownList($countrynames) ;?>

    

    <!-- <?= $form->field($ospite, 'nazionalita')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($tessera, 'dataRilascio') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', ]) ?>

    <?= $form->field($tessera, 'dataUltimoRinnovo') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',])  ?>

    <?= $form->field($tessera, 'dataScadenza') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',])  ?>

    <?=$form->field($tessera, 'printme')->dropDownList(['0'=>'NO','1'=>'Rinnovo','2'=>'Persa','3'=>'Nuova']) ;?>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>




</div>
