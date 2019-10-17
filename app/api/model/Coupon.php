<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-24 10:21:37
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-17 14:07:01
 */
namespace app\api\model;

use \think\Model;
use \think\Db;
class Coupon extends Model{
	public function getlist($number,$limit,$userid){
        // $data = Db::name('coupon')
        // ->alias('c')
        // ->fetchSql()
        // ->join('coupon_log l','c.id=l.coupon_id','left')
        // ->field(['c.id','c.title','c.face_value','c.type','c.validity_time','c.full','l.id as l_id'])
        // ->where('c.status','1')
        // ->where('c.start_time','<',time())
        // ->where('c.end_time','>',time())
        // ->order('c.id desc')
        // ->limit($number,$limit)
        // ->select();
        if($userid){
            $sql = "SELECT `c`.`id`,`c`.`title`,`c`.`face_value`,`c`.`type`,`c`.`validity_time`,`c`.`full`,l.id as l_id FROM `coupon` `c` LEFT JOIN (select * from coupon_log where user_id=".$userid.") `l` ON `c`.`id`=`l`.`coupon_id` WHERE  `c`.`status` = '1'  AND `c`.`start_time` < ".time()."  AND `c`.`end_time` > ".time()." ORDER BY `c`.`id` DESC LIMIT ".$number.",".$limit; 
        }else{
            $sql = "SELECT `c`.`id`,`c`.`title`,`c`.`face_value`,`c`.`type`,`c`.`validity_time`,`c`.`full`,l.id as l_id FROM `coupon` `c` LEFT JOIN (select * from coupon_log) `l` ON `c`.`id`=`l`.`coupon_id` WHERE  `c`.`status` = '1'  AND `c`.`start_time` < ".time()."  AND `c`.`end_time` > ".time()." ORDER BY `c`.`id` DESC LIMIT ".$number.",".$limit;
        }
        $data = Db::query($sql);
        if($userid){
            foreach($data as $k => $v){
                if(!empty($v['l_id'])){
                    $data[$k]['is_receive'] = 1;
                }else{
                    $data[$k]['is_receive'] = 0;
                }
                unset($data[$k]['l_id']);
            } 
        }
        return $data;
    }
    public function getone($id = 0){
        $data = Db::name('coupon')->where('id',$id)->find();
        return $data;
    }
    public function my($number,$limit,$userid,$status){
        $status ? $judge_symbol = '>=' : $judge_symbol = '<';
        $data = Db::name('coupon_log')
        ->field(['title','face_value','type','expire_time','full','id'])
        ->where('status','1')
        ->where('user_id',$userid)
        ->where('expire_time',$judge_symbol,time())
        ->order('id desc')
        ->limit($number,$limit)
        ->select();
        if(!empty($data)){
            foreach($data as $k => $v){
                $data[$k]['face_value'] = intval($v['face_value']);
                $data[$k]['expire_time'] = date('Y-m-d H:i:s',$v['expire_time']); 
            }
        }
        return $data;
    }
}
