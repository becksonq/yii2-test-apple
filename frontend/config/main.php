<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => Yii::t('app', 'Yii2-test-apple'),
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
            // Перебор кэша для обновления ассетов (для разработки)
            'appendTimestamp' => true,
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'site/index' => 'site/index',
                '<controller>/<action>/<id:\d+>' => 'apples/<controller>/<action>',
                '<controller>/<action>' => 'apples/<controller>/<action>',
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@frontend/themes/apples',
                'baseUrl'  => '@web/themes/apples',
                'pathMap'  => [
                    '@frontend/views' => '@frontend/themes/apples/views',
                    '@dektrium/user/views' => '@frontend/themes/apples/views/user',
//                    '@dektrium/rbac/views' => '@frontend/themes/apple/views/rbac',
                ],
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
    ],
    'params' => $params,
];
