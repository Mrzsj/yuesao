<?php


namespace app\admin\controller;

use app\admin\model\Apply AS Apply_model;

class Apply extends Permissions
{
    public function index()
    {
        return $this->fetch();
    }

    //获取消息列表
    public function lists(){
        $page = input('page');
        $limit = input('limit');
        $q = input('name');
        if (empty($page) || !is_numeric($page)) {
            return ['status'=>0,'msg'=>'请输入正确的页码'];
        }
        if (empty($limit) || !is_numeric($limit)) {
            return ['status'=>0,'msg'=>'请输入正确的条数'];
        }
        $number = ($page - 1) * $limit;
        $Apply_model = new Apply_model();
        if (empty($q)){
            $list = $Apply_model->getlist($number, $limit);
        }else{
            $list = $Apply_model->search($number, $limit, $q);
        }
        $count = $Apply_model->total();
        showjson(['code' => 0,'count' => $count,'data' => $list]);
    }

}