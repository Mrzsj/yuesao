<?php

namespace app\admin\controller;

use app\admin\controller\Permissions;
use \think\Db;
class Information extends Permissions
{
    public function index()
    {
    	return $this->fetch();
    }

    //获取消息列表
    public function lists(){
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
            return ['status'=>0,'msg'=>'请输入正确的页码'];
        }
        if (empty($limit) || !is_numeric($limit)) {
            return ['status'=>0,'msg'=>'请输入正确的条数'];
        }
        $number = ($page - 1) * $limit;
        $arr = Db::name('information')->order('id desc')->limit($number,$limit)->select();
        foreach ($arr as $k => $v) {
            $arr[$k]['create_time'] = date('Y-m-d H:i:s',$arr[$k]['create_time']);
            $arr[$k]['update_time'] = date('Y-m-d H:i:s',$arr[$k]['update_time']);
        }
        jsondecode(['data' => $arr]);
    }

    //获取消息详情
    public function detail(){
        $id = input('id');
        if (empty($id) || !is_numeric($id)) {
            return ['status'=>0,'msg'=>'请输入正确的id格式'];
        }
        $arr = Db::name('information')->where('id', $id)->find();
        $arr['create_time'] = date('Y-m-d H:i:s',$arr['create_time']);
        $arr['update_time'] = date('Y-m-d H:i:s',$arr['update_time']);

        jsondecode(['data' => $arr]);
    }

    //编辑消息
    public function edit(){
        $img = input('img');
        $title = input('title');
        $content = input('content');
        if (empty($img)) {
            return ['status'=>0,'msg'=>'请上传图片'];
        }
        if (empty($title)) {
            return ['status'=>0,'msg'=>'请输入消息名称'];
        }
        if (empty($content)) {
            return ['status'=>0,'msg'=>'请输入消息内容'];
        }

        $id = input('id');

        if (!empty($id) && is_numeric($id)) {  //修改
            $update = [
                'img' => $img,
                'title' => $title,
                'content' => $content,
                'update_time'=>time()
            ];
            $res = Db::name('information')->where('id', $id)->update($update);
            if (jsondecode($res) == 1) {  //返回值是影响行数
                return ['status'=>1,'msg'=>'修改成功'];
            }else{
                return ['status'=>0,'msg'=>'修改失败'];
            }
        }else{  //添加
            $insert = [
                'img' => $img,
                'title' => $title,
                'content' => $content,
                'create_time' => time(),
                'update_time' => time()
            ];
            $res = Db::name('information')->insert($insert);
            if (jsondecode($res) == 1) {
                return ['status'=>1,'msg'=>'添加成功'];
            }else{
                return ['status'=>0,'msg'=>'添加失败'];
            }
        }
    }

    //删除消息
    public function delete(){
        $id = input('id');
        if (!empty($id) && is_numeric($id)) {
            $res = Db::name('information')->where('id',$id)->delete();
            if (jsondecode($res) == 1) {
                return ['status' => 1,'msg' => '删除成功'];
            }else{
                return ['status' => 0,'msg' => '删除失败'];
            }
        }else{
            return ['status' => 0,'msg' => 'id不合法'];
        }
    }
}
