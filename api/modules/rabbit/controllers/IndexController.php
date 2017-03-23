<?php

namespace api\modules\rabbit\controllers;

use yii\web\Controller;

/**
 * Default controller for the `rabbit` module
 */
class IndexController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        //创建一个channe值，并且绑定key值
        /**
          for ($i = 0; $i <= 1000; $i++) {
          \Yii::$app->amqp->testDirect("direct1", "direct1", $i . "iamfirstone" . date("Y-m-d H.i.s"), "direct");
          }
         */
        for ($i = 0; $i <= 1000; $i++) {
            \Yii::$app->amqp->testGet("direct1", "direct1", "direct");
        }
        \Yii::$app->end();
    }

}
