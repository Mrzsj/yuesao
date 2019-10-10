<?php
namespace app\admin\controller;

use \think\Db;

class Commission extends Permissions
{
    public function setting(){
        return $this->fetch();
    }
    public function index(){
        return $this->fetch();
    }
    public function list(){
        $page = input('page');
        $limit = input('limit');
        $ordersn = input('ordersn');
        if (empty($page) || !is_numeric($page)) {
            msg(0,'请输入正确的页码');
        }
        if (empty($limit) || !is_numeric($limit)) {
            msg(0,'请输入正确的条数');
        }
        $number = ($page - 1) * $limit;
        $where = '';
        if($ordersn){
            $where .= "cl.ordersn='".$ordersn."'";
        }
        $data = Db::name('commission_log')
        ->alias('cl')
        ->field(['cl.*','o.name as o_name','o.mobile as o_mobile','u.name as u_name'])
        ->join('order o','o.id=cl.order_id')
        ->join('matron m','m.id=o.matron_id')
        ->join('user u','u.id=m.user_id')
        ->where($where)
        ->limit($number,$limit)
        ->order('cl.id desc')
        ->select();
        //var_dump($data);exit();
        $total = Db::name('commission_log')->field(['count(id)'])->limit($number,$limit)->find();
        if($total){
            $total = $total['count(id)'];
        }else{
            $total = 0;
        }
        foreach($data as $k =>$v){
            $data[$k]['create_time'] = date("Y-m-d H:i:s",$v['create_time']);
        }
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
    public function setting_edit(){
        $post = input('post.');
        if(isset($post['star']) && count($post['star']) == 7){
            $star = $post['star'];
        }else{
            msg(0,'参数错误');
        }
        if(isset($star[2]) && isset($star[3]) && isset($star[4]) && isset($star[5]) && isset($star[6]) && isset($star[7]) && isset($star[8])){
            $success = 0;
            $fail = 0;
            foreach($star as $k => $v){
                if(!is_numeric($v)){
                    msg(0,'输入值必须为数字');
                }
                $v = intval($v);
                if(!($v>=0 && $v<=100)){
                    msg(0,'输入值必须为0到100的整数');
                }
                $res = Db::name('commission_setting')->where('star',$k)->find();
                if(!empty($res)){
                    Db::name('commission_setting')->where('star',$k)->update(['proportion'=>$v]) ? $success++ : $fail++;
                }else{
                    Db::name('commission_setting')->insert(['star'=>$k,'proportion'=>$v]) ? $success++ : $fail++;
                }
            }
            msg(1,"成功修改了$success 条");
        }else{
            msg(0,'参数不完整');
        }
    }
}