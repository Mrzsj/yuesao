<?php


namespace app\admin\model;

use \think\Model;
use \think\Db;
class Information extends Model
{
    public function getlist($number, $limit){
        $data = Db::name('information')->order('sort desc')->limit($number, $limit)->select();
        foreach($data as $k => $v){
            $data[$k]['create_time'] = date('Y-m-d H:i:s', $data[$k]['create_time']);
            $data[$k]['update_time'] = date('Y-m-d H:i:s', $data[$k]['update_time']);
        }
        return $data;
    }

    public function search($number, $limit, $q){
        $data = Db::name('information')->whereLike('title', '%'.$q.'%')->order('sort desc')->limit($number, $limit)->select();
        foreach($data as $k => $v){
            $data[$k]['create_time'] = date('Y-m-d H:i:s', $data[$k]['create_time']);
            $data[$k]['update_time'] = date('Y-m-d H:i:s', $data[$k]['update_time']);
        }
        return $data;
    }

    public function total(){
        $data = Db::name('information')->field('count(id)')->find();
        return $data['count(id)'];
    }

    public function edit($id, $sort, $img, $title, $content){
        //入库操作
        if (!empty($id)){
            $update = [
                'sort' => $sort,
                'img' => $img,
                'title' => $title,
                'content' => $content,
                'update_time' => time()
            ];
            $res = Db::name('information')->where('id', $id)->update($update);
        }else{
            $insert = [
                'sort' => $sort,
                'img' => $img,
                'title' => $title,
                'content' => $content,
                'update_time' => time(),
                'create_time' => time()
            ];
            $res = Db::name('information')->insert($insert);
        }
        return $res;
    }

    public function del($id){
        $res = Db::name('information')->where('id', $id)->delete();
        return $res;
    }
}