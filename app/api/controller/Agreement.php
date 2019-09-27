<?php


namespace app\api\controller;


use app\api\model\Agreement as Agreement_model;

class Agreement
{
    public function detail(){
        $Agreement_model = new Agreement_model();
        $data = $Agreement_model->detail();
        $data['content'] = ueditor_img_src($data['content']);
        if(!empty($data)){
            return ['status'=>1,'data'=>$data];
        }else{
            return ['status'=>0,'data'=>[]];
        }
    }
}