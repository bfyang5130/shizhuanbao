<?php

namespace wechat\controllers;

use yii\web\Controller;
use api\services\UserService;

/**
 * Index controller
 */
class UserController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;;
        $userInfoJson = \Yii::$app->request->get('userInfo', null);
        $returnData = [];
        if ($userInfoJson) {
            $userInfo = json_decode($userInfoJson);
            $returnData = UserService::buildUser($userInfo);
        } else {
            $returnData = ["error_code" => 400, "message" => "错误的操作"];
        }
        return json_encode($returnData);
        //return $this->render("index");
    }

}
