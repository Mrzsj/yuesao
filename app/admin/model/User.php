<?php
namespace app\admin\model;

use \think\Model;
use \think\Db;
class User extends Model{
    public static function matron_list($number,$limit,$where = ''){
        $data = Db::name('user')
        ->field(['id','nickname','openid','avatar_url','matron_create_time','matron_update_time','name','mobile','status'])
        ->where('status','<>','0')
        ->where($where)
        ->limit($number,$limit)
        ->select();
		foreach($data as $k => $v){
            $data[$k]['matron_create_time'] = date('Y-m-d H:i:s',$v['matron_create_time']);
            if(!empty($v['matron_update_time'])){
                $data[$k]['matron_update_time'] = date('Y-m-d H:i:s',$v['matron_update_time']);
            }
		}
        return $data;
    }
    public static function matron_count($where = ''){
        $data = Db::name('user')->field('count(id)')->where('status','<>','0')->where($where)->find();
        return $data['count(id)'];
    }
    public static function matron_status($id,$status){
        $data = [
            'status'=>$status,
            'matron_update_time'=>time(),
        ];
        if($status == 1){
            $data['type'] = 2;
        }
        $res = Db::name('user')->where('id',$id)->update($data);
        return $res;
    }
    public static function user_get($id){
        $data = Db::name('user')->where('id',$id)->find();
        return $data;
    }
}
