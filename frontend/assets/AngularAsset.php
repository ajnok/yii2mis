<?php
/**
 * Created by PhpStorm.
 * User: ajnok
 * Date: 11/10/2015 AD
 * Time: 22:20
 */
namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AngularAsset extends AssetBundle
{
    public $sourcePath = '@bower';

    public $js = [
        'angular/angular.js',
        'angular-route/angular-route.js',
        'angular-strap/dist/angular-strap.js',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

}