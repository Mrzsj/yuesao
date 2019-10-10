<?php


namespace app\admin\model;


use think\Db;
use think\Model;

class Apply extends Model
{
    public function getList($number, $limit){
        $data = Db::name('apply')
            ->alias('a')
            ->join('user u', 'u.id = a.user_id')
            ->field('u.name, a.*')
            ->limit($number, $limit)
            ->order('create_time desc')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['start_time'] = date('Y-m-d H:i:s', $data[$k]['start_time']);
            $data[$k]['end_time'] = date('Y-m-d H:i:s', $data[$k]['end_time']);
            $data[$k]['create_time'] = date('Y-m-d H:i:s', $data[$k]['create_time']);
        }
        return $data;
    }

    public function search($number, $limit, $q){
        $data = Db::name('apply')
            ->alias('a')
            ->join('user u', 'u.id = a.user_id')
            ->field('u.name, a.*')
            ->whereLike('u.name', '%'.$q.'%')
            ->limit($number, $limit)
            ->select();
        foreach($data as $k => $v){
            $data[$k]['start_time'] = date('Y-m-d H:i:s', $data[$k]['start_time']);
            $data[$k]['end_time'] = date('Y-m-d H:i:s', $data[$k]['end_time']);
            $data[$k]['create_time'] = date('Y-m-d H:i:s', $data[$k]['create_time']);
        }
        return $data;
    }

    public function total(){
        $data = Db::name('apply')->field('count(id)')->find();
        return $data['count(id)'];
    }

}