<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-25 09:57:04
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-15 17:05:29
 */
namespace app\admin\model;

use \think\Model;
use \think\Db;
class Matron extends Model{
	public function add($userid = 0){
        if(!empty($userid)){
            $data = [
                'user_id'=>$userid,
                'status'=>0,
                'region'=>1,
                'create_time'=>time(),
                'update_time'=>time()
            ];
            $res = Db::name('matron')->insert($data);
            if($res){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
    public function list($number,$limit,$where){
        $data = Db::name('matron')        
        ->alias('m')
        ->field(['m.*','u.openid','u.nickname','u.name','u.mobile','u.avatar_url','u.id as u_id'])
        ->join('user u','u.id=m.user_id')
        ->where($where)
        ->limit($number,$limit)
        ->order('u.id desc')
        ->select();
        foreach($data as $k => $v){
            if(!empty($v['head_img'])){
                $data[$k]['avatar_url'] = $v['head_img'];
            }
            $data[$k]['temp'] = unserialize($v['temp']);
            $data[$k]['create_time'] = date('Y-m-d H:i:s',$v['create_time']);
            $data[$k]['update_time'] = date('Y-m-d H:i:s',$v['update_time']); 
        }
        return $data;
    }
    public function count($where){
        $data = Db::name('matron')
        ->alias('m')
        ->field(['count(m.id)'])
        ->join('user u','u.id=m.user_id')
        ->where($where)
        ->find();
        return $data['count(m.id)'];
    }
    public function getone($id){
        $data = Db::name('matron')
        ->alias('m')
        ->field(['m.*','u.avatar_url'])
        ->join('user u','u.id=m.user_id')
        ->where('m.id',$id)
        ->find();
        $data['temp'] = unserialize($data['temp']);
        return $data;
    }
}
