<?php

namespace schmunk42\templay\assets;

use yii\web\AssetBundle;

/**
 * @author Tobias Munk <schmunk@usrbin.de>
 */
class TemplayAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    #public $basePath = '@webroot';
    #public $baseUrl = '@web';
    public $css = [
        'templay.css',
    ];
    public $js = [
        "templay.js",
    ];
    public $jsOptions = [
        "position" => \yii\web\View::POS_END,
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
