<?php

namespace api\services;

use common\models\UserInfo;
use api\services\Des3Service;

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
class AuthUserService {

    /**
     * 验证加密userid是否符合条件
     * @param type $userId
     */
    public static function authUser(\stdClass $newZiYuan) {
        $theUser = UserInfo::findOne($newZiYuan->ivx);
        //不存在用户直接返回错误
        if (!$theUser) {
            return false;
        }
        //验证用户
        $ivx = $theUser->Salt;
        if (empty($ivx)) {
            return false;
        }
        //验证有效时间
        $tokenArray= explode("-", $ivx);
        $nowtime= time();
        if($nowtime>$tokenArray[1]){
            return 1;
        }
        //解密key值
        var_dump($newZiYuan->userid);
        $new3Des = new Des3Service();
        $new3Des->Crypt3Des('qXSdHWfbSZaaLeHBRhLgxBiG');
        $enString=$new3Des->encrypt('123456789');
        var_dump($enString);
        //$deString = $new3Des->decrypt($newZiYuan->userid);
        //var_dump($deString);
        echo 11;exit;
        if ($deString !== $newZiYuan->ivx) {
            return false;
        } else {
            \Yii::$app->appUser = $theUser;
            return TRUE;
        }
    }

}
