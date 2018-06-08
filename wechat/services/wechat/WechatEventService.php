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
class WechatEventService {

    /**
     * 处理微信公众号里面的菜单点击事件
     * @param  array $returnData
     */
    public static function fitInit($returnData) {
        $msgType=$returnData['Event'];
        switch ($msgType) {
            case 'CLICK':
                WechatClickService::fitInit($returnData);
                break;
            default:
                WechatTextService::fitInit($returnData);
                break;
        }

    }
}
