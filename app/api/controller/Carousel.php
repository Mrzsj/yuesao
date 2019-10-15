<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-20 15:05:45
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-09-20 15:05:45
 */
namespace app\api\controller;

use \think\Db;
use app\api\model\Carousel as Carousel_model;

class Carousel
{
    public function list(){
        $data = Carousel_model::getlist();
        if(!empty($data)){
            return ['status'=>1,'data'=>$data,'msg'=>'获取轮播图成功'];
        }else{
            return ['status'=>0,'data'=>[],'msg'=>'暂无轮播图'];
        }
    }
}