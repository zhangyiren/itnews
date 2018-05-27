<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/static/h-ui/css/H-ui.min.css',
        'css/static/h-ui.admin/css/H-ui.admin.css',
        'css/static/h-ui.admin/skin/default/skin.css',
        'css/static/h-ui.admin/css/style.css',
        'css/lib/Hui-iconfont/1.0.8/iconfont.css',
    ];
    public $js = [
        'css/lib/jquery/1.9.1/jquery.min.js',
        'css/lib/layer/2.4/layer.js',
        'css/static/h-ui/js/H-ui.min.js',
        'css/static/h-ui.admin/js/H-ui.admin.js',
        'css/lib/jquery.contextmenu/jquery.contextmenu.r2.js',

        'css/lib/My97DatePicker/4.8/WdatePicker.js',
        'css/lib/datatables/1.10.0/jquery.dataTables.min.js',
        'css/lib/laypage/1.2/laypage.js',

        'css/lib/jquery.validation/1.14.0/jquery.validate.js',
        'css/lib/jquery.validation/1.14.0/validate-methods.js',
        'css/lib/jquery.validation/1.14.0/messages_zh.js',
        'css/lib/webuploader/0.1.5/webuploader.min.js',
        'css/lib/ueditor/1.4.3/ueditor.config.js',
        'css/lib/ueditor/1.4.3/ueditor.all.min.js',
        'css/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js',

    ];
    public $depends = [
    ];
}
