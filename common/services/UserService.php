<?php

namespace common\services;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use common\models\User;

/**
 * Description of HttpService
 *
 * @author qingyangsheng
 */
class UserService
{

    /**
     * @param $wechat_id
     * @return array|null|\common\models\User
     */
    public function findUserByWechaId($wechat_id)
    {
        $user = User::find()->where(['wechat_id' => $wechat_id])->one();
        return $user;

    }

}
