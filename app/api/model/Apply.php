<?php


namespace app\api\model;


use think\Db;

class Apply
{
    public function add($matron_id, $ordersn, $type, $reason, $start_time, $end_time){
        $add = [
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