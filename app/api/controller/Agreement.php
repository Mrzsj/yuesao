<?php


namespace app\api\controller;


use app\api\model\Agreement as Agreement_model;

class Agreement
{
    public function detail(){
        $Agreement_model = new Agreement_model();
        $data = $Agreement_model->detail();
        if(!empty($data)){
            return ['status'=>1,'data'=>$data,'msg'=>'用户协议获取成功'];
        }else{
            return ['status'=>0,'data'=>[],'msg'=>'用户协议不存在'];
        }
    }
}