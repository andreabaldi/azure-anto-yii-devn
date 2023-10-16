<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    
    'id' => 'app-antoniano-fe',
    'name' => 'Antoniano Web Presenze (DEV)',
    'language' => 'it', // Set the language here
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'baseUrl' =>  'http://localhost:8888/anto-yii-devclean/frontend/',
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],


    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            'bsVersion' => '5.x',
            'downloadAction' => 'gridview/export/download',
            // 'i18n' => [],
        ],
    ],
    
    
    'params' => $params,
];


