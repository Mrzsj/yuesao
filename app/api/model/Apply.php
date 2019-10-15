<?php


namespace app\api\model;


use think\Db;

class Apply
{
    public function add($user_id, $matron_id, $ordersn, $type, $reason, $start_time, $end_time){
        $add = [
            'user_id' => $user_id,
            'matron_id' => $matron_id,
            'ordersn' => $ordersn,
            'type' => $type,
            'reason' => $reason,
            'start_time' => strtotime($start_time),
            'end_time' => strtotime($end_time),
            'create_time' => time()
        ];
        $data = Db::name('apply')->insert($add);
        return $data;
    }
}