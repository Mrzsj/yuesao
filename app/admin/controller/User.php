<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-10-15 16:21:07
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-15 17:04:34
 */
namespace app\admin\controller;

use think\Db;

class User extends Permissions
{
    public function index(){
        return $this->fetch();
    }

    public function lists(){
        $page = input('page');
        $limit = input('limit');
        $nickname = input('nickname');
        if (empty($page) || !is_numeric($page)) {
            showjson(['status'=>0,'msg'=>'请输入正确的页码']);
        }
        if (empty($limit) || !is_numeric($limit)) {
            showjson(['status'=>0,'msg'=>'请输入正确的条数']);
        }
        $number = ($page - 1) * $limit;
        if (empty($nickname)){
            $list = Db::name('user')->field('id, openid, nickname, avatar_url, type, create_time')->order('create_time desc')->limit($number, $limit)->select();
        }else{
            $list = Db::name('user')->whereLike('nickname', '%'.$nickname.'%')->field('id, openid, nickname, avatar_url, type, create_time')->order('create_time desc')->limit($number, $limit)->select();
        }
        foreach($list as $k => $v){
            $list[$k]['create_time'] = date('Y-m-d H:i:s', $list[$k]['create_time']);
        }
        $data = Db::name('information')->field('count(id)')->find();
        $count = $data['count(id)'];
        showjson(['code' => 0,'count' => $count,'data' => $list]);
    }

}