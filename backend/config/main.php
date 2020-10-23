<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],
    'components'          => [
        'assetManager' => [
            'linkAssets'      => true,
            // Перебор кэша для обновления ассетов (для разработки)
            'appendTimestamp' => true,
        ],
        'request'      => [
            'csrfParam' => '_csrf-backend',
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
            ],
        ],
        'view'         => [
            'theme' => [
                'basePath' => '@backend/themes/apples',
                'baseUrl'  => '@web/themes/apples',
                'pathMap'  => [
                    '@backend/views' => '@backend/themes/apples/views',

                    '@dektrium/user/views' => '@app/themes/apples/views/user',
                    '@dektrium/rbac/views' => '@app/themes/apples/views/rbac',
                ],
            ],
        ],
    ],
    'modules'             => [
        'user' => [
            'controllerMap' => [
                'security' => 'backend\controllers\user\SecurityController'
            ],
            'as backend'    => 'dektrium\user\filters\BackendFilter',
        ],
    ],
    'params'              => $params,
];
