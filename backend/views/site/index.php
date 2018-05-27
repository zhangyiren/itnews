<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '后台管理';

?>

<!--[if lt IE 9]>
<?=Html::jsFile('@web/css/lib/html5shiv.js')?>
<?=Html::jsFile('@web/css/lib/respond.min.js')?>
<![endif]-->

<!--[if IE 6]>
<?=Html::jsFile('@web/css/lib/DD_belatedPNG_0.0.8a-min.js')?>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->


<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="#">管理员后台</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="#"></a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs"></span>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
            </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>超级管理员</li>
                    <li class="dropDown dropDown_hover">
                        <a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                            <li><a href="#">切换账户</a></li>
                            <!--<li><a href="#">退出</a></li>-->
                            <?php
                                $menuItems = '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                    '退出 (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>';

                            echo $menuItems;
                            ?>
                        </ul>
                    </li>

                   <li id="Hui-msg"> <a href="#" title="消息"></a> </li>

                </ul>
            </nav>
        </div>
    </div>
</header>
<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">
        <dl id="menu-article">
            <dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/articlelist');?>" data-title="资讯管理" href="javascript:void(0)">资讯管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="图片管理" href="javascript:void(0)">图片管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-product">
            <dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-comments">
            <dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="评论列表" href="javascript:;">评论列表</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="意见反馈" href="javascript:void(0)">意见反馈</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="会员列表" href="javascript:;">会员列表</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="等级管理" href="javascript:;">等级管理</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="积分管理" href="javascript:;">积分管理</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-tongji">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="折线图" href="javascript:void(0)">折线图</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="时间轴折线图" href="javascript:void(0)">时间轴折线图</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="区域图" href="javascript:void(0)">区域图</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-system">
            <dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="数据字典" href="javascript:void(0)">数据字典</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="屏蔽词" href="javascript:void(0)">屏蔽词</a></li>
                    <li><a data-href="<?php echo Url::toRoute('site/soon');?>" data-title="系统日志" href="javascript:void(0)">系统日志</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active">
                    <span title="我的桌面" data-href="<?php echo Url::toRoute('site/welcome');?>">我的桌面</span>
                    <em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="<?php echo Url::toRoute('site/welcome');?>"></iframe>
        </div>
    </div>
</section>

<div class="contextMenu" id="Huiadminmenu">
    <ul>
        <li id="closethis">关闭当前 </li>
        <li id="closeall">关闭全部 </li>
    </ul>
</div>

<script type="text/javascript">
    /*个人信息*/
    function myselfinfo(){
        layer.open({
            type: 1,
            area: ['300px','200px'],
            fix: false, //不固定
            maxmin: true,
            shade:0.4,
            title: '查看信息',
            content: '<div>管理员信息</div>'
        });
    }

    /*资讯-添加*/
    function article_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*图片-添加*/
    function picture_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*产品-添加*/
    function product_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*用户-添加*/
    function member_add(title,url,w,h){
        layer_show(title,url,w,h);
    }


</script>
