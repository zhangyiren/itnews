<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\MainAsset;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

//use yii\helpers\Html;
//use yii\helpers\Url;

MainAsset::register($this);
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

    $queryString=Yii::$app->request->get('r');
    if(strpos($queryString,'login')) {
        NavBar::begin([
            'brandLabel' => 'ZMS',
            'brandUrl' => '#',
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => '', 'url' => ['#']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '', 'url' => ['#']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
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
    }


    ?>


<!--    <div class="container">-->
        <?= $content ?>
<!--    </div>-->

</div>

<?php
$footer =
<<<EOF
<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>

        <p class="pull-right"></p>
    </div>
</footer>
EOF;

$queryString=Yii::$app->request->get('r');
if(strpos($queryString,'login')) {
    echo $footer;
}
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
