<?php
namespace app\api\controller;

use \think\Db;
use \think\Validate;
class Evaluate
{
    public function add(){
        $user_id = get_token();
        $post = input('post.');
        $rule = [
            'id'  => 'require|number',
        ];
        $msg = [
            'id.require' => '请传入订单id',
            'id.number' => '请传入正确的订单id',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($post)) {
            msg(0,$validate->getError());
        }
        $res = Db::name('order')->where('id',$post['id'])->where('user_id',$user_id)->find();
        if(!$res){
            msg(0,'订单不存在,请刷新后重试');
        }
        if($res['is_evaluate'] == 1){
            msg(0,'该笔订单已评价');
        }
        if($res['status'] != 2){
            msg(0,'订单必须为完成状态才可以评价');
        }
        
    }
}