<?php
$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules'    => [
        'user' => [
            'class'               => 'dektrium\user\Module',
            'enableFlashMessages' => false,
            'admins'              => ['admin'],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ]
];
