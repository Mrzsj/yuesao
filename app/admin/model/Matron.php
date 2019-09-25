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
}
