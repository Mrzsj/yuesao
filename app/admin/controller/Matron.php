<?php
namespace app\admin\controller;

use \think\Db;
use app\admin\controller\Permissions;
use app\admin\model\User;
use \think\Validate;
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
        $where = '';
        $name_mobile = input('name_mobile');
        $region = input('region');
        $year = input('year');
        $households = input('households');
        $age = input('age');
        if(!empty($region) && is_numeric($region)){
            $region = intval($region);
            $where .= 'm.region='.$region;
        }
        if($year){
            $year = explode('-',$year);
            if(count($year) == 2){
                if(!empty($where)){
                    $where .= ' and m.year between '.$year[0]." and ".$year[1];
                }else{
                    $where .= 'm.year between '.$year[0]." and ".$year[1];
                }
            }
        }
        if($households){
            $households = explode('-',$households);
            if(count($households) == 2){
                if(!empty($where)){
                    $where .= ' and m.households between '.$households[0]." and ".$households[1];
                }else{
                    $where .= 'm.households between '.$households[0]." and ".$households[1];
                }
            }
        }
        if($age){
            $age = explode('-',$age);
            if(count($age) == 2){
                if(!empty($where)){
                    $where .= ' and m.age between '.$age[0]." and ".$age[1];
                }else{
                    $where .= 'm.age between '.$age[0]." and ".$age[1];
                }
            }
        }
        if($name_mobile){
            if(!empty($where)){
                $where = $where . " and (u.mobile like '%".input('name_mobile')."%' or u.name like '%".input('name_mobile')."%')";
            }else{
                $where = $where . "u.mobile like '%".input('name_mobile')."%' or u.name like '%".input('name_mobile')."%'";
            }
        }
        //echo $where;exit();
        $data = model('matron')->list($number,$limit,$where);
        $total = model('matron')->count($where);
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
    public function matron_is_home_page(){
        $is_home_page = input('is_home_page');
        $id = input('id');
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请输入正确的id');
        }
        $id = intval($id);
        //前端传的布尔型  后端接收时是字符串的true false
        $is_home_page == 'true' ? $is_home_page = 1 : $is_home_page = 0;
        $res = Db::name('matron')->where('id',$id)->update(['is_home_page'=>$is_home_page,'update_time'=>time()]);
        $res ? msg(1,'修改成功') : msg(0,'修改失败');
    }
    public function data_status(){
        $id = input('id');
        $status = input('status');
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请输入正确的id');
        }
        if (empty($id) || !is_numeric($status)) {
            msg(0,'请输入正确的status');
        }
        if(!($status == 1 || $status == 3)){
            msg(0,'请输入正确的status');
        }
        Db::startTrans();
        try{
            $res = Db::name('matron')->where('id',$id)->update(['is_data_audit'=>$status,'update_time'=>time()]);
            if($status == 1){
                $matron = model('matron')->getone($id);
                $matron_data = [
                    'head_img'=>$matron['temp']['head_img'],
                    'address'=>$matron['temp']['address'],
                    'year'=>$matron['temp']['year'],
                    'households'=>$matron['temp']['households']
                    ];
                $user_data = [
                    'name'=>$matron['temp']['name'],
                    'mobile'=>$matron['temp']['mobile'],
                    ];
                Db::name('matron')->where('id',$id)->update($matron_data);
                Db::name('user')->where('id',$matron['user_id'])->update($user_data);
            }
            Db::commit();
            msg(1,'操作成功');
        }catch (Exception $e) {
            // 回滚事务
            Db::rollback();
            msg(0,'操作失败');
        }
    }
    public function edit(){
        $id = input('id');
        $matron = model('matron')->getone($id);
        $this->assign('data',$matron);
        return $this->fetch();
    }
    public function post(){
        $data = input('post.');
        $rule = [
            'address'  => 'require',
            'year' => 'require|number',
            'households'=>'require|number',
            'age'=>'require|number',
            'star'=>'require|in:2,3,4,5,6,7,8',
            'introduce'  => 'require',
            'label'  => 'require',
            'region'  => 'require|in:1,2',
            'native_place'  => 'require',
            'price'  => 'require|number',
            'id'  => 'require|number',
        ];
        $msg = [
            'address.require' => '地址不能为空',
            'year.require'     => '年龄不能为空',
            'year.number'     => '请输入正确的年龄',
            'households.require'   => '服务家庭数不能为空',
            'households.number'  => '请输入正确的服务家庭数',
            'age.require'        => '年龄不能为空',
            'age.number' => '请输入正确的年龄',
            'star.require' => '月嫂星级不能为空',
            'star.in' => '请输入正确的月嫂星级',
            'introduce.require' => '月嫂介绍不能为空',
            'label.require' => '月嫂标签不能为空',
            'region.require' => '所属地区不能为空',
            'region.in' => '请输入正确的地区',
            'native_place.require' => '月嫂籍贯不能为空',
            'price.require'        => '价格不能为空',
            'price.number' => '请输入正确的价格',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($data)) {
            msg(0,$validate->getError());
        }
        $data['year'] = intval($data['year']);
        $data['households'] = intval($data['households']);
        $data['age'] = intval($data['age']);
        $data['id'] = intval($data['id']);
        $data['price'] = number_format($data['price'],2);
        $id = $data['id'];
        unset($data['id']);
        try {
            Db::name('matron')->where('id',$id)->update($data);
            msg(1,'提交成功');
        } catch (Exception $e) {
            msg(0,'提交失败');
        }
    }
}
