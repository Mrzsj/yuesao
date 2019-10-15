<?php


namespace app\api\model;


use think\Db;

class Apply
{
    public function add($user_id, $type, $reason, $start_time, $end_time){
        //查询该月嫂的所有订单
        $where = [
            'user_id' => $user_id,
            'status' => 1
        ];
        $list = Db::name('order')->where($where)->select();
        $data = 0;
        foreach ($list as $k => $v){
            if ((strtotime($start_time) >= $list[$k]['start_time']) && (strtotime($start_time) <= $list[$k]['end_time']) && strtotime($start_time) <= strtotime($end_time)){
                $add = [
                    'user_id' => $list[$k]['user_id'],
                    'matron_id' => $list[$k]['matron_id'],
                    'ordersn' => $list[$k]['ordersn'],
                    'type' => $type,
                    'reason' => $reason,
                    'start_time' => strtotime($start_time),
                    'end_time' => strtotime($end_time),
                    'create_time' => time()
                ];
                $data = Db::name('apply')->insert($add);
            }
        }
        return $data;
    }
}