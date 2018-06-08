<?php

namespace wechat\services;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use wechat\services\wechat\WechatClickService;
use wechat\services\wechat\WechatEventService;
use wechat\services\wechat\WechatTextService;

/**
 * Description of UserService
 *
 * @author qingyangsheng
 */
class WechatService {

    /**
     * 检测一个用户
     * @param type $userInfo
     * 
     */
    public static function baseFit() {
        //加入接口验证
        $wechat=\Yii::$app->wechat;
        if (isset($_GET['echostr'])) {
            $isCheck=$wechat->checkSignature();
            if($isCheck){
                echo $_GET['echostr'];
            }else{
                echo "no checkout";
            }
        } else {
            //解析服务器反馈的参数并决定进入那个部分处理
            $returnData=$wechat->parseRequestData();
            if(isset($returnData['MsgType'])){
                $msgType=$returnData['MsgType'];
                switch ($msgType) {
                    case 'text':
                        WechatTextService::fitInit($returnData);
                        break;
                    case 'event':
                        WechatEventService::fitInit($returnData);
                        break;
                    default:
                        WechatTextService::fitInit($returnData);
                        break;
                }
            }else{
                \Yii::error($returnData);
            }
        }
    }
}
