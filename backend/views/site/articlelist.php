<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '资讯列表';
$data=$data_content;

?>


<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="<?php echo Url::toRoute("site/articlelist");?>" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c">
        <form id="search_form" method="post" action="<?php echo Url::toRoute("site/search");?>" onsubmit="return search_information();">
            日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" name="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" name="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="search_info" id="search_info" placeholder=" 资讯名称" style="width:250px" class="input-text">
            <button onClick="submit_search_form();" name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
        </form>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" data-title="添加资讯" href="<?php echo Url::toRoute("site/articledit");?>"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a></span> <span class="r">共有数据：<strong><?php echo $total_num;?></strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="80">ID</th>
                <th>标题</th>
                <th width="80">分类</th>
                <th width="80">seo关键字</th>
                <th width="150">更新时间</th>
                <th width="75">浏览次数</th>
                <th width="60">发布状态</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>


<?php

function get_tr_content($item)
{

    $editor_url="index.php?r=site/articledit&id={$item['id']}";

    $article_status=$item['status']==1?'<span class="label label-success radius">已发布</span>':'<span class="label label-defaunt radius">已下架</span>';

    $article_fun=$item['status']==1?'article_stop':'article_start';

    $article_fun_title=$item['status']==1?'下架':'发布';

    $icon=$item['status']==1?'&#xe6de;':'&#xe603;';

    $article_url="/zms/news/web/site/article/{$item['id']}";

    $view_count=rand(0,1000);

    $tr_content = <<<EOF
            <tr class="text-c">
                <td><input class="mo" onclick="click_check_box(this);" type="checkbox" data="{$item['id']}"></td>
                <td>{$item['id']}</td>
                <td class="text-l"><u style="cursor:pointer" class="text-primary" title="查看"><a href="{$article_url}" target="_blank">{$item['title']}</a></u></td>
                <td>{$item['classify']}</td>
                <td>{$item['seo_keywords']}</td>
                <td>{$item['update_time']}</td>
                <td>{$view_count}</td>
                <td class="td-status">{$article_status}</td>
                <td class="f-14 td-manage"><a style="text-decoration:none" onClick="{$article_fun}(this,'{$item["id"]}')" href="javascript:;" title="{$article_fun_title}" data="{$item['id']}"><i class="Hui-iconfont">{$icon}</i></a> <a style="text-decoration:none" class="ml-5" href="{$editor_url}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="article_del(this,'{$item["id"]}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr>
EOF;

    return $tr_content;

}

    foreach($data as $item) {
        echo get_tr_content($item);
    }

?>

            </tbody>
        </table>
    </div>
</div>


<?=Html::jsFile('@web/css/lib/jquery/1.9.1/jquery.min.js')?>
<?=Html::jsFile('@web/css/lib/datatables/1.10.0/jquery.dataTables.min.js')?>



<script type="text/javascript">
    $('.table-sort').dataTable({
        "aaSorting": [[ 1, "desc" ]],//默认第几个排序
        "bStateSave": true,//状态保存
        "pading":false,
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
        ]
    });

    /*资讯-添加*/
    function article_add(title,url,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }


    function click_check_box(obj){
        if(typeof($(obj).attr("checked"))=="undefined"){
            $(obj).attr("checked","checked");
        }else{
            $(obj).removeAttr("checked");
        }
    }


    /*点击搜资讯*/
    function submit_search_form()
    {
        if(search_information()){
            document.getElementById("search_form").submit();
        }else{
            return false;
        }

    }


    /*搜索资讯*/
    function search_information(){
        var date_begin=$("#logmin").val();
        var date_end=$("#logmax").val();
        var information=$("#search_info").val();

        if((date_begin!='' && date_end!='') || information!=''){
            return true;
        }else{
            layer.msg('请选择起始日期或填写资讯',{icon: 5,time:1000});
            return false;
        }
    }

    /*资讯-批量删除*/
    function datadel(){

        //获取选中的文章id
        layer.confirm('确认要删除吗？',function(){
            var article_id="";
            $("td input:checked").each(function(index,element){
                article_id+=$(element).attr("data");
                article_id+=',';
            });

            if(article_id.length==0){
                layer.msg('请选中要删除的条目',{icon:5,time:3000});
                return false;
            }

            $.ajax({
                type: 'GET',
                url: '<?php echo Url::toRoute("site/batchremove");?>',
                dataType: "text",
                data:"ids="+article_id,
                success: function(data){
                    $("td input:checked").each(function(index,element){
                        $(element).parents("tr").remove();
                    });
                    layer.msg('已删除!',{icon:1,time:1000});
                    setTimeout("refresh();",1000);
                },
                error:function(data) {
                    console.log(data);
                },
            });

        });


    }


    function refresh()
    {
        location.href=window.location;
    }

    /*资讯-删除*/
    function article_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){

             $.ajax({
                 type: 'GET',
                 url: '<?php echo Url::toRoute("site/delete");?>',
                 dataType: "text",
                 data:"id="+id,
                 success: function(data){
                     $(obj).parents("tr").remove();
                     layer.msg('已删除!',{icon:1,time:1000});
                     setTimeout("refresh();",1000);
                 },
                 error:function(data) {
                     console.log(data.msg);
                 },
             });


        });
    }

    /*资讯-审核*/
    function article_shenhe(obj,id){
        layer.confirm('审核文章？', {
                btn: ['通过','不通过','取消'],
                shade: false,
                closeBtn: 0
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
                $(obj).remove();
                layer.msg('已发布', {icon:6,time:1000});
            },
            function(){
                $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
                $(obj).remove();
                layer.msg('未通过', {icon:5,time:1000});
            });
    }
    /*资讯-下架*/
    function article_stop(obj,id){

        var cid=$(obj).attr("data");
        var prepend_str='<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布" data='+cid+'><i class="Hui-iconfont">&#xe603;</i></a>'

        layer.confirm('确认要下架吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend(prepend_str);
            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
            $(obj).remove();
            //layer.msg('已下架!',{icon: 5,time:1000});
            article_up_down(0,cid);

        });
    }


    /*资讯上下架 ajax*/
    /* 1:上架   0:下架 */
    function article_up_down(action_id,id){
        $.ajax({
            type: 'GET',
            url: '<?php echo Url::toRoute("site/release");?>',
            dataType: "text",
            data:"id="+id,
            success: function(data){
                if(action_id==0){
                    layer.msg('已下架!',{icon: 5,time:1000});
                }else{
                    layer.msg('已发布!',{icon: 6,time:1000});
                }
            },
            error:function(data) {
                console.log(data);
            },
        });

    }

    /*资讯-发布*/
    function article_start(obj,id){
        var cid=$(obj).attr("data");
        var prepend_str='<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架" data='+cid+'><i class="Hui-iconfont">&#xe6de;</i></a>'
        layer.confirm('确认要发布吗？',function(index){
            $(obj).parents("tr").find(".td-manage").prepend(prepend_str);
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            //layer.msg('已发布!',{icon: 6,time:1000});
            article_up_down(1,cid);
        });
    }
    /*资讯-申请上线*/
    function article_shenqing(obj,id){
        $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
        $(obj).parents("tr").find(".td-manage").html("");
        layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
    }

</script>