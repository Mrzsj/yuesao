<?php
namespace app\admin\model;

use \think\Model;
use \think\Db;
class Evaluate extends Model{
	public static function getlist($number,$limit,$where=''){
        $data = Db::name('evaluate')
        ->alias('e')
        ->field(['e.*','o.name','o.mobile','o.ordersn','u.name as u_name','u.mobile as u_mobile'])
        ->join('order o','o.id=e.order_id')
        ->join('matron m','m.id=o.matron_id')
        ->join('user u','u.id=m.user_id')
        ->order('e.id desc')
        ->where($where)
        ->limit($number,$limit)
        ->select();
		foreach($data as $k => $v){
			$data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
			$data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']);
        }
		return $data;
	}
	public static function total($where=''){
        $data = Db::name('evaluate')
        ->alias('e')
        ->field('count(e.id)')
        ->join('order o','o.id=e.order_id')
        ->join('matron m','m.id=o.matron_id')
        ->join('user u','u.id=m.user_id')
        ->order('e.id desc')
        ->where($where)->find();
		return $data['count(e.id)'];
    }
}
