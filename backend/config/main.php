<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => ['enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'prueba'],
            ],
        ],
//        'view' => [
//            'theme' => [
//                'basePath' => '@app/themes/azulguinda',
//                'baseUrl' => '@web/themes/azulguinda',
//                'pathMap' => [
//                    '@app/views' => '@app/themes/azulguinda',
//                ],
//            ],
//        ],
//        'assetManager' => [
//            'bundles' => [
//                'yii\bootstrap\BootstrapAsset' => [
//                    'css' => [],
//                ],
//            ],
//        ],
    ],
    'params' => $params,
];
