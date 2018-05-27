<?php


namespace common\models;

use Yii;
use yii\helpers\HtmlPurifier;

class Article extends \yii\db\ActiveRecord
{


    public $update_time;
    public $classify;
    public $total_num;
    public $article_content;
    public $classifyid;
    public $lastid;


    public static function tableName()
    {
        return '{{%zms_article}}';
    }


    public function get_where_condition($need_where='where',$need_and=''){

        $user_name=Yii::$app->session['login_user_name'];
        if($user_name=='abcd'){
            $where="$need_where a.cid in(5) $need_and";
        }elseif($user_name=='admin'){
            $where='';
        }else{
            $where="$need_where a.cid not in (5) $need_and";
        }
        return $where;
    }


    public function getlist($limit='',$where='')
    {
        $where=$this->get_where_condition();
        $article_data = Article::findBySql("SELECT a.id,a.title,FROM_UNIXTIME(a.updated_at,'%Y-%m-%d %H:%i:%s') as update_time,a.seo_keywords,a.view_count,a.status,b.name as classify FROM zms_article a left join zms_category b on a.cid=b.id $where order by update_time desc $limit")->all();
        return $article_data;
    }


    public function getarticle($id)
    {
        $article_data = Article::findBySql("SELECT a.id,a.title,FROM_UNIXTIME(a.updated_at,'%Y-%m-%d %H:%i:%s') as update_time,a.seo_keywords,a.view_count,a.status,a.summary,b.name as classify,b.id as classifyid,c.content as article_content FROM zms_article a left join zms_category b on a.cid=b.id left join zms_article_content c on a.id=c.aid where a.id=$id")->all();
        return $article_data;
    }


    public function gettotal()
    {
        $where=$this->get_where_condition();
        return Article::findBySql("select count(*) as total_num from zms_article a $where")->all();
    }


    public function changestatus($id)
    {

        $customer = Article::findOne($id);
        $status=$customer->status;
        $customer->status=$status==1?0:1;
        if ($customer->update() !== false) {
            // update successful
            return 1;
        } else {
            // update failed
            return 0;
        }

    }


    public function deletearticle($id)
    {

        return Article::findOne($id)->delete();

    }


    public function deleteallarticle($article_id)
    {

        $ids=rtrim($article_id, ",");
        $models = Article::find()->where("id in ($ids)")->all();
        foreach($models as $model) {
            $model->delete();
        }

    }



    public function getlastid()
    {
        return Article::findBySql("select last_insert_id() as lastid")->all();
    }



    public function search($date_begin,$date_end,$search_info)
    {

        //过滤、防注入
        $search_info=HtmlPurifier::process($search_info);
        /*
        $user_name=Yii::$app->session['login_user_name'];
        if($user_name=='abcd'){
            $before_part_after='a.cid in(5) and';
        }elseif($user_name=='admin'){
            $before_part_after='';
        }else{
            $before_part_after='a.cid not in(5) and';
        }
        */
        $before_part_after=$this->get_where_condition($need_where='',$need_and='and');

        if($search_info!=''){
            $part_like="(a.title like '%$search_info%' or c.content like '%$search_info%')";
            $and='and';
        }else{
            $part_like='';
            $and='';
        }

        if($date_begin!='' && $date_end!=''){
            $part_where="a.updated_at>='$date_begin' and a.updated_at<='$date_end' $and";
        }else{
            $part_where='';
        }

        $sql="SELECT a.id,a.title,a.cid,FROM_UNIXTIME(a.updated_at,'%Y-%m-%d %H:%i:%s') as update_time,a.seo_keywords,a.view_count,a.status,b.name as classify FROM zms_article a left join zms_category b on a.cid=b.id left join zms_article_content c on a.id=c.aid where $before_part_after $part_where $part_like";
        return Article::findBySql($sql)->all();

    }


}