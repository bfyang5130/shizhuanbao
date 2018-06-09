<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property int $type_id 用户类型 1-普通用户 2-后台管理员
 * @property string $password_order 用户加密密钥
 * @property string $wechat_id 公众号唯一识别码
 * @property string $username 用户名称
 * @property string $password 密码
 * @property string $paypassword 支付密码
 * @property int $islock 是否锁定 0-正常 1-锁定
 * @property int $invite_userid 邀请好友
 * @property string $invite_name 邀请验证码
 * @property string $invite_money 邀请注册提成
 * @property int $real_status 是否实名认证
 * @property string $card_type 证件类型 1-身份证
 * @property string $card_id 证件号码
 * @property string $nation 民族
 * @property string $realname 真实姓名
 * @property int $status 用户状态
 * @property int $email_status 邮件验证状态
 * @property string $phone_status 手机验证状态
 * @property string $email 邮箱
 * @property int $sex 姓别 0-未设置 1-男 2-女
 * @property string $litpic 头像
 * @property string $tel 电话
 * @property string $phone 手机号码
 * @property string $question 安全问题
 * @property string $answer 安全问题答案
 * @property string $birthday 生日
 * @property string $province 省
 * @property string $city 市
 * @property string $area 地区
 * @property string $address 地址
 * @property string $regtaken 邮件激活配对字符串
 * @property int $regativetime 发送激活邮件的时间
 * @property string $repstaken 重设密码标识
 * @property int $repsativetime 重置密码有效时间
 * @property int $logintime 登陆时间
 * @property int $addtime 添加时间
 * @property string $addip 添加IP
 * @property int $uptime 更新时间
 * @property string $upip 更新IP
 * @property int $lasttime 最后一次登陆时间
 * @property string $lastip 最后一次登陆IP
 * @property string $occupation 职业
 * @property int $agent_level 0-无级别 1-初级代理 2-中级代理 3-高级代理
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'islock', 'invite_userid', 'real_status', 'status', 'email_status', 'sex', 'regativetime', 'repsativetime', 'logintime', 'addtime', 'uptime', 'lasttime', 'agent_level'], 'integer'],
            [['password_order'], 'string', 'max' => 6],
            [['wechat_id'], 'string', 'max' => 40],
            [['username', 'invite_name'], 'string', 'max' => 30],
            [['password', 'paypassword', 'card_id', 'phone_status', 'tel', 'phone', 'addip', 'upip'], 'string', 'max' => 50],
            [['invite_money', 'card_type', 'nation', 'question'], 'string', 'max' => 10],
            [['realname', 'province', 'city', 'area', 'lastip'], 'string', 'max' => 20],
            [['email', 'answer', 'occupation'], 'string', 'max' => 100],
            [['litpic'], 'string', 'max' => 250],
            [['birthday'], 'string', 'max' => 11],
            [['address', 'regtaken', 'repstaken'], 'string', 'max' => 200],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'type_id' => 'Type ID',
            'password_order' => 'Password Order',
            'wechat_id' => 'Wechat ID',
            'username' => 'Username',
            'password' => 'Password',
            'paypassword' => 'Paypassword',
            'islock' => 'Islock',
            'invite_userid' => 'Invite Userid',
            'invite_name' => 'Invite Name',
            'invite_money' => 'Invite Money',
            'real_status' => 'Real Status',
            'card_type' => 'Card Type',
            'card_id' => 'Card ID',
            'nation' => 'Nation',
            'realname' => 'Realname',
            'status' => 'Status',
            'email_status' => 'Email Status',
            'phone_status' => 'Phone Status',
            'email' => 'Email',
            'sex' => 'Sex',
            'litpic' => 'Litpic',
            'tel' => 'Tel',
            'phone' => 'Phone',
            'question' => 'Question',
            'answer' => 'Answer',
            'birthday' => 'Birthday',
            'province' => 'Province',
            'city' => 'City',
            'area' => 'Area',
            'address' => 'Address',
            'regtaken' => 'Regtaken',
            'regativetime' => 'Regativetime',
            'repstaken' => 'Repstaken',
            'repsativetime' => 'Repsativetime',
            'logintime' => 'Logintime',
            'addtime' => 'Addtime',
            'addip' => 'Addip',
            'uptime' => 'Uptime',
            'upip' => 'Upip',
            'lasttime' => 'Lasttime',
            'lastip' => 'Lastip',
            'occupation' => 'Occupation',
            'agent_level' => 'Agent Level',
        ];
    }
}
