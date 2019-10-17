<?php


namespace app\api\controller;

use app\api\model\Information AS Information_model;
use \think\Db;

class Information
{
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
        $Information_model = new Information_model();
        $list = $Information_model->getList($number, $limit);
        if(!empty($list)){
            return ['status'=>1, 'data'=>$list];
        }else{
            return ['status'=>0, 'msg'=>'暂无最新消息'];
        }
    }

    public function detail(){
        $id = input('id');

        $Information_model = new Information_model();
        if (!empty($id) && is_numeric($id)){
            $data = $Information_model->detail($id);
        }else{
            showjson(['status' => 0,'msg' => 'id不合法']);
        }
        $data['content'] = ueditor_img_src($data['content']);
        if(!empty($data)){
            return ['status'=>1, 'data'=>$data];
        }else{
            return ['status'=>0, 'msg'=>'指定最新消息不存在'];
        }
    }
}