<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '资讯编辑';

?>

<?=Html::jsFile('@web/css/lib/jquery/1.9.1/jquery.min.js')?>

<article class="page-container">
    <form class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $article[0]['title'];?>" placeholder="" id="articletitle" name="articletitle">
            </div>
            <input type="hidden" value="<?php echo $article[0]['id'];?>" id="article_id" name="article_id" >
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="articlecategory" name="articlecategory" class="select">

                    <option value="1" <?php if($article[0]['classifyid']==1){ echo 'selected = "selected"';};
?>>综合资讯</option>
                    <option value="2" <?php if($article[0]['classifyid']==2){ echo 'selected = "selected"';};
?>>软件资讯</option>
                    <option value="3" <?php if($article[0]['classifyid']==3){ echo 'selected = "selected"';};
?>>编程语言</option>
                    <option value="4" <?php if($article[0]['classifyid']==4){ echo 'selected = "selected"';}; ?>>技术前沿</option>
                    <option value="5" <?php if($article[0]['classifyid']==5){ echo 'selected = "selected"';}; ?>>个人资料</option>
                </select>
				</span> </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>seo关键字：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $article[0]['seo_keywords'];?>" placeholder="" id="seo_keywords" name="seo_keywords">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <script id="editor" type="text/plain" style="width:100%;height:400px;"></script>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>保存修改</button>
                <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</article>


<script type="text/javascript">


    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        var a_content='<?php echo $article[0]['article_content'];?>';
        var ue = UE.getEditor('editor');
        //判断ueditor 编辑器是否创建成功
        ue.addListener("ready", function () {
            // editor准备好之后才可以使用
            ue.setContent(a_content);
        });

    });


    function article_save_submit()
    {

        $("#form-article-add").validate({
            rules:{
                articletitle:{
                    required:true,
                },
                seo_keywords:{
                    required:true,
                },
            },
            success:"valid",
            submitHandler:function(form){

                var article_id=$("#article_id").val();
                var articletype=0;
                if(article_id==''){
                    articletype='0';  //新增
                }else{
                    articletype='1';  //修改
                }
                var articletitle=$("#articletitle").val();
                var articlecategory=$("#articlecategory").val();
                var seo_keywords=$("#seo_keywords").val();
                var article_content=UE.getEditor('editor').getContent();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo Url::toRoute("site/savearticle");?>',
                    dataType: "text",
                    data:{"article_id":article_id,"articletitle":articletitle,"articlecategory":articlecategory,"seo_keywords":seo_keywords,"editorValue":article_content,"articletype":articletype},
                    success: function(data){
                        if(data){
                            layer.msg('修改成功!',{icon: 6,time:1000});
                        }else{
                            layer.msg('修改失败，请重试!',{icon: 5,time:1000});
                        }

                    }
                });

            }

        });

    }




</script>