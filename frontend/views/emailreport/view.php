<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Emailreport $model */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Rapporto Email', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="emailreport-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aggiorna', ['update', 'email' => $model->email], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Invia', ['sendemail', 'email' => $model->email], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sicuro di inviare la mail con allegato?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Cancella', ['delete', 'email' => $model->email], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler rimuovere questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'cognome',
            'email:email',
            'oggetto',
            'corpo',
            'allegato',
        ],
    ]) ?>

</div>
