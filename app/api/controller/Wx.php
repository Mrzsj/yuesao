<?php
namespace app\api\controller;

class Wx
{
    public function login()
    {
        $code = input('code');
        if(empty($code)){
            return ['status'=>0,'msg'=>'code不能为空'];
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
            return ['status'=>0,'msg'=>'session_key不能为空'];
        }
        if(empty($encrypteData)){
            return ['status'=>0,'msg'=>'encrypteData不能为空'];
        }
        if(empty($iv)){
            return ['status'=>0,'msg'=>'iv不能为空'];
        }
        $param['appid'] = 'wxcd417936b51ed32a';    //小程序id
        $appid = $param['appid'];
        $encrypteData = urldecode($encrypteData);
        $iv = define_str_replace($iv);
        $errCode = decryptData($appid, $session_key, $encrypteData, $iv);
        var_dump($errCode);exit();
    }
}