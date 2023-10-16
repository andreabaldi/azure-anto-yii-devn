<?php

/** @var yii\web\View $this */
use yii\widgets\ListView; 

use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Antoniano Web Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Antoniano Welcome Web App</h1>
        <h2 class="display-4">Mensa Padre Ernesto!</h2>
        <img src='<?php echo Yii::$app->request->getBaseUrl(true); ?>/LogoAntoniano.png' />
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md">
                <h2>Reportistica</h2>

                <p>II servizi di reportistica del  Welcome consentono di elaborare  statistiche e grafici sui dati collezionati dalla Web App.
                    In particolare si possono  analizzare le distribuzione degli ospiti sul territorio, l' eta' media degli ospiti per Regione Geografica.
                    Ci sono rapporti per il calcolo delle presense su base temporale Mensile, Trimestrale ed Annuale, come pure la possibilita' di selezionare
                    un periodo specifico di intresse.
                    Alcuni report consentono di calcolare statistiche relativi ai nuovi ospiti nel periodo, o di generarle la lista.
                    Ogni rapporto puo' essere esoprtato in diversi formati )PDF, csv, Excel, etc,) e ulteriormente elaborato con altri strumenti.

                </p>
            </div>




                

            </div>
        </div>

    </div>
</div>
