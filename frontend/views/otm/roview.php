<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//** @var frontend\models\OspitiTessera $model */
?>


<div class="ospite-tessera-form">
    <div style="width: 700px;">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
            'cognome',
            'nome',
            'nascita',
            'genere',
            'nazionalita',
            'dataRilascio',
            ],
        ]) ?>




</div>
