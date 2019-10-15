<?php


namespace app\api\model;


use think\Model;
use think\Db;

class Information extends Model
{
    public function getList($number, $limit){
        $list = Db::name('information')->field(['id', 'img', 'title', 'content'])->order('sort asc')->limit($number, $limit)->select();
        foreach($list as $k => $v){
            $list[$k]['img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$v['img']);
        }
        return $list;
    }
    public function detail($id){
        $data = Db::name('information')->field(['img', 'title', 'content'])->where('id', $id)->find();
        $data['img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$data['img']);
        return $data;
    }
}