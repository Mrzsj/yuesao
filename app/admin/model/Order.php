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
}
