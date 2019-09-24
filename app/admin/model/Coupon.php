<?php
namespace app\admin\model;

use \think\Model;
use \think\Db;
class Coupon extends Model{
	public static function getlist($number,$limit){
		$data = Db::name('coupon')->order('id desc')->limit($number,$limit)->select();
		foreach($data as $k => $v){
			$data[$k]['start_time'] = date('Y-m-d H:i:s',$v['start_time']);
			$data[$k]['end_time'] = date('Y-m-d H:i:s',$v['end_time']);
			$data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			$data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
		}
		return $data;
	}
	public static function total(){
		$data = Db::name('coupon')->field('count(id)')->find();
		return $data['count(id)'];
	}	
	public static function del($id){
		$res = Db::name('coupon')->where('id',$id)->delete();
		return $res;
	}
	public static function getone($id){
		$res = Db::name('coupon')->where('id',$id)->find();
		return $res;
	}
}
