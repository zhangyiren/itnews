<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '我的桌面';

?>


<div class="page-container">
    <p class="f-20 text-success">欢迎使用<span class="f-14"></span></p>
    <p>
        当前时间：
        <?php
            echo date('Y-m-d H:i:s',time());
        ?>
    </p>
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th colspan="7" scope="col">信息统计</th>
        </tr>
        <tr class="text-c">
            <th>统计</th>
            <th>资讯库</th>
            <th>图片库</th>
            <th>产品库</th>
            <th>用户</th>
            <th>管理员</th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-c">
            <td>总数</td>
            <td>92</td>
            <td>9</td>
            <td>0</td>
            <td>8</td>
            <td>20</td>
        </tr>
        <tr class="text-c">
            <td>今日</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="text-c">
            <td>昨日</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="text-c">
            <td>本周</td>
            <td>2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="text-c">
            <td>本月</td>
            <td>2</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        </tbody>
    </table>


    <!--
    <table class="table table-border table-bordered table-bg mt-20">
        <thead>
        <tr>
            <th colspan="2" scope="col">服务器信息</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th width="30%">服务器计算机名</th>
            <td>
                <span id="lbServerName">
                    <?php
                        //echo GetHostByName($_SERVER['SERVER_NAME']);
                    ?>
                </span>
            </td>
        </tr>
        <tr>
            <td>服务器IP地址</td>
            <td>192.168.1.1</td>
        </tr>
        <tr>
            <td>服务器域名</td>
            <td><?php //echo $_SERVER['SERVER_NAME'];?></td>
        </tr>
        <tr>
            <td>服务器端口 </td>
            <td><?php //echo $_SERVER['SERVER_PORT'];?></td>
        </tr>
        <tr>
            <td>PHP版本</td>
            <td><?php //echo PHP_VERSION;?></td>
        </tr>
        <tr>
            <td>PHP运行方式</td>
            <td><?php //echo  php_sapi_name();?></td>
        </tr>
        <tr>
            <td>本文件所在文件夹 </td>
            <td><?php //echo dirname(__FILE__);?></td>
        </tr>
        <tr>
            <td>服务器操作系统 </td>
            <td><?php //echo  php_uname();?></td>
        </tr>

        <tr>
            <td>服务器脚本超时时间 </td>
            <td><?PHP //echo get_cfg_var("max_execution_time")."秒 "; ?></td>
        </tr>

        <tr>
            <td>服务器的语言种类 </td>
            <td><?php //echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></td>
        </tr>
        <tr>
            <td>服务器当前时间 </td>
            <td><?php
                    //date_default_timezone_set('prc');
                    //echo date('Y-m-d H:i:s',time());
                ?>
            </td>
        </tr>

        <tr>
            <td>服务器上次启动到现在已运行 </td>
            <td>
                <?php
                    //$arRuntime =explode(",", exec('uptime'));
                    //echo $arRuntime[0];
                ?>
            </td>
        </tr>

        <tr>
            <td>内存使用情况 </td>
            <td>
                <?php
                //function memory_usage() {
                    //$memory  = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';
                    //return $memory;
                //}
                //echo memory_usage();
                ?>
            </td>
        </tr>
        <tr>
            <td>当前进程用户名 </td>
            <td><?php //echo Get_Current_User();?></td>
        </tr>
        </tbody>
    </table>
    -->


</div>
<footer class="footer mt-20">
    <div class="container">
        <p>© Powered by zhangyiren 2017</p>
    </div>
</footer>
