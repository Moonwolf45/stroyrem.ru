<?php

namespace app\assets;


use yii\web\AssetBundle;

class FontsAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Open+Sans:400,700',
    ];

    public $cssOptions = [
        'type' => 'text/css',
    ];
}