<?php


namespace app\api\controller;

use app\api\model\Apply AS Apply_model;

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
            $data = $Apply_model->add($user_id, $type, $reason, $start_time, $end_time);
            if ($data == 1) {
                showjson(['status' => 1, 'msg' => '申请成功']);
            } else {
                showjson(['status' => 0, 'msg' => '申请失败']);
            }
        }
    }
}