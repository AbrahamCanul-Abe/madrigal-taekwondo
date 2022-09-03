<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/sb-admin.css',
        'css/accessibility.css',
        #'leaflet/leaflet.css',
        #'https://unpkg.com/leaflet@1.8.0/dist/leaflet.css',
        'aos/aos.css',
        'css/estilo-menu.css',
        'css/estilos_footer.css',
        'css/estilos-slide.css',
        'css/estilos_comentarios.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css',
    ];
    public $js = [
        'js/scripts.js',
        'js/accessibility.min.js',
        #'leaflet/leaflet.js',
        'aos/aos.js'
    ];
    public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap5\BootstrapPluginAsset',
    ];
}