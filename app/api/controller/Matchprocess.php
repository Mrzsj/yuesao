<?php
namespace app\api\controller;

use \think\Db;
use app\admin\model\User;

class Matchprocess
{
    public function get(){
        $data = Db::name('matchprocess')->field(['title','head_img','content'])->find();
        if(!empty($data)){
            $data['head_img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".$data['head_img'];
            return ['status'=>1,'data'=>$data];
        }else{
            return ['status'=>0,'data'=>$data];
        }
    }
}