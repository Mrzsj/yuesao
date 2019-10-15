<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-23 09:54:52
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-09-23 09:54:52
 */
namespace app\admin\model;

use \think\Model;
use \think\Db;
class Coupon extends Model{
	public static function getlist($number,$limit,$where=''){
		$data = Db::name('coupon')->order('id desc')->where($where)->limit($number,$limit)->select();
		foreach($data as $k => $v){
			$data[$k]['start_time'] = date('Y-m-d H:i:s',$v['start_time']);
			$data[$k]['end_time'] = date('Y-m-d H:i:s',$v['end_time']);
			$data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			$data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
		}
		return $data;
	}
	public static function total($where=''){
		$data = Db::name('coupon')->field('count(id)')->where($where)->find();
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
