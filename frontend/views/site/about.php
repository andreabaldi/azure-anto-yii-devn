<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Antoniano About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $versione = "Versione:2.0.1";
    echo " Antoniano Wep App Presenze DEV".$versione." --: ".date('l jS \of F Y h:i:s A')."<br>";
    echo $versione."che e' stata completamente riscritta sfruttando le caratteristiche del Framework YII!"."<br>";
    ?>   
    </p>
</div>
