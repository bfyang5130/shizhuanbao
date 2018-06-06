<?php

namespace api\services;

use common\models\UserInfo;
use common\services\HttpService;
use common\components\weixindecode\WXBizDataCrypt;

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
class Des3Service {

    public $key = ""; //这个根据实际情况写

    function Crypt3Des($key) {

        $this->key = $key;
    }

    /**
     * 加密 
     * @param <type> $value 
     * @return <type> 
     */
    public function encrypt($value) {
        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
        $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        $value = $this->PaddingPKCS7($value);
        //$key = base64_decode($this->key);  
        $key = $this->key;
        mcrypt_generic_init($td, $key, $iv);
        $ret = base64_encode(mcrypt_generic($td, $value));
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $ret;
    }

    /**
     * 解密 
     * @param <type> $value 
     * @return <type> 
     */
    public function decrypt($value) {
        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_ECB, '');
        $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        $key =$this->key;
        mcrypt_generic_init($td, $key, $iv);
        $ret = trim(mdecrypt_generic($td, base64_decode($value)));
        $ret = $this->UnPaddingPKCS7($ret);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $ret;
    }

    private function PaddingPKCS7($data) {
        $block_size = mcrypt_get_block_size('tripledes', 'cbc');
        $padding_char = $block_size - (strlen($data) % $block_size);
        $data .= str_repeat(chr($padding_char), $padding_char);
        return $data;
    }

    private function UnPaddingPKCS7($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }


      /**
     * 根据用户的登录时间及微信用户的IV来随便生成一个解码给到客户端
     * @param type $ivx
     * @return type
     */
    public static function buildRandIvx($ivx) {
        //向前推进30分钟,加密处理
        $baseExistDate = strtotime("+30 Minutes");
        $toEnCode = md5($ivx . "-" . $baseExistDate);
        //随机截取md5后的6位字母当作解密串
        $randCode = rand(0, 26);
        //处理传回客户端的IV
        $enIvx = substr($toEnCode, $randCode, 6);
        //加上时间有效期
        $toReturnString = $enIvx . "-" . $baseExistDate;

        return [
            'ivx' => $enIvx,
            'reString' => $toReturnString
        ];
    }

}
