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


namespace app\api\model;

use \think\Model;
use \think\Db;
class Carousel extends Model{
	public static function getlist(){
		$data = Db::name('carousel')->field(['id','img_path'])->order('sort asc')->limit(0,10)->select();
		foreach($data as $k => $v){
			$data[$k]['img_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$v['img_path']);
			unset($data[$k]['img_path']);
		}
		return $data;
	}
}
