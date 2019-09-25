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
    public function my($number,$limit,$userid,$status){
        $status ? $judge_symbol = '>=' : $judge_symbol = '<';
        $data = Db::name('coupon_log')
        ->field(['title','face_value','type','expire_time','full'])
        ->where('status','1')
        ->where('user_id',$userid)
        ->where('expire_time',$judge_symbol,time())
        ->order('id asc')
        ->limit($number,$limit)
        ->select();
        if(!empty($data)){
            foreach($data as $k => $v){
                $data[$k]['expire_time'] = date('Y-m-d H:i:s',$v['expire_time']); 
            }
        }
        return $data;
    }
}
