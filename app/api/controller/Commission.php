<?php
namespace app\api\controller;

use \think\Db;

class Commission
{
    public function list(){
        $user_id = get_token();
        $matron = Db::name('matron')->field(['id'])->where('user_id',$user_id)->find();
        if(!$matron){
            msg(0,'该用户不存在');
        }
        $data = Db::name('commission_log')->field(['ordersn','commission','days','create_time'])->where('matron_id',$matron['id'])->order('id desc')->select();
        if(!$data){
            return ['status'=>0,'data'=>[]];
        }
        foreach($data as $k => $v){
            $data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
        }
        return ['status'=>1,'data'=>$data];
    }
}