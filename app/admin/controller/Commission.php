<?php
namespace app\admin\controller;

use \think\Db;

class Commission extends Permissions
{
    public function setting(){
        return $this->fetch();
    }
    public function setting_edit(){
        $post = input('post.');
        if(isset($post['star']) && count($post['star']) == 7){
            $star = $post['star'];
        }else{
            msg(0,'参数错误');
        }
        if(isset($star[2]) && isset($star[3]) && isset($star[4]) && isset($star[5]) && isset($star[6]) && isset($star[7]) && isset($star[8])){
            $success = 0;
            $fail = 0;
            foreach($star as $k => $v){
                if(!is_numeric($v)){
                    msg(0,'输入值必须为数字');
                }
                $v = intval($v);
                if(!($v>=0 && $v<=100)){
                    msg(0,'输入值必须为0到100的整数');
                }
                $res = Db::name('commission_setting')->where('star',$k)->find();
                if(!empty($res)){
                    Db::name('commission_setting')->where('star',$k)->update(['proportion'=>$v]) ? $success++ : $fail++;
                }else{
                    Db::name('commission_setting')->insert(['star'=>$k,'proportion'=>$v]) ? $success++ : $fail++;
                }
            }
            msg(1,"成功修改了$success 条");
        }else{
            msg(0,'参数不完整');
        }
    }
}