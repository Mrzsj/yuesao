<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-25 15:06:37
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-09-25 15:06:37
 */
namespace app\api\controller;

class Upload{
    public function img(){
        // 获取表单上传文件 例如上传了001.jpg
        if (!empty($_FILES['file'])) {
            $suffix_name = strrchr($_FILES['file']['name'],'.');
            $suffix_name = strtolower($suffix_name);
            if (!($suffix_name == '.png' || $suffix_name == '.jpeg' || $suffix_name == '.jpg')) {
                msg(0,'上传类型不合法');
            }
            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $path = DS.'uploads'.DS.$info->getSaveName();
                //打开原图 按照原图的比例生成一个最大为600*600的缩略图替换原图
                $image = \think\Image::open(ROOT_PATH . 'public' . $path);
                //判断上传类型压缩
                if(input('type') == 'carousel'){
                    $image->thumb(800, 800)->save(ROOT_PATH . 'public' . $path);
                }else{
                    $image->thumb(500, 500)->save(ROOT_PATH . 'public' . $path);
                }
                showjson(['status'=>1,'path'=>$path,'msg'=>'上传成功']);
            }else{
                // 上传失败获取错误信息
                msg(0,'上传失败');
            }
        }else{
            msg(0,'file字段不能为空');
        }
    }
}