<?php

namespace wechat\services\wechat;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserService
 *
 * @author qingyangsheng
 */
class WechatDefaultService {

    /**
     * @param $returnData
     */
    public static function fitInit($returnData) {
        $content="好了好了，我知道了，我现在又能访问了";
        \Yii::$app->wechat->sendText($returnData['FromUserName'],$content);
    }
}
