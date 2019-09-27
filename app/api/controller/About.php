<?php


namespace app\api\controller;


use app\api\model\About as About_model;

class About
{
    public function detail(){
        $About_model = new About_model();
        $data = $About_model->detail();
        $data['content'] = ueditor_img_src($data['content']);
        if(!empty($data)){
            return ['status'=>1,'data'=>$data];
        }else{
            return ['status'=>0,'data'=>[]];
        }
    }
}