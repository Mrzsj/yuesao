<?php


namespace app\api\model;


use think\Model;
use think\Db;

class Information extends Model
{
    public function getList($number, $limit){
        $list = Db::name('information')->field(['img', 'title', 'content'])->order('sort asc')->limit($number, $limit)->select();
        foreach($list as $k => $v){
            $data[$k]['img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$v['img']);
        }
        if(!empty($list)){
            return ['status'=>1, 'data'=>$list, 'msg'=>'获取消息成功'];
        }else{
            return ['status'=>0, 'data'=>[], 'msg'=>'暂无消息'];
        }
    }

    public function detail($id){
        $data = Db::name('information')->field(['img', 'title', 'content'])->where('id', $id)->find();
        $data['img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$data['img']);
        if(!empty($data)){
            return ['status'=>1, 'data'=>$data, 'msg'=>'获取最新消息成功'];
        }else{
            return ['status'=>0, 'data'=>[], 'msg'=>'暂无最新消息'];
        }
    }
}