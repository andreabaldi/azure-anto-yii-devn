
<?php use yii\helpers\Html;

use kartik\sidenav\SideNav;


use yii\bootstrap\Nav;


use yii\bootstrap\NavBar;

use yii\widgets\Breadcrumbs;

use frontend\assets\AppAsset;


AppAsset::register($this);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

</head>

<body>

<?php $this->beginBody() ?>


<div class="wrap">

    <?php

    NavBar::begin([

        'brandLabel' => 'My Company',

        'brandUrl' => Yii::$app->homeUrl,

        'options' => [

            'class' => 'navbar-inverse navbar-fixed-top',

        ],

    ]);


    echo Nav::widget([

        'options' => ['class' => 'navbar-nav navbar-right'],


    ]);


    NavBar::end();

    ?>


    <div class="container">

        <?= Breadcrumbs::widget([

            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

        ]) ?>


        <div class='col-lg-2' >

            <?php

            echo SideNav::widget(

                [

                    'type' => SideNav::TYPE_PRIMARY,

                    'items' => [

                     [  'label' => 'Manuali D\' Uso ',
                        'items' => [

                            ['label' => 'Manuale Utente', 'url' => ['../../../manuals/webappUserManual.pdf']],
                            ['label' => 'Casi D\'Uso', 'url' => ['../../../manuals/CasidiUso.pdf']],
                            ['label' => 'Come Fare', 'url' => ['../../..//manuals/HowTo.pdf']],]],

                        [
                            'label' => 'Gestione Servizio',
                            'items' => [

                                ['label' => 'Gestione Ingressi', 'url' => ['/barcode/indexe']],
                                //['label' => 'BarCode Crud', 'url' => ['/barcode/index']],
                                ['label' => 'Rapporto via Email ', 'url' => ['/emailreport/index']],
                                ['label' => 'Stato Servizio', 'url' => ['/statoservizio/index']],
                            ],
                        ],
                        [
                            'label' => 'Gestione Ospiti & Tessere',
                            'items' => [

                                //  ['label' => 'Query Ospiti', 'url' => ['/ospiti/index']],
                                // ['label' => 'Query Tessere', 'url' => ['/tessera/index']],
                                ['label' => 'Ricerca & Gestione', 'url' => ['/otm/index']],

                            ],
                        ],
                        [
                            'label' => 'Stampa  Tessere',
                            'items' => [
                                ['label' => 'Stampa  Tessere', 'url' => ['/otm/tprint']],
                                ['label' => 'Ultime Tessere Rilasciate', 'url' => ['/otm/rilasciotessere']],
                            ],
                        ],
                        ['label' => 'App Info', 'url' => ['/site/about']],

                    ]]);



            ?>

        </div>

        <div class='col-lg-9' >

            <?= $content ?>

        </div>


    </div>

</div>


<footer class="footer">

    <div class="container">

        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>


        <p class="pull-right"><?= Yii::powered() ?></p>

    </div>

</footer>


<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>