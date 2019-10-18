<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-19 08:56:04
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-18 10:56:55
 */
function getRandomChar($length){
    $str = null;
    $strPol = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $max = strlen($strPol) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }
    return $str;
}
function insert_token($userid){
    $token = getRandomChar(32);
    $token_time = config('token_time');
    if(!empty($userid) && is_numeric($userid)){
        think\Cache::set($token, $userid, $token_time);
        return ['status'=>1,'token'=>$token,'token_time'=>$token_time];
    }else{
        return ['status'=>0];
    }
}
function get_token(){
    $token = \think\Request::instance()->header('token');
    if(empty($token)){
        echo json_encode(['status'=>-1,'msg'=>'当前游客状态,请登录']);
        exit();
    }
    $userid = think\Cache::get($token);
    if(!empty($userid) && is_numeric($userid)){
        return $userid;
    }else{
        echo json_encode(['status'=>-1,'msg'=>'登录失效，请重新登陆']);
        exit();
    }
}
function order_status_where($status = 0){
    if($status == 0){
        return 'o.status=0';
    }else if($status == 1){
        return 'o.status=1';
    }else if($status == 2){
        return 'o.status=2';
    }else if($status == 4){
        return '(o.status=4 or o.status=5)';
    }
}