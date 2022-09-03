<?php

namespace app\assets;

use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/sb-admin.css',
    ];
    public $js = [
        'js/scripts.js',
    ];
    public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap5\BootstrapPluginAsset',
    ];
}