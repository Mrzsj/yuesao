<?php


namespace app\admin\controller;


use app\admin\model\Agreement as Agreement_model;

class Agreement extends Permissions
{
    public function index(){
        $Agreement_model = new Agreement_model();
        $data = $Agreement_model->detail();
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function edit(){
        $content = input('content');

        $Agreement_model = new Agreement_model();
        $detail = $Agreement_model->detail();
        if (empty($detail)){
            $res = $Agreement_model->edit('', $content, $detail);
            if($res){
                showjson(['status'=>1,'msg'=>'添加成功']);
            }else{
                showjson(['status'=>0,'msg'=>'添加失败']);
            }
        }else{
            $res = $Agreement_model->edit($detail['id'], $content, $detail);
            if($res){
                showjson(['status'=>1,'msg'=>'修改成功']);
            }else{
                showjson(['status'=>0,'msg'=>'修改失败']);
            }
        }
    }

}