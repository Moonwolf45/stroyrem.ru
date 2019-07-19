<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/slick.css',
        'css/slick-theme.css',
        'css/main.css',
    ];

    public $js = [
        'js/slick.min.js',
        'js/jquery.dropotron.min.js',
        'js/jquery.scrolly.min.js',
        'js/jquery.scrollex.min.js',
        'js/browser.min.js',
        'js/breakpoints.min.js',
        'js/util.js',
        'js/main.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
