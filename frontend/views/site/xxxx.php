<?php



/** @var yii\web\View $this */
/** @var app\models\Ospiti $model */
/** @var yii\widgets\ActiveForm $form */


use kartik\builder\Form;
use kartik\form\ActiveForm;
use yii\helpers\Html;

$this->title = 'AB Testing page ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-ab-test">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    echo "php code starts"." --: ".date('l jS \of F Y h:i:s A')."<br>";

    $array1 = array(0 => 'zero_a', 2 => 'two_a', 3 => 'three_a');
    $array2 = array(1 => 'one_b', 3 => 'three_b', 4 => 'four_b');
    $result = $array1 + $array2;
    
    var_dump($result);


/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $ospite */
/** @var \backend\models\Tessera $tessera */
/** @var yii\widgets\ActiveForm $form */


$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_INLINE]);
$fldConfig = ['options' => ['class' => 'form-group mb-3 mt-2 mb-2 mr-2 me-2']];
echo Form::widget([
    'model'=>$ospite,
    'form'=>$form,
    'attributes'=>[
         'id' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'cognome' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nome' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nascita' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'genere' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nazionalita' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
             'actions'=>['type'=>Form::INPUT_RAW, 'value'=>Html::submitButton('Submit', ['class'=>'btn btn-primary'])]
    ]
]);
ActiveForm::end();