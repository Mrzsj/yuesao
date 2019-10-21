<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-19 08:56:04
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-19 10:28:59
 */
//配置文件
return [
    // 默认输出类型
    'default_return_type'    => 'json',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    //token时效
    'token_time'=>31536000*10,//31536000*10
    'cache' => [ // 缓存
        'token_expire' => 31536000*10, //1小时 =3600
        'type'   => 'File',
        'host'   => '127.0.0.1',
        'port'   => '6379',
        'path'   => ROOT_PATH."login".DS,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],
    'appid'=>'wxcd417936b51ed32a',
    'appsecret'=>'43f4fa48efdf86e43a4a0b093e28189c',
    'MCHID'=>'1455955802',
    'KEY'=>'abef3c0b40dd00c283551204db78fd77',
    'body'=>'安徽犇犇牛网络科技有限公司',
];