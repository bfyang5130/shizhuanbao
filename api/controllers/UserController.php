<?php

namespace api\controllers;

use yii\web\Controller;

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
        $userInfoJson=\Yii::$app->request->get('userInfo',null);
        $errorCode=400;
        if($userInfoJson){
            $userInfo= json_decode($userInfoJson);
            print_r($userInfo);
        }
        exit;
        $dataList = [];
        for ($i = 0; $i < 20; $i++) {
            $dataList[$i] = ["id" => "" . $i, "name" => "名剑风流" . $i, "user" => "bfyang5130", "time" => date("Y-m-d H:i:s")];
        }
        if (isset($dataList[1])) {
            $data = ["error_code" => 200, "datalist" => $dataList];
        } else {
            $data = ["error_code" => 400, "message" => "没有相关数据"];
        }
        return json_encode($data);
        //return $this->render("index");
    }

}
