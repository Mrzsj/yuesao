<?php


namespace app\admin\controller;

use app\admin\model\About AS About_model;
use think\Db;

class About extends Permissions
{
    public function index(){
        $About_model = new About_model();
        $data = $About_model->detail();
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function edit(){
        $content = input('content');

        $About_model = new About_model();
        $detail = $About_model->detail();
        if (empty($detail)){
            $res = $About_model->edit('', $content, $detail);
            if($res){
                showjson(['status'=>1,'msg'=>'添加成功']);
            }else{
                showjson(['status'=>0,'msg'=>'添加失败']);
            }
        }else{
            $res = $About_model->edit($detail['id'], $content, $detail);
            if($res){
                showjson(['status'=>1,'msg'=>'修改成功']);
            }else{
                showjson(['status'=>0,'msg'=>'修改失败']);
            }
        }
    }
}