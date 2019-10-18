<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-20 15:08:11
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-18 11:11:33
 */
namespace app\api\model;

use \think\Model;
use \think\Db;
class Carousel extends Model{
	public static function getlist(){
		$data = Db::name('carousel')->field(['id','img_path'])->order('sort desc')->limit(0,10)->select();
		foreach($data as $k => $v){
			$data[$k]['img_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$v['img_path']);
			unset($data[$k]['img_path']);
		}
		return $data;
	}
}
