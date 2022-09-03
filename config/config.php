<?php
use kartik\mpdf\Pdf;
return [
    'id' => 'micro-app',
    // the basePath of the application will be the `micro-app` directory
    'basePath' => dirname(__DIR__),
    'language' => 'es',
    'name'=>'RutasMayas',
    // this is where the application will find all controllers
    'controllerNamespace' => 'app\controllers',
    // set an alias to enable autoloading of classes from the 'app' namespace
    'aliases' => [
        '@app' => dirname(__DIR__),
        '@bower' => '@app/vendor/bower-asset',
        '@npm' => '@app/vendor/npm-asset',
        '@upload'=>'@app/web/upload',
        '@images'=>'@app/web/images',
    ],
    'timeZone' => 'America/Mexico_City',
    
    'components' => [
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
        'request' => [
            'csrfParam' => '_csrf-microframeworkFW',
            'cookieValidationKey' => '20ce1744d439dca2ad11e87e393c7857',
        ],
        'db' => [
            'class' => '\yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=rutasmayas',
            'username' => 'root',
            'password' => 'developer',
            'charset' => 'utf8',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            /* 'loginUrl' => ['backend'], */
        ],        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '',
                'username' => '',
                'password' => '',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

    ],
    'modules' => [
        'pdfjs' => [
            'class' => '\yii2assets\pdfjs\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
    ],
    'params' => [
        'icon-framework' => \kartik\icons\Icon::FAS,  // Font Awesome Icon framework
        'bsVersion' => '5.x',
        'bsDependencyEnabled' => false,
    ]
];