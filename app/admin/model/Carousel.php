<?php
// +----------------------------------------------------------------------
// | Tplay [ WE ONLY DO WHAT IS NECESSARY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://tplay.pengyichen.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 听雨 < 389625819@qq.com >
// +----------------------------------------------------------------------


namespace app\admin\model;

use \think\Model;
use \think\Db;
class Carousel extends Model{
	public static function getlist($number,$limit){
		$data = Db::name('carousel')->order('id desc')->limit($number,$limit)->select();
		foreach($data as $k => $v){
			$data[$k]['create_time'] = date('Y-m-d H:i:s',$data[$k]['create_time']);
			$data[$k]['update_time'] = date('Y-m-d H:i:s',$data[$k]['update_time']);
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
