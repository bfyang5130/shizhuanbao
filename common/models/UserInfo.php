<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "UserInfo".
 *
 * @property integer $UserId
 * @property string $NickName
 * @property string $Password
 * @property string $Paypassword
 * @property string $Salt
 * @property integer $IsRoot
 * @property integer $IsDifferent
 * @property string $Device
 * @property integer $Sex
 * @property integer $Age
 * @property string $PhoneNumber
 * @property string $CityIP
 * @property string $CityGPS
 * @property string $RegisterDate
 * @property string $Weixin
 * @property integer $Status
 * @property integer $InvitedUserId
 * @property string $DeviceId
 * @property string $Head
 * @property string $Birthday
 * @property string $WeiXinNickName
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UserInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Password', 'DeviceId'], 'required'],
            [['IsRoot', 'IsDifferent', 'Sex', 'Age', 'Status', 'InvitedUserId'], 'integer'],
            [['RegisterDate', 'Birthday'], 'safe'],
            [['NickName', 'Password', 'Paypassword', 'Salt', 'PhoneNumber', 'CityIP', 'CityGPS'], 'string', 'max' => 50],
            [['Device', 'Weixin'], 'string', 'max' => 100],
            [['DeviceId'], 'string', 'max' => 64],
            [['Head', 'WeiXinNickName'], 'string', 'max' => 255],
            [['DeviceId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserId' => 'User ID',
            'NickName' => 'Nick Name',
            'Password' => 'Password',
            'Paypassword' => 'Paypassword',
            'Salt' => 'Salt',
            'IsRoot' => 'Is Root',
            'IsDifferent' => 'Is Different',
            'Device' => 'Device',
            'Sex' => 'Sex',
            'Age' => 'Age',
            'PhoneNumber' => 'Phone Number',
            'CityIP' => 'City Ip',
            'CityGPS' => 'City Gps',
            'RegisterDate' => 'Register Date',
            'Weixin' => 'Weixin',
            'Status' => 'Status',
            'InvitedUserId' => 'Invited User ID',
            'DeviceId' => 'Device ID',
            'Head' => 'Head',
            'Birthday' => 'Birthday',
            'WeiXinNickName' => 'Wei Xin Nick Name',
        ];
    }
}
