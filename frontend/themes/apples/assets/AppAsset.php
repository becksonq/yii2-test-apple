<?php


namespace frontend\themes\apples\assets;


class AppAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@frontend/themes/apples/web';

    public $css = [];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}