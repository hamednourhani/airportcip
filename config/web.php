<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@mdm/admin' => 'app\vendor\mdmsoft\yii2-admin'

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'h1890ncip9124134625',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'enableAutoLogin' => true,
        ],
//        'user' => [
//            'class' => 'app\components\User',
//            'identityClass' => 'dektrium\user\models\User',
//        ],
        'authManager' => [
            'class' => 'yii\rbac\DBManager', // or use 'yii\rbac\DbManager'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */


    ],
    'modules'=>[
//        'user' => [
//            'class' => 'dektrium\user\Module',
//            'admins' => ['hamed']
//        ],

         'admin' => [
             'class' => 'mdm\admin\Module',
             'layout' => 'right-menu', // it can be '@path/to/your/layout'.
             'controllerMap' => [
                 'assignment' => [
                     'class' => 'mdm\admin\controllers\AssignmentController',
                     'userClassName' => 'mdm\admin\models\User',
                     'idField' => 'user_id'
                 ],
                 'other' => [
                     'class' => 'path\to\OtherController', // add another controller
                 ],
             ],
             'menus' => [
                 'assignment' => [
                     'label' => 'Grand Access' // change label
                 ],
                 'route' => null, // disable menu route
             ]
         ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/error',
            'site/*',
            'admin/*',
            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],

    'params' => $params,

    /*
       catchAll,
       controllerMap,
       language,
       modules,
       name,
       sourceLanguage,
       timeZone,
       version,
       charset,
       defaultRoute,
       extensions,
       layout,
       layoutPath,
        runtimePath,
        viewPath,
        vendorPath,

       */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
