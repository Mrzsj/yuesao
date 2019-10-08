<?php
namespace app\admin\model;

use \think\Model;
use \think\Db;
class Order extends Model{
	public static function getlist($number,$limit,$where='',$name=''){
		$data = Db::name('order')->order('id desc')->where($where)->where('name|mobile|ordersn','like','%'.$name.'%')->limit($number,$limit)->select();
		foreach($data as $k => $v){
            $data[$k]['start_time'] = date('Y-m-d',$v['start_time']);
			$data[$k]['end_time'] = date('Y-m-d',$v['end_time']);
			$data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			$data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
		}
		return $data;
	}
	public static function total($where='',$name=''){
		$data = Db::name('order')->field('count(id)')->where($where)->where('name|mobile|ordersn','like','%'.$name.'%')->find();
		return $data['count(id)'];
	}	
	public static function del($id){
		$res = Db::name('coupon')->where('id',$id)->delete();
		return $res;
	}
	public function status($status){
		$id = input('id');
		if (empty($id) || !is_numeric($id)) {
            msg(0,'请输入正确的id');
		}
		$res = Db::name('order')->where('id',$id)->find();
		if($status == 1 || $status == 3){
			if(empty($res) || $res['status'] != 0){
				msg(0,'订单必须处于待付款状态');
			}
		}
		if($status == 1 || $status == 3){
			$res = Db::name('order')->where('id',$id)->find();
			if(empty($res) || $res['status'] != 0){
				msg(0,'订单必须处于待付款状态');
			}
		}
        $data = [
            'status'=>1,
            'update_time'=>time(),
            'wx_transaction_id'=>'',
        ];
        try {
            Db::name("order")->where('id',$id)->update($data);
            msg(1,'确认支付成功');
        } catch (Exception $e) {
            msg(0,'确认支付失败');
        }
	}
}
