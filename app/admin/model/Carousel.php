<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-20 10:34:00
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-15 17:05:15
 */
namespace app\admin\model;

use \think\Model;
use \think\Db;
class Carousel extends Model{
	public static function getlist($number,$limit){
		$data = Db::name('carousel')->order('id desc')->limit($number,$limit)->select();
		foreach($data as $k => $v){
			$data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			$data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
		}
		return $data;
	}
	public static function total(){
		$data = Db::name('carousel')->field('count(id)')->find();
		return $data['count(id)'];
	}	
	public static function del($id){
		$res = Db::name('carousel')->where('id',$id)->delete();
		return $res;
	}
}
