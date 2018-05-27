<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use news\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => 'ITNEWS',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '注册', 'url' => ['site/login']];
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '退出登录 (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container" style="padding-top:10px;">
        <div class="row">

            <?= $content ?>


            <?php

                $action_id=Yii::$app->controller->action->id;
                //echo $action_id;
                if($action_id=='index' || $action_id=='article'){

            ?>

            <!--右边-->
            <div class="row col-md-4">
                <div class="side-bar p0">

                    <div class="">

                        <div class="panel panel-default corner-radius">

                            <form id="front_search_form" method="post" action="/zms/news/web/index.php?r=site/index">
                                <div class="panel-body text-center">                         
                                    <div class="input-group">
                                        <input name="_csrf-frontend" id="_csrf-frontend" type="hidden">
                                        <input name="search_text" type="text" class="form-control" placeholder="" aria-describedby="basic-addon2">
                                        <span onclick="search();" class="input-group-addon" id="basic-addon2">搜 索</span>
                                    </div>
                                </div>
                            </form>
                            
                        </div>

                        <div class="panel panel-default corner-radius">
                            <div class="panel-heading text-center">
                                <h3 class="panel-title">网站公告</h3>
                            </div>
                            <div class="panel-body">
                                <p>本站分享IT科技新闻和技术类资讯给各位</p>
                            </div>
                        </div>

                        <div class="panel panel-default corner-radius">
                            <div class="panel-heading text-center">
                                <h3 class="panel-title">推荐资源</h3>
                            </div>
                            <div class="panel-body side-bar">
                                <ul class="list">
                                    <li><a href="https://www.zhihu.com/question/35658235?sort=created">Yii在国内网站开发的地位</a></li><li><a href="http://www.phpcomposer.com/">Composer 中文文档</a>
                                    </li>
                                    <li><a href="https://github.com/PizzaLiu/PHP-FIG">PHP-FIG 编程规范中文</a></li><li><a href="http://laravel-china.github.io/php-the-right-way/">PHP The Right Way 中文版</a></li>
                                    <li><a href="http://phptrends.com/">上升最快的 PHP 类库</a></li>
                                    <li><a href="https://www.yiiframework.com">Yii框架官方网站</a></li>
                                    <li><a href="http://pkg.phpcomposer.com/">Packagist / Composer 中国全量镜像</a></li><li><a href="http://cookbook.getyii.com/"> Yii 2.0 Cookbook 中国翻译版</a></li>
                                    <li><a href="http://www.oschina.net/question/tag/yii">开源中国Yii问答</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="panel panel-default corner-radius">
                            <div class="panel-heading text-center">
                                <h3 class="panel-title">友情链接</h3>
                            </div>
                            <div class="panel-body text-center" style="padding-top: 5px;">
                                <a class="list-group-item" href="http://www.yiichina.com/" title="yiichina" target="_blank"><img src="http://www.yiichina.com/images/logo.png" alt=""></a>
                                <a class="list-group-item" href="https://www.my-yii.com/" title="My Yii" target="_blank"><img src="http://ww1.sinaimg.cn/large/4cc5f9b3jw1f26l8exdecj206x028mx4.jpg" alt=""></a>
                                <a class="list-group-item" href="https://yiigist.com/" title="yiigist" target="_blank"><img src="http://ww3.sinaimg.cn/large/4cc5f9b3jw1f26l9998toj206001vmx3.jpg" alt=""></a>                </div>
                        </div>

                    </div>
                </div>

            </div>  <!--右边end-->

            <?php  } ?>


        </div><!--row end-->
    </div>

</div>


<script type="application/javascript">

    function search(){
        //var search_text=$("#search_text").val();
        $("#front_search_form").submit();

    }
</script>


<footer class="footer">
    <div class="container">
        <p class="text-center">&copy; 2015-<?= date('Y') ?> zhangyiren 保留所有版权</p>
    </div>
</footer>

<div class="btn-group-vertical" id="floatButton">
    <button type="button" class="btn btn-default" onclick="$('body').animate( {scrollTop: 0}, 500);" title="去顶部"><span class="glyphicon glyphicon-arrow-up"></span></button>
    <button type="button" class="btn btn-default" id="refresh" onclick="location.href=location.href;" title="刷新"><span class="glyphicon glyphicon-repeat"></span></button>
    <button type="button" class="btn btn-default" onclick="$('body').animate({scrollTop:$('#bottom').offset().top},500
);" title="去底部"><span class="glyphicon glyphicon-arrow-down"></span></button>
</div>

<span id="bottom"></span>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
