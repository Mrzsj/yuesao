<?php
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
    public function list($number,$limit){
        $data = Db::name('matron')
        ->alias('m')
        ->field(['m.*','u.openid','u.nickname','u.name','u.mobile','u.avatar_url'])
        ->join('user u','u.id=m.user_id')
        ->limit($number,$limit)
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
    public function count(){
        $data = Db::name('matron')
        ->field(['count(id)'])
        ->find();
        return $data['count(id)'];
    }
}
