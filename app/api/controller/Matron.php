<?php
namespace app\api\controller;

use \think\Db;
use \think\Validate;
use app\admin\model\User;

class Matron
{
    public function apply(){
        $userid = get_token();
        $mobile = input('mobile');
        $name = input('name');
        if(empty($name)){
            msg(0,'姓名不能为空');
        }
        if (empty($mobile) || !is_numeric($mobile)) {
            msg(0,'请输入正确的手机号');
        }
        // if (empty($mobile) || !preg_match("/^1[3456789]\d{9}$/", $mobile)) {
    	// 	return ['status'=>0,'msg'=>'请输入正确的手机号'];
        // }
        $data = User::user_get($userid);
        if($data['status'] == 1){
            msg(0,'已经是月嫂，无需申请');
        }
        if($data['status'] == 2){
            msg(0,'已经申请入驻，请勿重复提交');
        }
        $data = ['status'=>2,'matron_create_time'=>time(),'name'=>$name,'mobile'=>$mobile];
        $res = Db::name('user')->where('id',$userid)->update($data);
        if($res == 1){
            msg(1,'提交成功');
        }else{
            msg(0,'提交失败');
        }
    }
    public function edit(){
        $userid = get_token();
        $data = input('post.');
        $rule = [
            'name'  => 'require|chs',
            'mobile' => 'require|number',
            'head_img'=>'require',
            'address'=>'require',
            'year'=>'require|number',
            'households'  => 'require|number',
        ];
        $msg = [
            'name.require' => '请输入姓名',
            'name.chs'=>'姓名只能为汉字',
            'mobile.require'     => '请输入手机号',
            'mobile.number'     => '请输入正确的手机号',
            'head_img.require'   => '请上传头像',
            'address.require'  => '请输入联系地址',
            'year.require'  => '请输入护理经验',
            'year.number'        => '请输入正确的护理经验',
            'households.require'  => '请输入服务家庭数',
            'households.number' => '请输入正确的服务家庭数',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($data)) {
            msg(0,$validate->getError());
        }
        $user = User::user_get($userid);
        if($user['status'] != 1){
            msg(-2,'您还不是月嫂，请申请入驻');
        }
        $data['mobile'] = intval($data['mobile']);
        $data['year'] = intval($data['year']);
        $data['households'] = intval($data['households']);
        // if (empty($data['mobile']) || !preg_match("/^1[3456789]\d{9}$/", $data['mobile'])) {
    	// 	return ['status'=>0,'msg'=>'请输入正确的手机号'];
        // }
        $res = model('matron')->temp($data,$userid);
        if($res){
            msg(1,'修改成功，等待审核');
        }else{
            msg(0,'修改失败');
        }
    }
    public function data(){
        $userid = get_token();
        $res = Db::name('user')
        ->alias('u')
        ->field(['u.name','u.mobile','u.status','u.avatar_url','m.address','m.year','m.households','m.head_img'])
        ->where('u.id',$userid)
        ->join('matron m','u.id=m.user_id')
        ->find();
        if($res['status'] != 1){
            msg(-2,'您还不是月嫂，请申请入驻');
        }
        $data = [
            'name'=>$res['name'],
            'mobile'=>$res['mobile'],
            'address'=>$res['address'],
            'year'=>$res['address'],
            'households'=>$res['households']
        ];
        if(!empty($res['head_img'])){
            $data['head_img'] = $res['head_img'];
            $data['head_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$res['head_img']);
        }else{
            $data['head_url'] = $res['avatar_url'];
            $data['head_img'] = '';
        }
        return ['status'=>1,'data'=>$data];
    }
}