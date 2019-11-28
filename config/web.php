<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db_zeus = require __DIR__ . '/db_zeus.php';
$db_argus = require __DIR__ . '/db_argus.php';
$db_invitado = require __DIR__ . '/db_invitado.php';


$config = [
    'id' => 'gestion_invitados',
    'basePath' => dirname(__DIR__),
    'basePath' => dirname(__DIR__),
    'timeZone' => 'America/Lima',
    'language'=>'es',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',    
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
            'linkAssets' => false,

        ], 
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CsbcLgDJ8lcIC57q4No8IlrAIPvCtpSV',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Empleados',
            //'enableAutoLogin' => true,
            'loginUrl' => ['main/login'],            
            //'authTimeout' => 60*20
        ],
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'db_zeus' => $db_zeus,
        'db_argus' => $db_argus,
        'db_invitado' => $db_invitado,

        'formatter' => [                           
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => "php:d/m/Y",
            'nullDisplay' => '',
            'thousandSeparator' => '',
            'decimalSeparator' => '.',
             //'datetimeFormat' => 'php:d-M-Y H:i:s',
            'timeFormat' => 'php:H:i',
        ], 
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
