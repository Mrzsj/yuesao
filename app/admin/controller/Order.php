<?php
namespace app\admin\controller;
use \think\Db;
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
        if(is_numeric($status) && $status != '9'){
            if(!empty($where)){
                $where .= " and status=".$status;
            }else{
                $where = "status=".$status;
            }
        }
        if(!empty($region) && is_numeric($region)){
            if(!empty($where)){
                 $where .= " and region=".$region;
            }else{
                $where = "region=".$region;
            }
        }
        $data = model('order')->getlist($number,$limit,$where,$name);
        $total = model('order')->total($where,$name);
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
    public function pay(){
        model('order')->status(1);
    }
    public function cancel(){
        model('order')->status(3);
    }
    public function complete(){
        model('order')->status(2);
    }
    public function commission(){
        $id = input('id');
		if (empty($id) || !is_numeric($id)) {
            msg(0,'请输入正确的id');
		}
		$res = Db::name('order')->where('id',$id)->find();
		if(empty($res) || $res['status'] != 2){
			msg(0,'订单必须处于待付款状态');
        }
        if($res['is_receive'] != 0){
			msg(0,'这笔订单已经发放过佣金,请勿重复发放');
        }
        $data = [
			'order_id'=>$res['id'],
			'ordersn'=>$res['ordersn'],
			'matron_id'=>$res['matron_id'],
			'days'=>$res['days'],
			'commission'=>$res['commission'],
			'create_time'=>time(),
			'update_time'=>time(),
        ];
        Db::startTrans();
        try {
            Db::name("order")->where('id',$id)->update(['update_time'=>time(),'is_receive'=>1]);
            Db::name("commission_log")->insert($data);
            Db::commit();
            msg(1,'操作成功');
        } catch (Exception $e) {
            Db::rollback();
            msg(0,'操作失败');
        }
    }
    public function refund(){
        $id = input('id');
        $is_agree = input('is_agree');
        $data = [
            'update_time'=>time(),
        ];
        if($is_agree){
            $data['status'] = 5;
        }else{
            $data['status'] = 1;
        }
        try {
            Db::name("order")->where('id',$id)->update($data);
            msg(1,'操作成功');
        } catch (Exception $e) {
            msg(0,'操作失败');
        }
    }
}