<?php
namespace app\api\model;

use \think\Model;
use \think\Db;
class Coupon extends Model{
	public function getlist($number,$limit){
        $data = Db::name('coupon')
        ->field(['title','face_value','type','validity_time','full'])
        ->where('status','1')
        ->where('start_time','<',time())
        ->where('end_time','>',time())
        ->order('id asc')
        ->limit($number,$limit)
        ->select();
        return $data;
    }
    public function getone($id = 0){
        $data = Db::name('coupon')->where('id',$id)->find();
        return $data;
    }
}
