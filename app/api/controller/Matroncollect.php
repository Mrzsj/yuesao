<?php


namespace app\api\controller;

use app\api\model\Matroncollect AS Mcollect_model;

class Matroncollect
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
        $Mcollect_model = new Mcollect_model();
        $list = $Mcollect_model->getList($number, $limit);
        if(!empty($list)){
            return ['status'=>1, 'data'=>$list];
        }else{
            return ['status'=>0, 'msg'=>'暂未收藏月嫂'];
        }
    }

    public function add(){
        $id = input('id');
        $Mcollect_model = new Mcollect_model();
        if (!empty($id) && is_numeric($id)) {
            $data = $Mcollect_model->add($id);
            if ($data == 1) {
                showjson(['status' => 1, 'msg' => '收藏成功']);
            } else {
                showjson(['status' => 0, 'msg' => '收藏失败']);
            }
        }else{
            showjson(['status' => 0,'msg' => 'id不合法']);
        }
    }

    public function delete(){
        $id = input('id');
        $Mcollect_model = new Mcollect_model();
        if (!empty($id) && is_numeric($id)) {
            $res = $Mcollect_model->del($id);
            if ($res == 1) {
                showjson(['status' => 1,'msg' => '删除成功']);
            }else{
                showjson(['status' => 0,'msg' => '删除失败']);
            }
        }else{
            showjson(['status' => 0,'msg' => 'id不合法']);
        }
    }
}