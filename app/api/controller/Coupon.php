<?php
namespace app\api\controller;

use \think\Db;

class Coupon
{
    public function list(){
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
            msg(0,'请输入正确的页码');
        }
        if (empty($limit) || !is_numeric($limit)) {
            msg(0,'请输入正确的条数');
        }
        $number = ($page - 1) * $limit;
        $data = model('coupon')->getlist($number,$limit);
        return $data ? ['status'=>1,'data'=>$data] : ['status'=>0,'data'=>[]];
    }
}