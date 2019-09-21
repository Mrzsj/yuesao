<?php
namespace app\api\controller;

use \think\Db;
use app\admin\model\User;

class Matron
{
    public function apply(){
        $userid = get_token();
        $mobile = input('mobile');
        $name = input('name');
        if(empty($name)){
            return ['status'=>0,'msg'=>'姓名不能为空'];
        }
        if (empty($mobile) || !preg_match("/^1[3456789]\d{9}$/", $mobile)) {
    		return ['status'=>0,'msg'=>'请输入正确的手机号'];
        }
        $data = User::user_get($userid);
        if($data['status'] == 1){
            return ['status'=>0,'msg'=>'已经是月嫂，无需申请'];
        }
        if($data['status'] == 2){
            return ['status'=>0,'msg'=>'已经申请入驻，请勿重复提交'];
        }
        $data = ['status'=>2,'matron_create_time'=>time(),'name'=>$name,'mobile'=>$mobile];
        $res = Db::name('user')->where('id',$userid)->update($data);
        if($res == 1){
            return ['status'=>1,'msg'=>'提交成功'];
        }else{
            return ['status'=>0,'msg'=>'提交失败'];
        }
    }
}