<?php
namespace app\api\model;

use \think\Model;
use \think\Db;
class Matron extends Model{
    public function temp($data,$userid){
        $temp = serialize($data);
        $data = [
            'temp'=>$temp,
            'is_data_audit'=>2,
            'update_time'=>time()
        ];
        return Db::name('matron')->where('user_id',$userid)->update($data);
    }
    public function matron_get($userid){
        return Db::name('matron')->where('user_id',$userid)->find();
    }
}
