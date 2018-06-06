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
class WechatAutoReplyTempletService {

    /**
     * 文本回复模板
     * @param array $returnData
     * @param string $content
     * @return string $resultStr
     */
    public static function textTemplet($returnData,$content) {
        $textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";
        $resultStr = sprintf($textTpl, $returnData['FromUserName'], $returnData['ToUserName'], time(), $content);
        return $resultStr;
    }
    /**
     * 图文回复模板
     * @param $returnData
     */
    public static function NewsTemplet($returnData) {
        $content="好了好了，我知道了，我现在又能访问了";
        \Yii::$app->wechat->sendText($returnData['FromUserName'],$content);
    }
}
