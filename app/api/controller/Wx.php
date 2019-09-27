<?php
namespace app\api\controller;
use \think\Db;
class Wx
{
    public function login(){
        $code = input('code');
        if(empty($code)){
            msg(0,'code不能为空');
        }
 		$param['appid'] = 'wxcd417936b51ed32a';    //小程序id
 		$param['secret'] = '43f4fa48efdf86e43a4a0b093e28189c';    //小程序密钥
 		$param['js_code'] = define_str_replace($code);
 		$param['grant_type'] = 'authorization_code';
 		$http_key = httpCurl('https://api.weixin.qq.com/sns/jscode2session', $param, 'GET');
        $session_key = json_decode($http_key,true);
        if (!empty($session_key['session_key'])) {
            return ['status'=>1,'data'=>$session_key];
        }else{
            return ['status'=>0,'data'=>[],'msg'=>'获取session_key失败'];
        }
    }
    public function decrypt(){
        $session_key = input('session_key');
        $encrypteData = input('encrypteData');
        $iv = input('iv');
        if(empty($session_key)){
            msg(0,'session_key不能为空');
        }
        if(empty($encrypteData)){
            msg(0,'encrypteData不能为空');
        }
        if(empty($iv)){
            msg(0,'iv不能为空');
        }
        $param['appid'] = 'wxcd417936b51ed32a';    //小程序id
        $appid = $param['appid'];
        $encrypteData = urldecode($encrypteData);
        $encrypteData = define_str_replace($encrypteData);
        $iv = define_str_replace($iv);
        $errCode = decryptData($appid, $session_key, $encrypteData, $iv);
        $res = $errCode;
        if(!empty($res['openId'])){
            $user_res = Db::name('user')->where('openid',$res['openId'])->find();
            if(!empty($user_res)){
                // 执行存入token操作
                $token = insert_token($user_res['id']);
                if($token['status']){
                    return [
                        'status'=>1,
                        'msg'=>'登陆成功',
                        'token'=>$token['token'],
                        'token_time'=>$token['token_time'],
                        'nickname'=>$user_res['nickname'],
                        'avatar_url'=>$user_res['avatar_url']
                    ];
                }else{
                    msg(0,'登陆出错,请重新登陆');
                }
            }else{
                $data = [
                    'openid'=>$res['openId'],
                    'nickname'=>$res['nickName'],
                    'avatar_url'=>$res['avatarUrl'],
                    'create_time'=>time()
                ];
                $user_res = Db::name('user')->insert($data);
                if(!empty($user_res)){
                    $userid = Db::name('user')->getLastInsID();
                    $token = insert_token($userid);
                    if($token['status']){
                        return [
                            'status'=>1,
                            'msg'=>'登陆成功',
                            'token'=>$token['token'],
                            'token_time'=>$token['token_time'],
                            'nickname'=>$res['nickName'],
                            'avatar_url'=>$res['avatarUrl']
                        ];
                    }else{
                        msg(0,'登陆出错,请重新登陆');
                    }
                }else{
                    msg(0,'登陆出错,请重新登陆');
                }
            }
        }else{
            msg(0,'登陆出错,请重新登陆');
        }
    }
    public function token(){
        echo get_token();
    }
    public function get_token(){
        // echo ROOT_PATH."login".DS;exit();
        // echo CACHE_PATH;exit();
        //return \think\Config::get();exit();
        $id = input('id');
        $userid = $id;
        $res = insert_token($userid);
        print_r($res);exit();
    }
}