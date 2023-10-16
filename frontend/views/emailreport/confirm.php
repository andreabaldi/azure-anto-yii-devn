<?php

use yii\bootstrap5\Html;
/** @var \frontend\models\Emailreport $model */

$this->title = 'Email Spedisci Rapporto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barcode-email">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       Email Spedita con successo a:
       <?php  echo "$model->email";?>  
    </p>
    
        </div>
    </div>

</div>
