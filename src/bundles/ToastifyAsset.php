<?php

namespace portalium\theme\bundles;

use yii\web\AssetBundle;

class ToastifyAsset extends AssetBundle
{
    public $sourcePath = '@vendor/portalium/yii2-theme/src/assets/';

    public $css = [
        'plugins/toastify/css/toastify.css',
    ];

    public $js = [
        'plugins/toastify/js/toastify.js',
    ];

    public $depends = [
        'portalium\theme\bundles\AppAsset',
    ];
}