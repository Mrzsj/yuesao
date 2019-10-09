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
    public function home_page_list($number,$limit,$region){
        return Db::name('matron')
        ->alias('m')
        ->field(['m.id','m.star','m.introduce','m.head_img','u.name','u.avatar_url'])
        ->join('user u','u.id=m.user_id')
        ->where('m.status','1')
        ->where('m.is_home_page','1')
        ->where('m.region',$region)
        ->limit($number,$limit)
        ->order('u.id desc')
        ->select();
    }
    public function list($number,$limit,$region,$where='',$order_by){
        return Db::name('matron')
        ->alias('m')
        ->field(['m.id','m.star','m.introduce','m.head_img','u.name','u.avatar_url','m.age','m.price','m.native_place','m.year'])
        ->join('user u','u.id=m.user_id')
        ->where($where)
        ->where('m.status','1')
        ->where('m.region',$region)
        ->limit($number,$limit)
        ->order($order_by)
        ->select();
    }
    public function detail($id){
        return Db::name('matron')
        ->alias('m')
        ->field(['m.id','m.star','m.introduce','m.head_img','u.name','u.avatar_url','m.age','m.price','m.native_place','m.year','m.label','m.status','m.households','m.nation'])
        ->join('user u','u.id=m.user_id')
        ->where('m.id',$id)
        ->order('u.id desc')
        ->find();
    }
}
