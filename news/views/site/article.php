<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '资讯';

$article=$article_content;

?>


<div class="col-md-8">

    <?php

    $k=rand(0,32);
    $avatar=$avatar_img[$k];
    $view_times=rand(0,2000);
    //print_r($article);
    $article_body=<<<EOF
    <div class="panel panel-default">
        <div class="panel-heading media clearfix">
            <div class="media-body">
                <h1 class="media-heading heading-font">{$article[0]['title']}</h1>
                <div class="info">
                    <span style="padding-left:3px;">{$view_times}</span>次阅读<span style="margin-left:20px;">{$article[0]['update_time']}</span>
                </div>
            </div>
            <div class="avatar media-right">
                <a href="#"><img class="media-object avatar-48 img-circle" src="/zms/news/web/css/images/{$avatar}" alt=""></a>                </div>
        </div>

        <div style="padding:10px;">
        {$article[0]['article_content']}
        </div>
EOF;

    echo $article_body;

?>

        <div class="panel-footer clearfix opts">
            <a class="" href="#" data-do="like" data-id="845" data-type="topic"><i class="fa fa-thumbs-o-up"></i> <span><?php echo rand(0,1000);?></span> 个赞</a><a class="" href="#" data-do="hate" data-id="845" data-type="topic"><i class="fa fa-thumbs-o-down"></i> 踩</a><a class="" href="#" data-do="thanks" data-id="845" data-type="topic"><i class="fa fa-heart-o"></i> 感谢</a><a class="" href="#" data-do="follow" data-id="845" data-type="topic"><i class="fa fa-eye"></i> 关注</a><a class="" href="#" data-do="favorite" data-id="845" data-type="topic"><i class="fa fa-bookmark"></i> 收藏</a>
        </div>

    </div>

</div>