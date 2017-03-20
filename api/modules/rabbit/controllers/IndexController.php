<?php

namespace api\modules\rabbit\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rabbit` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //创建一个channe值，并且绑定key值
        \Yii::$app->amqp->send("", "abc", "iamfirstone");
        \Yii::$app->end();
    }
}
