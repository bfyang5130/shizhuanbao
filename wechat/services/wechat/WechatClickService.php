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
class WechatClickService {

    /**
     * 处理微信公众号里面的菜单点击事件
     * @param  array $returnData
     */
    public static function fitInit($returnData) {
        \Yii::error($returnData);
        $clickButtonName=$returnData['EventKey'];
        switch ($clickButtonName){
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
    public static function lotteryMoney($returnData){
        $number=rand(1,1000);
        if($number>100){
            $money=rand(1,9)/100;
        }elseif($number>10){
            $money=rand(10,99)/100;
        }else{
            $money=rand(100,1000)/100;
        }

        $content=sprintf("恭喜您中了%1\$.2f元，请注册会员以领取，否则资金将在1小时后失效！",$money);
        $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
        echo $templet;
    }

    /**
     * 抽实物功能
     * @param $returnData
     */
    public static function lotteryGift($returnData){
        $gif=rand(1,1000)/100;

        if($gif==88){
            $content="千分之一的机率都被您抽中了翠雅牙膏一盒！";
        }else{
            $content="千分之一的中奖机率！您是传说中的那个神奇人物吗？";
        }

        $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
        echo $templet;

    }

    /**
     * 抽优惠卷功能
     * @param $returnData
     */
    public static function lotteryCoupon($returnData){
        $content=sprintf("恭喜您中了3.00元的无极限优惠卷，点击使用可减免相应现金");
        $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
        echo $templet;
    }

    /**
     * 处理没有处理到的点击
     * @param array $returnData
     */
    public static function defaultClick($returnData){
        $content="当前功能还没有被实现哦，请稍侯重试";
        $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
        echo $templet;
    }
    /**
     * 注册用户信息到数据库
     * @param array $returnData
     */
    public static function joinUs($returnData){
        //先从缓冲查
        $userWechatInfo=\Yii::$app->cache->get($returnData['FromUserName']);
        if(!$userWechatInfo){
            //查询用户是否存在
            $userSer=new UserService();
            $user=$userSer->findUserByWechaId($returnData['FromUserName']);
            if(!$user){
              $newUser= new User();
              $newUser->wechat_id=$newUser->username=$returnData['FromUserName'];
              $newUser->addtime=time();
              $newUser->addip=\Yii::$app->request->remoteIP;
              if($newUser->save()){
                  $userWechatInfo['user_id']=\Yii::$app->db->lastInsertID;
                  \Yii::$app->cache->set($returnData['FromUserName'],$userWechatInfo);
                  $content=sprintf("恭喜您已成功加入联盟，您的终生代号为：%s",$userWechatInfo['user_id']);
                  $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
                  echo $templet;
                  \Yii::$app->end();
              }else{
                  $content="服务器歇菜了，稍侯再捅它吧。";
                  $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
                  echo $templet;
                  \Yii::$app->end();
              }
            }else{
                $user_id=$userWechatInfo['user_id']=$user->user_id;
                \Yii::$app->cache->set($returnData['FromUserName'],$userWechatInfo);
                $content=sprintf("尊敬的 %u，您已成功加入会员。无需再加入",$user_id);
                $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
                echo $templet;
            }
        }else{
            $user_id=$userWechatInfo['user_id'];
            $content=sprintf("尊敬的 %s，您已成功加入会员。无需再加入",$user_id);
            $templet=WechatAutoReplyTempletService::textTemplet($returnData,$content);
            echo $templet;
        }
    }
}
