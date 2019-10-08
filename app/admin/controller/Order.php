<?php
namespace app\admin\controller;

class Order extends Permissions{
    public function index(){
        return $this->fetch();
    }
    public function list(){
        $page = input('page');
        $limit = input('limit');
        $name = input('name');
        $start_time = input('start_time');
        $status = input('status');
        $region = input('region');
        if (empty($page) || !is_numeric($page)) {
            msg(0,'请输入正确的页码');
        }
        if (empty($limit) || !is_numeric($limit)) {
            msg(0,'请输入正确的条数');
        }
        $number = ($page - 1) * $limit;
        $where = '';
        if(!empty($start_time)){
            $time_arr = explode(' - ',$start_time);
            if(count($time_arr) == 2 && strtotime($time_arr[0]) && strtotime($time_arr[1])){
                $where .= 'create_time between '. strtotime($time_arr[0]) . ' and ' . strtotime($time_arr[1]);
            }
        }
        if(!empty($where)){
            if(is_numeric($status) && $status != '9'){
                $where .= " and status=".$status;
            }
        }else{
            if(is_numeric($status) && $status != '9'){
                $where = "status=".$status;
            }
        }
        if(!empty($where)){
            if(is_numeric($region)){
                $where .= " and region=".$region;
            }
        }else{
            if(is_numeric($region)){
                $where = "region=".$region;
            }
        }
        $data = model('order')->getlist($number,$limit,$where,$name);
        $total = model('order')->total($where,$name);
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
}