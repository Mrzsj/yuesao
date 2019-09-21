<?php

namespace app\admin\controller;

use app\admin\controller\Permissions,
    app\admin\model\Information AS Information_model;
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
        $q = input('title');
        if (empty($page) || !is_numeric($page)) {
            return ['status'=>0,'msg'=>'请输入正确的页码'];
        }
        if (empty($limit) || !is_numeric($limit)) {
            return ['status'=>0,'msg'=>'请输入正确的条数'];
        }
        $number = ($page - 1) * $limit;
        $Information_model = new Information_model();
        if (empty($q)){
            $list = $Information_model->getlist($number, $limit);
        }else{
            $list = $Information_model->search($number, $limit, $q);
        }
        $count = $Information_model->total();
        jsondecode(['code' => 0,'count' => $count,'data' => $list]);
    }

    //编辑消息
    public function edit(){
        $id = input('id');
        $sort = input('sort');
        $img = input('head_img');
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

        $Information_model = new Information_model();
        if (!empty($id) && is_numeric($id)) {  //修改
            $res = $Information_model->edit($id, $sort, $img, $title, $content);
            if ($res == 1) {  //返回值是影响行数
                jsondecode(['status'=>1,'msg'=>'修改成功']);
            }else{
                jsondecode(['status'=>0,'msg'=>'修改失败']);
            }
        }else{  //添加
            $res = $Information_model->edit('', $sort, $img, $title, $content);
            if ($res == 1) {
                jsondecode(['status'=>1,'msg'=>'添加成功']);
            }else{
                jsondecode(['status'=>0,'msg'=>'添加失败']);
            }
        }
    }

    //删除消息
    public function delete(){
        $id = input('id');
        $Information_model = new Information_model();
        if (!empty($id) && is_numeric($id)) {
            $res = $Information_model->del($id);
            if ($res == 1) {
                jsondecode(['status' => 1,'msg' => '删除成功']);
            }else{
                jsondecode(['status' => 0,'msg' => '删除失败']);
            }
        }else{
            jsondecode(['status' => 0,'msg' => 'id不合法']);
        }
    }
}
