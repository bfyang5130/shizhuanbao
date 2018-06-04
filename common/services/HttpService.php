<?php

namespace common\services;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HttpService
 *
 * @author qingyangsheng
 */
class HttpService {

    //put your code here
    /**
     * 通过post得到请求的内容
     */
    public static function curlPost() {
        
    }

    /**
     *   通过get得到请求的信息
     */
    public static function curlGet($url) {
        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
//释放curl句柄
        curl_close($ch);
        return $output;
    }

}
