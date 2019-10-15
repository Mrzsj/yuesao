<?php


namespace app\api\controller;

use app\api\model\Apply AS Apply_model;
use think\Db;

class Apply
{
    //提交申请
    public function add(){
        $user_id = get_token();
        $type = input('type');
        $start_time = input('start_time');
        $end_time = input('end_time');
        $reason = input('reason');
        $Apply_model = new Apply_model();
        if (!empty($type) && is_numeric($type)){
            $res = Db::name('matron')->where('user_id', $user_id)->find();
            $list = Db::name('order')->where('matron_id', $res['id'])->select();
            if (empty($list)){
                $data = $Apply_model->add($user_id, $res['id'], '', $type, $reason, $start_time, $end_time);
                if ($data == 1) {
                    showjson(['status' => 1, 'msg' => '申请成功']);
                } else {
                    showjson(['status' => 0, 'msg' => '申请失败']);
                }
            }
            foreach ($list as $k => $v){
                if (strtotime($start_time) <= strtotime($end_time)){
                    $data = $Apply_model->add($user_id, $list[$k]['matron_id'], $list[$k]['ordersn'], $type, $reason, $start_time, $end_time);
                    if ($data == 1) {
                        showjson(['status' => 1, 'msg' => '申请成功']);
                    } else {
                        showjson(['status' => 0, 'msg' => '申请失败']);
                    }
                }else{
                    showjson(['status' => 0,'msg' => '开始时间不可大于结束时间']);
                }
            }
        }else{
            showjson(['status' => 0,'msg' => 'type不合法']);
        }
    }
}