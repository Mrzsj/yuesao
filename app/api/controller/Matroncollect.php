<?php


namespace app\api\controller;

use app\api\model\Matroncollect AS Mcollect_model;
use think\Db;

class Matroncollect
{
    public function lists(){
        $page = input('page');
        $limit = input('limit');
        $user_id = get_token();
        if (empty($page) || !is_numeric($page)) {
            return ['status'=>0,'msg'=>'请输入正确的页码'];
        }
        if (empty($limit) || !is_numeric($limit)) {
            return ['status'=>0,'msg'=>'请输入正确的条数'];
        }
        $number = ($page - 1) * $limit;
        $Mcollect_model = new Mcollect_model();
        $list = $Mcollect_model->getList($number, $limit, $user_id);
        if(!empty($list)){
            return ['status'=>1, 'data'=>$list];
        }else{
            return ['status'=>0, 'msg'=>'暂未收藏月嫂'];
        }
    }

    public function add(){
        $user_id = get_token();
        $matron_id = input('matron_id');
        $Mcollect_model = new Mcollect_model();
        $res = Db::name('matroncollect')->where('matron_id', $matron_id)->where('user_id', $user_id)->find();
        if (!empty($matron_id) && is_numeric($matron_id)){
            if (empty($res)) {
                $data = $Mcollect_model->add($matron_id, $user_id);
                if ($data == 1) {
                    showjson(['status' => 1, 'msg' => '收藏成功']);
                } else {
                    showjson(['status' => 0, 'msg' => '收藏失败']);
                }
            }else{
                showjson(['status' => 0, 'msg' => '该用户已收藏该月嫂，请勿重复操作']);
            }
        }else{
            showjson(['status' => 0,'msg' => 'id不合法']);
        }


    }

    public function delete(){
        $matron_id = input('matron_id');
        $user_id = get_token();
        $Mcollect_model = new Mcollect_model();
        $res = Db::name('matroncollect')->where('matron_id', $matron_id)->where('user_id', $user_id)->find();
        if (!empty($matron_id) && is_numeric($matron_id)){
            if (!empty($res)) {
                $res = $Mcollect_model->del($matron_id);
                if ($res == 1) {
                    showjson(['status' => 1,'msg' => '删除成功']);
                }else{
                    showjson(['status' => 0,'msg' => '删除失败']);
                }
            }else{
                showjson(['status' => 0,'msg' => '该用户没有收藏该月嫂，请重新操作']);
            }
        }else{
            showjson(['status' => 0,'msg' => 'id不合法']);
        }
    }
}