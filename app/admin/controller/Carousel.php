<?php
namespace app\admin\controller;

use \think\Db;
use app\admin\controller\Permissions;
class Carousel extends Permissions
{
    public function index(){
        return $this->fetch();
    }
    public function list(){
        $page = input('page');
        $limit = input('limit');
        if (empty($page) || !is_numeric($page)) {
          return ['status'=>0,'msg'=>'请输入正确的页码'];
        }
        if (empty($limit) || !is_numeric($limit)) {
          return ['status'=>0,'msg'=>'请输入正确的条数'];
        }
    }
}
