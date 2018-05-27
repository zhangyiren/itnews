<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Article;
use common\models\Articlecontent;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public $enableCsrfValidation = false;
    public $layout='main';
    public $article_object=null;


    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config = []);
        $this->article_object=new Article();

    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','welcome','articlelist','articledit','release','delete','batchremove','savearticle','search','soon'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    //by me
                    [
                        'actions' => ['login','captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            // by me
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout='main';
        return $this->render('index');
    }


    /**
     * Displays welcome page
     * @return string
     */
    public function actionWelcome()
    {
        return $this->render('welcome');
    }


    /**
     * 资讯管理
     * @return string
     */
    public function actionArticlelist()
    {
        $article_data=$this->article_object->getlist();
        $total_num=count($article_data);
        $data=array('data_content'=>$article_data,'total_num'=>$total_num);
        return $this->render('articlelist',$data);
    }


    /**
     * 搜索资讯
     *
     */
    public function actionSearch()
    {

        $request = Yii::$app->request;
        $logmin = $request->post('logmin');
        $logmax = $request->post('logmax');
        $search_info = $request->post('search_info');
        $article_data=$this->article_object->search(strtotime($logmin),strtotime($logmax),$search_info);
        $total_num=count($article_data);
        $data=array('data_content'=>$article_data,'total_num'=>$total_num);
        return $this->render('articlelist',$data);

    }


    /**
     * 上下架
     * @return string
     */
    public function actionRelease()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');
        echo $update_status=$this->article_object->changestatus($id);

    }


    /**
     * 删除文章
     * @return string
     */
    public function actionDelete()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');
        echo $this->article_object->deletearticle($id);

    }

    /**
     * 编辑资讯
     * @return string
     */
    public function actionArticledit()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');
        if(!isset($id)){
            $article_detail=array(
                '0'=>array(
                    'id'=>'',
                    'title'=>'',
                    'classifyid'=>'',
                    'classifyid'=>'',
                    'seo_keywords'=>'',
                    'article_content'=>''
                )
            );
        }else{
            $article_detail=$this->article_object->getarticle($id);
        }
        $data=array('article'=>$article_detail);
        return $this->render('articledit',$data);
    }


    /**
     * 批量删除
     *
     */
    public function actionBatchremove(){

        $request = Yii::$app->request;
        $ids = $request->get('ids');
        echo $this->article_object->deleteallarticle($ids);
    }


    /**
     * 修改保存文章
     *
     */
    public function actionSavearticle()
    {

        $request=Yii::$app->request;
        $articletitle=$request->post('articletitle');
        $id=$request->post('article_id');
        $seo_keywords=$request->post('seo_keywords');
        $article_content=$request->post('editorValue');
        $categoryid=$request->post('articlecategory');
        $articletype=$request->post('articletype');


        //修改
        if($articletype){
            $article = Article::findOne($id);

            //article表
            $article->title=$articletitle;
            $article->created_at=time();
            $article->updated_at=time();
            $article->cid=$categoryid;
            $article->seo_keywords=$seo_keywords;
            $res1=$article->save();

            //content表
            $arct=Articlecontent::find()->where(['aid' => $id])->one();
            $arct->content=$article_content;
            $res2=$arct->save();


        }else{  //新增

            //article表
            $article=new Article();
            $article->title=$articletitle;
            $article->created_at=time();
            $article->updated_at=time();
            $article->cid=$categoryid;
            $article->seo_keywords=$seo_keywords;
            $res1=$article->save();
            $lastdata=$article->getlastid();
            $aid=$lastdata[0]['lastid'];

            //content表
            $arct=new Articlecontent();
            $arct->aid=$aid;
            $arct->content=$article_content;
            $res2=$arct->save();

        }

        return $res1 && $res2==true?true:false;

    }



    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $this->layout='login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        //unset(Yii::$app->session['login_user_name']);
        //Yii::$app->session->clear();
        Yii::$app->session['login_user_name']='';
        //Yii::$app->session->destroy();
        return $this->goHome();
    }


    /**
     * 建设中
     *
     */
    public function actionSoon()
    {
        return $this->render('soon');
    }


}
