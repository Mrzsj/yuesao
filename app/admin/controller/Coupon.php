<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-23 09:48:33
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-15 17:03:57
 */
namespace app\admin\controller;

use \think\Db;
use app\admin\controller\Permissions;
use \think\Validate;
use app\admin\model\Coupon as coupon_model;
class Coupon extends Permissions
{
    public function index(){
        return $this->fetch();
    }
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
        if(!empty(input('title'))){
            $where = "title like '%".input('title')."%'";
        }else{
            $where = '';
        }
        $data = coupon_model::getlist($number,$limit,$where);
        $total = coupon_model::total($where);
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
    public function del(){
        $id = input('id');
        if (!empty($id) && is_numeric($id)) {
          $res = coupon_model::del($id);
            if ($res == 1) {
                return ['status'=>1,'msg'=>'删除成功'];
            }else{
                return ['status'=>0,'msg'=>'删除失败'];
            }
        }else{
            return ['status'=>0,'msg'=>'id不合法'];
        }
    }
    public function status(){
        $status = input('status');
        $id = input('id');
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请输入正确的id');
        }
        $id = intval($id);
        //前端传的布尔型  后端接收时是字符串的true false
        $status == 'true' ? $status = 1 : $status = 0;
        $res = Db::name('coupon')->where('id',$id)->update(['status'=>$status,'update_time'=>time()]);
        $res ? msg(1,'修改成功') : msg(0,'修改失败');
    }
    public function add(){
        return $this->fetch();
    }
    public function edit(){
        $id = input('id');
        if(empty($id)){
            return $this->fetch('add');
        }
        $id = intval($id);
        $data = coupon_model::getone($id);
        if(!empty($data)){
            $this->assign('data',$data);
            return $this->fetch('add');
        }else{
            return $this->fetch('add');
        }
    }
    public function post(){
        $data = input('post.');
        $rule = [
            'title'  => 'require',
            'type' => 'in:1,2',
            'face_value'=>'number',
            'validity_time'=>'require',
            'total'=>'number',
            'time'  => 'require',
        ];
        $msg = [
            'title.require' => '请输入优惠券名称',
            'type.in'     => '请输入正确的type',
            'face_value.number'   => '优惠券面值必须为数字',
            'validity_time.require'  => '请输入领取后有效期天数',
            'total.number'        => '请输入优惠券总数',
            'time.require' => '请输入正确的领取时间范围',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($data)) {
            msg(0,$validate->getError());
        }
        $data['validity_time'] = intval($data['validity_time']);
        if(!empty($data['status'])){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        if(!empty($data['full'])){
            $data['full'] = $data['full'];
        }else{
            $data['full'] = 0;
        }
        if($data['full'] != 0 && $data['face_value'] > $data['full']){
            msg(0,'满减不能大于优惠券面值');
        }
        $time = explode(' - ',$data['time']);
        if(count($time) == 2 && strtotime($time[0]) && strtotime($time[1]) && (strtotime($time[1]) > strtotime($time[0]))){
            $data['start_time'] = strtotime($time[0]);
            $data['end_time'] = strtotime($time[1]);
            unset($data['time']);
        }else{
            msg(0,'请输入正确的领取时间范围');
        }
        $data['face_value'] = sprintf("%.2f",  $data['face_value']);
        $data['full'] = sprintf("%.2f",  $data['full']);
        $data['update_time'] = time();
        if(empty(input('id'))){
            //新增
            $data['create_time'] = time();
            unset($data['id']);
            $res = Db::name('coupon')->insert($data);
        }else{
            //修改
            $id = $data['id'];
            $getone = coupon_model::getone($id);
            if($data['total'] < $getone['receive_num']){
                msg(0,'优惠券总数量不能小于已经领取的数量');
            }
            unset($data['id']);
            $res = Db::name('coupon')->where('id',$id)->update($data);
        }
        if($res == 1){
            msg(1,'提交成功');
        }else{
            msg(0,'提交成功');
        }
    }
}
