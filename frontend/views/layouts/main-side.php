<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
            <?php
            use kartik\sidenav\SideNav; ?>
    <div class="nav nav-pills nav-stacked">
        <div class="span-6">
        <?php

            echo SideNav::widget([
                'type' => SideNav::TYPE_PRIMARY,
                'heading' => 'SideBar',
                'items' => [
                    [
                        'url' => '#',
                        'label' => 'Home',
                        'icon' => 'home'
                    ],
                    [
                        'label' => 'Manuali D\' Uso ',
                        'items' => [

                            ['label' => 'Manuale Utente', 'url' => ['../../../manuals/webappUserManual.pdf']],
                            ['label' => 'Casi D\'Uso', 'url' => ['../../../manuals/CasidiUso.pdf']],
                            ['label' => 'Come Fare', 'url' => ['../../..//manuals/HowTo.pdf']],
                        ],
                    ],
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

                ],
            ]);
            ?>
        </div>
    </div>
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
            <?= $content ?>
           <?= Alert::widget() ?>
    </div>
    </div>
    </main>
    <?php $this->beginBody() ?>
    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();




