<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-19 15:07:08
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-09-19 15:07:08
 */
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
        showjson(['code'=>0,'count'=>$total,'data'=>$data]);
    }
    public function del(){
        $id = input('id');
        if (!empty($id) && is_numeric($id)) {
          $res = Carousel_model::del($id);
            if ($res == 1) {
                return ['status'=>1,'msg'=>'删除成功'];
            }else{
                return ['status'=>0,'msg'=>'删除失败'];
            }
        }else{
            return ['status'=>0,'msg'=>'id不合法'];
        }
    }
    public function post(){
        $id = input('id');
        $img_path = input('img_path');
        $sort = input('sort');
        if(empty($img_path)){
            showjson(['status'=>0,'msg'=>'请上传图片']);
        }
        if(empty($sort)){
            $sort = 0;
        }else if(!is_numeric($sort)||strpos($sort,".")!==false){
              showjson(['status'=>0,'msg'=>'排序请填写整数']);
        }else{

        }
        $data = ['img_path'=>$img_path,'sort'=>$sort];
        if (!empty($id) && is_numeric($id)) {
            $data['update_time'] = time();
            $res = Db::name('carousel')->where('id',$id)->update($data);
            if ($res == 1) {
                showjson(['status'=>1,'msg'=>'修改成功']);
            }else{
                showjson(['status'=>0,'msg'=>'修改失败']);
            }
        }else{
            $total = Carousel_model::total();
            if($total>=10){
                showjson(['status'=>0,'msg'=>'轮播图数量已达上限10个,请删除后再添加']);
            }
            $data['create_time'] = time();
            $data['update_time'] = time();
            $res = Db::name('carousel')->insert($data);
            if ($res == 1) {
                showjson(['status'=>1,'msg'=>'添加成功']);
            }else{
                showjson(['status'=>0,'msg'=>'添加失败']);
            }
        }
    }
}
