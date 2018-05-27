<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '登录';
//$this->params['breadcrumbs'][] = $this->title;
?>



<div class="center-block" style="width:500px;margin-top:3%;">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="site-login">
                <!--<h1><?= Html::encode($this->title) ?></h1>-->
                <!--<p>欢迎使用zms</p>-->

                <h3 class="text-center">欢迎使用</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-3">{image}</div></div>',
                        ]) ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <?= Html::submitButton('登 录', ['class' => 'btn btn-block btn-primary', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div> <!-- site-login end -->
        </div><!--panel-body end -->
    </div><!-- panel-default end -->
</div>
