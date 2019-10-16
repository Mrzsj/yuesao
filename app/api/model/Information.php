<?php


namespace app\api\model;


use think\Model;
use think\Db;

class Information extends Model
{
    public function getList($number, $limit){
        $list = Db::name('information')->field(['id', 'img', 'title', 'content','text','create_time'])->order('sort asc')->limit($number, $limit)->select();
        foreach($list as $k => $v){
            $list[$k]['create_time'] = date('Y-m-d', $list[$k]['create_time']);
            $list[$k]['img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$v['img']);
        }
        return $list;
    }
    public function detail($id){
        $data = Db::name('information')->field(['img', 'title', 'content', 'create_time'])->where('id', $id)->find();
        $data['create_time'] = date('Y-m-d', $data['create_time']);
        $data['img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$data['img']);
        return $data;
    }
}