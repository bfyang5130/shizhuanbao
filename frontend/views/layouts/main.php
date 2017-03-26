<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="/css/base.css?v=<?= date("YmdHis") ?>" rel="stylesheet">
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?= $this->render("baseTopMin.php") ?>
            <?= $this->render("header.php") ?>
        </div>
        <?= $content ?>
        <div class="warp clear bgbottom">
            <p class="pull-left">版权所有<a href="http://www.miitbeian.gov.cn" target="_blank" rel="external nofollow">粤ICP备13068737号-1</a> <?= date('Y') ?></p>

            <p class="pull-right">深圳市寻想网络科技</p>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
