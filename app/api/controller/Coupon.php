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
    public function receive(){
        $userid = get_token();
        $id = input('id');
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请传入正确的id');
        }
        $id = intval($id);
        $coupon = model('coupon')->getone($id);
        if(empty($coupon)){
            msg(0,'优惠券不存在');
        }
        if($coupon['status'] == 0){
            msg(0,'优惠券已被禁止领取');
        }
        if($coupon['total'] <= $coupon['receive_num']){
            msg(0,'优惠券已领完');
        }
        if($coupon['type'] == 1){
            $res = Db::name('coupon_log')->where('type','1')->where('user_id',$userid)->find();
            if(!empty($res)){
                msg(0,'您不是新人，无法领取');
            }
        }
        $res = Db::name('coupon_log')->where('coupon_id',$id)->where('user_id',$userid)->find();
        if(!empty($res)){
            msg(0,'该优惠券已领取过');
        }
        $data = [
            'user_id'=>$userid,
            'coupon_id'=>$id,
            'title'=>$coupon['title'],
            'face_value'=>$coupon['face_value'],
            'type'=>$coupon['type'],
            'validity_time'=>$coupon['validity_time'],
            'full'=>$coupon['full'],
            'create_time'=>time(),
            'expire_time'=>strtotime('+'.$coupon['validity_time'].' days'),
            'update_time'=>time(),
            'status'=>1
        ];
        Db::startTrans();
        try{
            Db::name('coupon')->where('id', $id)->setInc('receive_num');
            Db::name('coupon_log')->insert($data);
            Db::commit();
            msg(1,'领取成功');
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            msg(0,'领取失败');
        }
    }
    public function my(){
        $userid = get_token();
        $status = input('status');
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
            msg(0,'请输入正确的页码');
        }
        if (empty($limit) || !is_numeric($limit)) {
            msg(0,'请输入正确的条数');
        }
        if (empty($status) || !is_numeric($status)) {
            msg(0,'请输入正确的状态');
        }
        $number = ($page - 1) * $limit;
        $data = model('coupon')->my($number,$limit,$userid,$status);
        return $data ? ['status'=>1,'data'=>$data] : ['status'=>0,'data'=>[]];
    }
}