<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-24 09:50:27
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-17 14:08:41
 */
namespace app\api\controller;

use \think\Db;
use \think\Validate;
class Coupon
{
    public function list(){
        $token = \think\Request::instance()->header('token');
        $userid = \think\Cache::get($token);
        if(empty($userid) || !is_numeric($userid)){
            $userid = false;
        }
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
            msg(0,'请输入正确的页码');
        }
        if (empty($limit) || !is_numeric($limit)) {
            msg(0,'请输入正确的条数');
        }
        $number = ($page - 1) * $limit;
        $data = model('coupon')->getlist($number,$limit,$userid);
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
        // if (empty($status) || !is_numeric($status)) {
        //     msg(0,'请输入正确的状态');
        // }
        $data['status'] = $status;
        $rule = [
            'status'  => 'require|in:0,1',
        ];
        $msg = [
            'status.require' => '请输入正确的状态码',
            'status.in'     => '请输入正确的状态码',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($data)) {
            msg(0,$validate->getError());
        }
        $number = ($page - 1) * $limit;
        $data = model('coupon')->my($number,$limit,$userid,$status);
        return $data ? ['status'=>1,'data'=>$data] : ['status'=>0,'data'=>[]];
    }
}