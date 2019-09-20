<?php
namespace app\admin\controller;

class Upload extends Permissions{
    public function img(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['size'=>51200000 ,'ext'=>'jpg,jpeg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $path = DS.'uploads'.DS.$info->getSaveName();
            showjson(['status'=>1,'path'=>$path,'msg'=>'上传成功']);
        }else{
            // 上传失败获取错误信息
            showjson(['status'=>0,'msg'=>'上传失败']);
        }
    }
}