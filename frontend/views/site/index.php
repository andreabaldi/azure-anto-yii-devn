<?php

/** @var yii\web\View $this */
use yii\widgets\ListView;
use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


$this->title = 'Antoniano Welcome Web App';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        
    <h1 class="display-4">Antoniano Welcome Web App</h1>
    <h2 class="display-4">Mensa Padre Ernesto!</h2>
        <img src='<?php echo Yii::$app->request->getBaseUrl(true); ?>/LogoAntoniano.png' />

    </div>

    <div class="body-content">

            <div class="text">
                <div class="row">

                <div class="col-lg-3">
                <h2>Gestione Presenze</h2>

                <p>Welcome Web App implementa i servizi informatici per la gestione delle
                    presenze degli ospiti della <b>Mensa Padre Ernesto </b>.
                    L'applicazione fornisce strumenti per gli <b>Operatori Antoniano  </b>addetti alla regolazione degli ingressi alla mensa al fine da
                    rendere semlice e scorrevole l'accesso in mensa,
                    <br>
                    Gli operatori delle Mensa potranno rilevare le presenze giornaliere degli ospiti tramite la lettura di un codice QR stampato sulla
                    tessera  personale rilasciata ad ognu ospite che usufruisce del servizio.
                    <br>
                    Il sistema le registra  la presenza nnel sistema e fornisce  all' operatore le informazioni essenzali
                    per l'ammissione dell' ospite al servizio.
                    <br>
                    L'operatore e' quindi in grado di  verificare in tempo reale la situazione dell' ospite in relazione a validita' della tessera,
                    correttezza' e completezza dell'anangrafica  e lo stato di servizio per l' ospite (Attivo, Non attivo, etc).

                    .</p>
                </div>
                <div class="col-lg-3">
                    <h2>Gestione Ospiti e Tessere </h2>

                    <p>Welcome Web App implementa i servizi informatici per la gestione
                         degli ospiti della <b>Mensa Padre Ernesto </b>.
                         L'applicazione fornisce strumenti per i  <b>Volontari Antoniano  </b> addetti alla gestione degli Ospiti e delle loro Tessere.
                        <br>
                        I Volontari potranno gestire i dati anagrafici degli Ospiti al fine di aggiornarli, consultarli ed associarli al munumero di
                        tessera necessario per poter accedere al servizio.
                        <br>
                        Accade spesso che gli ospiti perdano e si dimentichino la tessera, per cui e' necessario poterla ricercare al fine da
                        predisporne una nuova stampa
                        o i volontari hanno dimenticato la tesserIn particolare per il volontario sara possibile gestire le tessere in scadenza,
                        rinnovandole
                        <br>
                        L'operatore e' quindi in grado di  verificare in tempo reale la situazione dell' ospite in relazione a validita' della tessera,
                        correttezza' e completezza dell'anangrafica  e lo stato di servizio per l' ospite (Attivo, Non attivo, etc).
                </div>
                    <div class="col-lg-3">
                        <h2>Stampa Tessere </h2>

                        <p>Welcome Web App implementa i servizi informatici per il rinnovo e la  Stampa
                            delle tessere.
                            L'applicazione fornisce strumenti per i  <b>Volontari Antoniano  </b> addetti alla gestione degli Ospiti e delle loro Tessere.
                            <br>
                            I Volontari potranno gestire i dati anagrafici degli Ospiti al fine di aggiornarli, consultarli ed associarli al munumero di
                            tessera necessario per poter accedere al servizio.
                            <br>
                            Accade spesso che gli ospiti perdano e si dimentichino la tessera, per cui e' necessario poterla ricercare al fine da
                            predisporne una nuova stampa
                            o i volontari hanno dimenticato la tesserIn particolare per il volontario sara possibile gestire le tessere in scadenza,
                            rinnovandole
                            <br>
                            L'operatore e' quindi in grado di  verificare in tempo reale la situazione dell' ospite in relazione a validita' della tessera,
                            correttezza' e completezza dell'anangrafica  e lo stato di servizio per l' ospite (Attivo, Non attivo, etc).
                            TBC
                        .</p>
  
</div>
              

             


                

            </div>
        </div>

    </div>
</div>
