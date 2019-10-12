<?php
namespace app\admin\controller;

use \think\Db;
use \think\Validate;
class Evaluate extends Permissions
{
    public function index(){
        return $this->fetch();
    }
    public function list(){
        $page = input('page');
        $limit = input('limit');
        $ordersn = input('ordersn');
        if (empty($page) || !is_numeric($page)) {
            msg(0,'请输入正确的页码');
        }
        if (empty($limit) || !is_numeric($limit)) {
            msg(0,'请输入正确的条数');
        }
        $number = ($page - 1) * $limit;
        $where = '';
        if($ordersn){
            $where .= 'o.ordersn='.$ordersn;
        }
        $data = model('evaluate')->getlist($number,$limit,$where);
        $total = model('evaluate')->total($where);
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
    public function edit(){
        $id = input('id');
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请传入正确的id');
        }
        $id = intval($id);
        $data = Db::name('evaluate')->where('id',$id)->find();
        if(empty($data)){
            msg(0,'评价不存在，请刷新后重试');
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function post(){
        $post = input('post.');
        $rule = [
            'id'  => 'require|number',
            'b_nursing'=>'require|in:1,2,3,4,5',
            'early_education'=>'require|in:1,2,3,4,5',
            'collocation'=>'require|in:1,2,3,4,5',
            'feed'=>'require|in:1,2,3,4,5',
            'm_nursing'=>'require|in:1,2,3,4,5',
            'communicate'=>'require|in:1,2,3,4,5',
            'content'=>'require',
        ];
        $msg = [
            'id.require'     => '请传入id',
            'id.number'     => '请传入正确的id',

            'b_nursing.require' =>'请传入宝宝护理评分',
            'b_nursing.in'=>'请传入正确的宝宝护理评分',

            'early_education.require' =>'请传入宝宝早教评分',
            'early_education.in'=>'请传入正确的宝宝早教评分',

            'collocation.require' =>'请传入膳食搭配评分',
            'collocation.in'=>'请传入正确的膳食搭配评分',

            'feed.require' =>'请传入科学喂养评分',
            'feed.in'=>'请传入正确的科学喂养评分',

            'm_nursing.require' =>'请传入产妇护理评分',
            'm_nursing.in'=>'请传入正确的产妇护理评分',

            'communicate.require' =>'请传入沟通技巧评分',
            'communicate.in'=>'请传入正确的沟通技巧评分',

            'content.require'=>'内容不能为空',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($post)) {
            msg(0,$validate->getError());
        }
        $id = intval($post['id']);
        unset($post['id']);
        $data = [
            'b_nursing'=>$post['b_nursing'],
            'early_education'=>$post['early_education'],
            'collocation'=>$post['collocation'],
            'feed'=>$post['feed'],
            'm_nursing'=>$post['m_nursing'],
            'communicate'=>$post['communicate'],
            'content'=>$post['content'],
            'update_time'=>time(),
        ];
        try {
            Db::name('evaluate')->where('id',$id)->update($data);
            msg(1,'修改成功');
        } catch (\Exception $e) {
            msg(0,'修改失败');
        }
    }
}