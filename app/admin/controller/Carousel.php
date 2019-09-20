<?php
namespace app\admin\controller;

use \think\Db;
use app\admin\controller\Permissions;
use app\admin\model\Carousel as Carousel_model;
class Carousel extends Permissions
{
    public function index(){
        return $this->fetch();
    }
    public function list(){
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
          showjson(['status'=>0,'msg'=>'请输入正确的页码']);
        }
        if (empty($limit) || !is_numeric($limit)) {
          showjson(['status'=>0,'msg'=>'请输入正确的条数']);
        }
        $number = ($page - 1) * $limit;
        $data = Carousel_model::getlist($number,$limit);
        $total = Carousel_model::total();
        showjson(['code'=>0,'total'=>$total,'data'=>$data]);
    }
}
