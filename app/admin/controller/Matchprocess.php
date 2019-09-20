<?php
namespace app\admin\controller;

use \think\Db;
use app\admin\controller\Permissions;
class Matchprocess extends Permissions
{
    public function index(){
        $data = Db::name('matchprocess')->find();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function edit(){
        $title = input('title');
        $head_img = input('head_img');
        $content = input('content');
        if (empty($title)) {
            showjson(['status'=>0,'msg'=>'请输入标题']);
        }
        if (empty($head_img)) {
            showjson(['status'=>0,'msg'=>'请上传图片']);
        }
        $res = Db::name('matchprocess')->find();
        if(empty($res)){
            $res = Db::name('matchprocess')->insert(['head_img'=>$head_img,'title'=>$title,'content'=>$content,'create_time'=>time(),'update_time'=>time()]);
        }else{
            $res = Db::name('matchprocess')->where('id',$res['id'])->update(['head_img'=>$head_img,'title'=>$title,'content'=>$content,'update_time'=>time()]);
        }
        if($res){
            showjson(['status'=>1,'msg'=>'修改成功']);
        }else{
            showjson(['status'=>0,'msg'=>'修改成功']);
        }
    }
}
