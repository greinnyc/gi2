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
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'admin-lte/dist/css/adminlte.min.css',
        'admin-lte/plugins/fontawesome-free/css/all.min.css',
        'css/bootstrap.min.css',
        'css/bootstrap-glyphicons.css',
        'css/jquery.dataTables.min.css',
        'css/dataTables.bootstrap.min.css'
        //'admin-lte/dist/css/google.css',
        //'admin-lte/dist/css/ionicons.min.css',
     
    ];
    public $js = [

        'js/bootstrap.min.js',
        'admin-lte/dist/js/adminlte.min.js',
        //'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'js/jquery.dataTables.min.js',
        //'js/dataTables.bootstrap.min.js',
        //'js/jquery.min.js',
        'js/scripts.js',
        'js/programacionScript.js',


        //'admin-lte/plugins/jquery/jquery.min.js',
        //'admin-lte//dist/js/demo.js'
      
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
