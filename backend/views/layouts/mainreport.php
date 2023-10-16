<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
       ['label' => 'Home BE', 'url' => ['/site/index']],
       // ['label' => 'Home FE', 'url' => [Yii::$app->urlManager->getBaseUrl()]],


       // ['label' => 'Test for AB', 'url' => ['/site/ab']],qw

            [
                'label' => 'Presenze Report',
                'items' => [
                    ['label' => ' Presenze', 'url' => ['/presenze/index']],
                    ['label' => ' Presenze Pager', 'url' => ['/presenze/pager']],
                    ['label' => ' Max Pres Ospiti', 'url' => ['/presenze/maxpresenze']],
                    ['label' => ' Genere Ospiti', 'url' => ['/presenze/pie']],
                    ['label' => 'Nazioni', 'url' => ['/presenze/nazioni']],
                    ['label' => ' Presenze Anni', 'url' => ['/presenze/panno']],
                    ['label' => ' Presenze Trimestri', 'url' => ['/presenze/ptrimestri']],
                    ['label' => ' Presenze Mesi', 'url' => ['/presenze/pmesi']],
                    ['label' => ' Presenze Periodo', 'url' => ['/presenze/periodo']],
                    ['label' => ' Presenze Totali Periodo', 'url' => ['/presenze/ptotali']],
                    ['label' => ' Presenze  Ospiti', 'url' => ['/presenze/pcount']],
                    ['label' => ' Presenze  Plus', 'url' => ['/presenze/presenzeplus']],
                    ['label' => ' ID Conta Periodo', 'url' => ['/presenze/idcountperiodo']],
                    ['label' => ' ID Lista Periodo', 'url' => ['/presenze/idlistaperiodo']],
                ],
        ],
        [
            'label' => 'Kool Report',
            'items' => [
                ['label' => ' Top Presenze', 'url' => ['presenze/report']],
                ['label' => 'Presenze Ultimo Mese', 'url' => ['presenze/rapporto']],
            ],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }     
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

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
