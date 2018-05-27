<?php
namespace news\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use news\models\PasswordResetRequestForm;
use news\models\ResetPasswordForm;
use news\models\SignupForm;
use news\models\ContactForm;
use common\models\Article;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $article_object=null;


    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config = []);
        $this->article_object=new Article();

    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($page=0)
    {

        //搜索
        $request = Yii::$app->request;
        $search_info = $request->post('search_text');
        if($search_info!=''){
            $from_search=true;
            $all=$this->article_object->search('','',$search_info);
            $total_num=count($all);
        }else{ //非搜索
            $from_search=false;
            $all=$this->article_object->gettotal();
            $total_num=$all[0]['total_num'];

        }

        //$total_num=$all[0]['total_num'];

        //防边界溢出
        //if($page<=0){$page=0;}
        //if($page>=$total_num){$page=$total_num;}

        //分页
        $every_page_record=10;//每页数目
        $pages=ceil($total_num/$every_page_record);//多少页
        $offset=$page*$every_page_record;//偏移量

        $limit="limit $offset,$every_page_record";
        $where="where a.status=1";

        if($from_search){
            $article_data=$all;
        }else{
            $article_data=$this->article_object->getlist($limit,$where);
        }
        $data=array('article_data_cts'=>$article_data,'avatar_img'=>$this->get_avtar_img(),'comment_icon'=>$this->get_icon(),'current_page'=>$page,'total_page'=>$pages);
        return $this->render('index',$data);
    }


    /**
     *
     * 获取文章内容
     *
     */
    public function actionArticle()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');
        $article_content=$this->article_object->getarticle($id);
        $data=array('article_content'=>$article_content,'avatar_img'=>$this->get_avtar_img());
        return $this->render('article',$data);

    }


    /**
     *
     * 随机获取头像
     */
    public function get_avtar_img()
    {

        $img=array(
            '0'=>'123eder.png',
            '1'=>'auB.png',
            '2'=>'kiovMI.jpg',
            '3'=>'njs5.png',
            '4'=>'vgtf6.png',
            '5'=>'A7lBMO5.jpg',
            '6'=>'bgtr3.png',
            '7'=>'lkm2.png',
            '8'=>'njuy67.png',
            '9'=>'wPhjxjef5.jpg',
            '10'=>'E4LTxrW.jpg',
            '11'=>'bhyt4.png',
            '12'=>'lkmp3.png',
            '13'=>'plmo97.png',
            '14'=>'xsde3.png',
            '15'=>'FLVeiyQmN.jpg',
            '16'=>'byt2789.png',
            '17'=>'mki8.png',
            '18'=>'plok5.png',
            '19'=>'xswe2.png',
            '20'=>'GILOLj7vqz.jpg',
            '21'=>'cfr3.png',
            '22'=>'mkij9.png',
            '23'=>'polki98.jpg',
            '24'=>'zsxde1.png',
            '25'=>'GsAct.png',
            '26'=>'cvfgt3.png',
            '27'=>'mko987.png',
            '28'=>'mko987.png',
            '29'=>'qVebjwgyd.jpg',
            '30'=>'zxde2.png',
            '31'=>'VeiyQm.png',
            '32'=>'VeiyQm.png',
            '33'=>'nhu2.png',
            '34'=>'srfd455.png',
            '35'=>'XLxvFVD.png',
            '36'=>'ik8789.png',
            '37'=>'nhyt7.png',
            '38'=>'umRY8i.jpg',

        );

        return $img;

    }


    /**
     *
     * 随机获取图标
     *
     */
    public function get_icon()
    {
        $icon=array(
            '0'=>'fa-glass',
            '1'=>'fa-music',
            '2'=>'fa-search',
            '3'=>'fa-envelope-o',
            '4'=>'fa-heart',
            '5'=>'fa-star',
            '6'=>'fa-star-o',
            '7'=>'fa-user',
            '8'=>'fa-film',
            '9'=>'fa-th-large',
            '10'=>'fa-th',
            '11'=>'fa-th-list',
            '12'=>'fa-check',
            '13'=>'fa-times',
            '14'=>'fa-search-plus',
            '15'=>'fa-search-minus',
            '16'=>'fa-signal',
            '17'=>'fa-gear',
            '18'=>'fa-cog',
            '19'=>'fa-trash-o',
            '20'=>'fa-home',
            '21'=>'fa-file-o',
            '22'=>'fa-clock-o',
            '23'=>'fa-road',
            '24'=>'fa-download',
            '25'=>'fa-arrow-circle-o-down',
            '26'=>'fa-arrow-circle-o-up',
            '27'=>'fa-flag',
            '28'=>'fa-headphones',
            '29'=>'fa-qrcode',
            '30'=>'fa-tags',
            '31'=>'fa-book',
            '32'=>'fa-camera',
            '33'=>'fa-video-camera',
            '34'=>'fa-pencil',
            '35'=>'fa-map-marker',
            '36'=>'fa-tint',
            '37'=>'fa-arrows',
            '38'=>'fa-minus-circle',
        );

        return $icon;
    }



    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
