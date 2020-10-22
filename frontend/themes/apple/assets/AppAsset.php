<?php


namespace frontend\themes\apple\assets;


class AppAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@frontend/themes/apple/web';

    public $css = [];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}