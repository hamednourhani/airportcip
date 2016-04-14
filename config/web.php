<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'import'=>[
        'app\modules\rights.*',
        'app\modules\rights\components.*',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'h1890ncip9124134625',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'user' => [
//            'identityClass' => 'app\models\User',
//            'enableAutoLogin' => true,
//        ],
        'user'=>[
            'class'=>'RWebUser',   // Allows super users access implicitly.
        ],
        'authManager'=>[
            'class'=>'RDbAuthManager',   // Provides support authorization item sorting.
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
        'rights'=>[
            'install'=>true,   // Enables the installer.
            'superuserName'=>'Admin',   // Name of the role with super user privileges.
            //'authenticatedName'=>'Authenticated',  // Name of the authenticated user role.
            //'userIdColumn'=>'id',    // Name of the user id column in the database.
            //'userNameColumn'=>'username',   // Name of the user name column in the database.
            //'enableBizRule'=>true,    // Whether to enable authorization item business rules.
            //'enableBizRuleData'=>false,    // Whether to enable data for business rules.
            // 'displayDescription'=>true,   // Whether to use item description instead of name.
            //'flashSuccessKey'=>'RightsSuccess',  // Key to use for setting success flash messages.
            // 'flashErrorKey'=>'RightsError',  // Key to use for setting error flash messages.
            // 'install'=>true,    // Whether to install rights.
            //'baseUrl'=>'/rights',   // Base URL for Rights. Change if module is nested.
            //'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights.
            //'appLayout'=>'application.views.layouts.main', // Application layout.
            // 'cssFile'=>'rights.css',   // Style sheet file to use for Rights.
            // 'install'=>false,    // Whether to enable installer.
            //'debug'=>false,
        ],
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
