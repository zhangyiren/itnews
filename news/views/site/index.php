<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '首页';

$article_data=$article_data_cts;

?>

<!--<div class="row">-->

    <!--左边-->
    <div class="col-md-8">

        <div class="list-group">
            <a href="#" class="list-group-item disabled">
                最新资讯
            </a>


    <?php

        foreach($article_data as $item) {
            $i=rand(0,38);
            $avatar=$avatar_img[$i];
            $icon=$comment_icon[$i];
            $article_url="/zms/news/web/site/article/{$item['id']}";
            $thumb_up=rand(0,500);
            $read_hts=$thumb_up+126;
            $reply_times=rand(0,20);
    ?>

            <div class="list-group-item" data-key="261">
                <div class="media">
                    <a class="pull-right" href="#">
                        <span class="badge badge-reply-count"><?php echo $reply_times; ?></span>
                    </a>

                    <div class="media-left">
                        <a href="#"><img class="media-object img-circle" src="/zms/news/web/css/images/<?php echo $avatar;?>" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-heading title">
                            <a href="<?php echo $article_url;?>"><?php echo $item['title'];?></a>
                            <i class="fa <?php echo $icon;?> excellent"></i>
                        </div>

                        <div class="title-info">
                            <a class="remove-padding-left" href="#">
                                <span class="fa fa-thumbs-o-up"><?php echo $thumb_up;?></span>
                            </a> •
                            <a class="node" href="#"><?php echo $item['classify'];?></a> •
                            <span>keywords:
                                        <a href="#"><strong> <?php echo $item['seo_keywords'];?> </strong></a>
                                    </span> • <?php echo $read_hts;?> 次阅读 <span><?php echo $item['update_time'];?></span>
                        </div>
                    </div>

                </div>
            </div>


    <?php } ?>



            <!--分页-->
            <div class="panel-footer">
                <ul class="pagination">

                    <?php
                        $prev_page=$current_page-1;
                        if($prev_page<=0){$prev_page=0;}
                        echo "<li class='prev'><span><a href='$prev_page'>«</a></span></li>"
                    ?>

                    <?php
                        for($i=0;$i<$total_page;$i++){
                            if($i==$current_page){
                                $active='class="active"';
                            }else{
                                $active='';
                            }
                            $j=$i+1;
                            echo "<li $active><a href='$i' data-page='$i'>$j</a></li>";
                        };

                    ?>

                    <?php
                        $next_page=$current_page+1;
                        if($next_page>=$total_page){$next_page=$total_page-1;}
                        echo "<li class='next'><a href='$next_page' data-page='$next_page'>»</a></li>"
                    ?>

                </ul> <!--分页end -->
            </div>


        </div>  <!-- list-group end -->

    </div> <!--左边end-->



<!--</div>-->

