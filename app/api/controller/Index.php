<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-19 08:56:04
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-09-19 08:56:04
 */
namespace app\api\controller;

class Index
{
    public function index()
    {
        $url = domain_name().'/admin';
        header('HTTP/1.1 301 Moved Permanently');
        header("location:$url");
        exit();
    }
}
