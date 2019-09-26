<?php
namespace app\admin\controller;

use \think\Db;
use app\admin\controller\Permissions;
use app\admin\model\User;
class Matron extends Permissions
{
    public function index(){
        return $this->fetch();
    }
    public function list(){
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
          showjson(['status'=>0,'msg'=>'请输入正确的页码']);
        }
        if (empty($limit) || !is_numeric($limit)) {
          showjson(['status'=>0,'msg'=>'请输入正确的条数']);
        }
        $number = ($page - 1) * $limit;
        if(!empty(input('name_mobile'))){
            $where = "mobile like '%".input('name_mobile')."%' or name like '%".input('name_mobile')."%'";
        }else{
            $where = '';
        }
        $data = User::matron_list($number,$limit,$where);
        $total = User::matron_count($where);
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
    public function status(){
        $status = input('status');
        $id = input('id');
        if(!($status == 1 || $status == 3)){
            showjson(['status'=>0,'msg'=>'请输入正确的状态码']);
        }
        if(empty($id)){
            showjson(['status'=>0,'msg'=>'id不合法']);
        }
        $data = User::user_get($id);
        if(!empty($data)){
            if($data['status'] == 1 || $data['status'] == 3){
                showjson(['status'=>0,'msg'=>'请勿重复操作']);
            }
        }
        Db::startTrans();
        try{
            User::matron_status($id,$status);
            if($status == 1){
                model('matron')->add($data['id']);
                Db::commit();
                showjson(['status'=>1,'msg'=>'已审核通过']);
            }else if($status == 3){
                Db::commit();
                showjson(['status'=>1,'msg'=>'已拒绝入驻']);
            }
        } catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            showjson(['status'=>0,'msg'=>'操作失败']);
        }
    }
    public function index2(){
        return $this->fetch();
    }
    public function matron_list(){
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
          showjson(['status'=>0,'msg'=>'请输入正确的页码']);
        }
        if (empty($limit) || !is_numeric($limit)) {
          showjson(['status'=>0,'msg'=>'请输入正确的条数']);
        }
        $number = ($page - 1) * $limit;
        $data = model('matron')->list($number,$limit);
        $total = model('matron')->count();
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
    public function matron_status(){
        $status = input('status');
        $id = input('id');
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请输入正确的id');
        }
        $id = intval($id);
        //前端传的布尔型  后端接收时是字符串的true false
        $status == 'true' ? $status = 1 : $status = 0;
        $res = Db::name('matron')->where('id',$id)->update(['status'=>$status,'update_time'=>time()]);
        $res ? msg(1,'修改成功') : msg(0,'修改失败');
    }
}
