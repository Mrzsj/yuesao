<?php
namespace app\api\controller;

class Wx
{
    public function login()
    {
        $code = input('code');
        $encrypteData = input('encrypteData');
        $iv = input('iv');
        if(empty($code)){
            return ['status'=>0,'msg'=>'code不能为空'];
        }
        if(empty($encrypteData)){
            return ['status'=>0,'msg'=>'encrypteData不能为空'];
        }
        if(empty($iv)){
            return ['status'=>0,'msg'=>'iv不能为空'];
        }
 		$param['appid'] = 'wxcd417936b51ed32a';    //小程序id
 		$param['secret'] = '43f4fa48efdf86e43a4a0b093e28189c';    //小程序密钥
 		$param['js_code'] = define_str_replace($code);
 		$param['grant_type'] = 'authorization_code';
 		$http_key = httpCurl('https://api.weixin.qq.com/sns/jscode2session', $param, 'GET');
        $session_key = json_decode($http_key,true);
        //print_r(http_build_query($param));
        if (!empty($session_key['session_key'])) {
            $appid = $param['appid'];
            $encrypteData = urldecode($get['encrypteData']);
            $iv = define_str_replace($get['iv']);
            $errCode = decryptData($appid, $session_key['session_key'], $encrypteData, $iv);
            //把appid写入到数据库中
            $data['appid'] = $errCode['openId'];
            $data['nicheng'] = $errCode['nickName'];
            $data['publishtime'] = time();
            $data['sex'] = $errCode['gender'];
            if (false == $this->user->where(['appid' => $data['appid']])->find()) {
                $this->user->insert($data);
            }else{
                $value = $this->user->where(['appid' => $data['appid']])->field('name,tel,birthday,industry,address')->select();
            }
            $array = array_merge_recursive($errCode, $value);
            return json($array);
        }else{
            echo '获取session_key失败！';
        }
    }
}
