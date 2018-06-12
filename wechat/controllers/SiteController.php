<?php
namespace wechat\controllers;

use callmez\wechat\sdk\Wechat;
use wechat\services\WechatService;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use api\models\PasswordResetRequestForm;
use api\models\ResetPasswordForm;
use api\models\SignupForm;
use api\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * 是否支持防csrf功能
     * @var bool
     */
   public $enableCsrfValidation=false;


    /**
     * wechat api enter
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //使用微信服务来处理信息
        WechatService::baseFit();
        \Yii::$app->end();
    }
    /**
     * 初始化菜单接口，用来初始化公众号的自定义菜单，后台实现功能后，这个功能将废弃
     *
     * @return mixed
     */
    public function actionCommand()
    {
        //使用微信服务来处理信息
        $wechat=\Yii::$app->wechat;
        $menu=[
                [
                    "name"=>"联盟",
                     "sub_button"=>[
                         ["type"=>"click","name"=>"注册会员","key"=>"weixin_joinus"],
                         ["type"=>"click","name"=>"会员权利","key"=>"weixin_right"]
                     ]
                ],
                [
                    "name"=>"碰手气",
                    "sub_button"=>[
                        ["type"=>"click","name"=>"抽现金","key"=>"weixin_clickone"],
                        ["type"=>"click","name"=>"抽实物","key"=>"weixin_clicktwo"],
                        ["type"=>"click","name"=>"抽优惠","key"=>"weixin_clickthree"]
                    ]
                ],
                [
                    "name"=>"发现",
                    "sub_button"=>[
                        ["type"=>"click","name"=>"查资产","key"=>"weixin_account"],
                        ["type"=>"click","name"=>"今日公告","key"=>"weixin_notice"],
                        ["type"=>"click","name"=>"申请提现","key"=>"weixin_tixian"],
                        ["type"=>"click","name"=>"充值","key"=>"weixin_chongzhi"]
                    ]
                ]
        ];
        if($wechat->createMenu($menu)){
            echo "ok";
        }else{
            echo "fail";
        }
        \Yii::$app->end();
    }
}
