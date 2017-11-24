<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'layui/css/layui.css',
        'css/style.css',
    ];
    public $js = [
        'js/picshow.js',
        'js/marquee.js',
        'js/picshowset.js',
        'js/jquery.v1.7.2.js',
        'layui/layui.js',
        'layer/layer.js',
        'js/time.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
