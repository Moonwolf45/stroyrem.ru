<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'PRT',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main_admin',
            'defaultRoute' => 'category/index',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            'imagesStorePath' => 'images/original',
            'imagesCachePath' => 'images/cache',
            'graphicsLibrary' => 'GD',
            'placeHolderPath' => '@webroot/images/placeHolder.png'
        ],
    ],
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'ru_RU',
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUB',
        ],
        'request' => [
            'cookieValidationKey' => '0BGsg5xHONRFDYbNRFk4IVAr-ZTwOJuC',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'viewPath' => '@app/mail',
            'htmlLayout' => 'layouts/main-html',
            'textLayout' => 'layouts/main-text',
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['info@prret.ru' => 'PRT'],
            ],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                /* Sitemap */
                ['pattern' => 'sitemap', 'route' => 'sitemap/index', 'suffix' => '.xml'],

                /* Работы */
                'works/<category_translit:\w+>/works_name_<works_translit:\w+>' => 'works/view',
                'all-works' => 'pages/our-works',

                /* Категории */
                'works/category/<translit:\w+>' => 'category/view',

                /* Отзывы */
                'reviews/create_review' => 'reviews/create-review',
                'reviews/allReviews/page/<page:\d+>' => 'reviews/all-reviews',
                'reviews/allReviews' => 'reviews/all-reviews',

                /* Страницы */
                'page/feedback' => 'pages/contact',
                'page/<translit:\w+>' => 'pages/view',

                /* Новости */
                'news/archive/page/<page:\d+>' => 'news/all-news',
                'news/archive' => 'news/all-news',
                'news/<translit:\w+>' => 'news/view',

                /* Акции */
                'share/archive/page/<page:\d+>' => 'shares/all-shares',
                'share/archive' => 'shares/all-shares',
                'share/<translit:\w+>' => 'shares/view',
            ],
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LfRS28UAAAAAKt26QdCSBpcVwPwEh3cwjxAZYBv',
            'secret' => '6LfRS28UAAAAAEeUwpfk5z9QdE_hed9_yVendOM8',
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'path' => 'uploads',
                'name' => 'Files'
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['5.164.44.25', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['5.164.44.25', '::1'],
    ];
}

return $config;
