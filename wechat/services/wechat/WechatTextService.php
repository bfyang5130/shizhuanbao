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
        $content="当前功能还没有实现哦。";
        $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
        \Yii::error($templet);
        echo $templet;
    }
}
