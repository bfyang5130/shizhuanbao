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
class WechatTextService {

    /**
     * 基本的发送文本信息，后面会进行扩充
     * @param array $returnData
     */
    public static function fitInit($returnData) {
        \Yii::error($returnData);
        $wechat=\Yii::$app->wechat;
        $content="好了好了，我知道了，我现在又能访问了";
        $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
        WechatAutoReplyTempletService::sendAutoReply($templet);
    }
}
