<?php 
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
?>
<div class="pre-invoice-search">


    <?php

    	$form = ActiveForm::begin([

    		'action' => ['index'],

    		'method' => 'get',

    	]);

    

	    echo FieldRange::widget([

		    'form' => $form,

		    'model' => $model,

		    'label' => 'Enter date range',

		    'attribute1' => 'operation_date',

		    'attribute2' => 'order_eta',

		    'type' => FieldRange::INPUT_DATETIME,

		]);

	 ?>

	 

	 <div class="form-group">

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>

    </div>

    