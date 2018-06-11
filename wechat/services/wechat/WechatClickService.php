<?php

namespace wechat\services\wechat;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use common\models\User;
use common\services\UserService;

/**
 * Description of UserService
 *
 * @author qingyangsheng
 */
class WechatClickService
{

    /**
     * 处理微信公众号里面的菜单点击事件
     * @param  array $returnData
     */
    public static function fitInit($returnData)
    {
        \Yii::error($returnData);
        $clickButtonName = $returnData['EventKey'];
        switch ($clickButtonName) {
            case 'weixin_clickone':
                self::lotteryMoney($returnData);
                break;
            case 'weixin_clicktwo':
                self::lotteryGift($returnData);
                break;
            case 'weixin_clickthree':
                self::lotteryCoupon($returnData);
                break;
            case 'weixin_joinus':
                self::joinUs($returnData);
                break;
            case 'weixin_right':
                self::lotteryCoupon($returnData);
                break;
            case 'weixin_todaylottery':
                self::joinUs($returnData);
                break;
            default:
                self::defaultClick($returnData);
        }

    }

    /**
     * 抽现金功能
     * @param $returnData
     */
    public static function lotteryMoney($returnData)
    {
        $number = rand(1, 1000);
        if ($number > 100) {
            $money = rand(1, 9) / 100;
        } elseif ($number > 10) {
            $money = rand(10, 99) / 100;
        } else {
            $money = rand(100, 1000) / 100;
        }
        //从缓冲获取数量
        //获得key值
        $timeKey = "lotterynum_".date("Ymd");
        $lotteryNum = \Yii::$app->cache->get($timeKey);
        //获得用户信息
        $userInfo=self::findMyUser_id($returnData);
        if(empty($userInfo)){
            $content = sprintf("恭喜您中了%1\$.2f元，由于你不是会员，所以当前中奖无效。", $money);
            $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
            echo $templet;
            \Yii::$app->end();
        }
        $content="";
        if ($lotteryNum === false || $lotteryNum < 101) {
            //如果中奖不达到100，那么放开下一步
             if($lotteryNum===false){
                 \Yii::$app->cache->set($timeKey,1);
             }else{
                 \Yii::$app->cache->set($timeKey,$lotteryNum+1);
             }
             //增加一个缓冲验证用户没有中过奖的功能
            $isHaveLotteyTodayKey=$timeKey."".$userInfo['user_id'];
            $isHaveLotteyToday=\Yii::$app->cache->get($isHaveLotteyTodayKey);
            if($isHaveLotteyToday){
                $content = sprintf("尊敬的代号：%s，今天您已经中过奖了，留点机会让别人高兴高兴吧。", $userInfo['user_id']);
                $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
                echo $templet;
                \Yii::$app->end();
            }
             //调用存储过程给用户增加中奖记录
            try {
                $connection = \Yii::$app->db;
                $ip = \Yii::$app->request->getUserIP();
                $sqlstring = "'{$userInfo['id']}','{$money}','{$ip}',@outstates,@outremark";
                $command = $connection->createCommand("CALL p_lotteryMoney(" . $sqlstring . ")");
                $command->execute();
                $outresults = $connection->createCommand("select @outstates as states,@outremark as remark")->query();
                $outresult = array();
                foreach ($outresults as $key => $value) {
                    $outresult['states'] = $value['states'];
                    $outresult['remark'] = $value['remark'];
                    break;
                }
                if ($outresult['states'] == '1') {
                    $content=sprintf("恭喜您,代号：%s。您抽中了%s元。",$userInfo['user_id'],$money);
                    \Yii::$app->cache->set($isHaveLotteyToday,1);
                } else {
                    $content=sprintf("代号：%s，神说：%s",$userInfo['user_id'], $outresult['remark']);
                }
            } catch (Exception $e) {
                \Yii::error($e);
                $content=sprintf("代号：%s，神说：想中奖？服务器都被外星人T飞了！");
                return array(0 => false, "1" => $e);
            }
        } else {
            $content = sprintf("今天总的抽奖次数100次已经被抽完了啦！明天加油哦，代号：%s",$userInfo['user_id']);
        }
        $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
        echo $templet;
    }

    /**
     * 抽实物功能
     * @param $returnData
     */
    public static function lotteryGift($returnData)
    {
        $gif = rand(1, 1000) / 100;

        if ($gif == 88) {
            $content = "千分之一的机率都被您抽中了翠雅牙膏一盒！";
        } else {
            $content = "千分之一的中奖机率！您是传说中的那个神奇人物吗？";
        }

        $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
        echo $templet;

    }

    /**
     * 抽优惠卷功能
     * @param $returnData
     */
    public static function lotteryCoupon($returnData)
    {
        $content = sprintf("恭喜您中了3.00元的无极限优惠卷，点击使用可减免相应现金");
        $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
        echo $templet;
    }

    /**
     * 处理没有处理到的点击
     * @param array $returnData
     */
    public static function defaultClick($returnData)
    {
        $content = "当前功能还没有被实现哦，请稍侯重试";
        $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
        echo $templet;
    }

    /**
     * 注册用户信息到数据库
     * @param array $returnData
     */
    public static function joinUs($returnData)
    {
        //先从缓冲查
        $userWechatInfo = \Yii::$app->cache->get($returnData['FromUserName']);
        if (!$userWechatInfo) {
            //查询用户是否存在
            $userSer = new UserService();
            $user = $userSer->findUserByWechaId($returnData['FromUserName']);
            if (!$user) {
                $newUser = new User();
                $newUser->wechat_id = $newUser->username = $returnData['FromUserName'];
                $newUser->addtime = time();
                $newUser->addip = \Yii::$app->request->remoteIP;
                if ($newUser->save()) {
                    $userWechatInfo['user_id'] = \Yii::$app->db->lastInsertID;
                    \Yii::$app->cache->set($returnData['FromUserName'], $userWechatInfo);
                    $content = sprintf("恭喜您已成功加入联盟，您的终生代号为：%s", $userWechatInfo['user_id']);
                    $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
                    echo $templet;
                    \Yii::$app->end();
                } else {
                    $content = "服务器歇菜了，稍侯再捅它吧。";
                    $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
                    echo $templet;
                    \Yii::$app->end();
                }
            } else {
                $user_id = $userWechatInfo['user_id'] = $user->user_id;
                \Yii::$app->cache->set($returnData['FromUserName'], $userWechatInfo);
                $content = sprintf("尊敬的 %u，您已成功加入会员。无需再加入", $user_id);
                $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
                echo $templet;
            }
        } else {
            $user_id = $userWechatInfo['user_id'];
            $content = sprintf("尊敬的 %s，您已成功加入会员。无需再加入", $user_id);
            $templet = WechatAutoReplyTempletService::textTemplet($returnData, $content);
            echo $templet;
        }
    }

    /**
     * 获取用户的配置
     * @param $returnData
     * @return array|mixed
     */
    public static function findMyUser_id($returnData)
    {
        //先从缓冲查
        $userWechatInfo = \Yii::$app->cache->get($returnData['FromUserName']);
        if (!$userWechatInfo) {
            //查询用户是否存在
            $userSer = new UserService();
            $user = $userSer->findUserByWechaId($returnData['FromUserName']);
            if (!$user) {
                return [];
            } else {
                $userWechatInfo['user_id'] = $user->user_id;
                \Yii::$app->cache->set($returnData['FromUserName'], $userWechatInfo);
            }
        }
        return $userWechatInfo;
    }
}
