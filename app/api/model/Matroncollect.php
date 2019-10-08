<?php


namespace app\api\model;


use think\Model;
use think\Db;

class Matroncollect extends Model
{
    public function getList($number, $limit, $user_id){
        $list = Db::name('matroncollect')
            ->alias('mc')
            ->join('matron m', 'mc.matron_id = m.id')
            ->field('m.id, mc.matron_id, m.head_img, m.price, m.introduce')
            ->where('mc.user_id', $user_id)
            ->order('mc.create_time desc')
            ->limit($number, $limit)
            ->select();

        foreach($list as $k => $v){
            if (empty($list[$k]['head_img'])){
                $list[$k]['head_img'] = Db::name('user')
                    ->join('matron m', 'user.id = m.user_id')
                    ->field('m.id, user.avatar_url')
                    ->where('m.id', $list[$k]['matron_id'])
                    ->find();
                $list[$k]['head_img'] = $list[$k]['head_img']['avatar_url'];
            }else{
                $list[$k]['head_img'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$v['head_img']);
            }
        }
        if(!empty($list)){
            return $list;
        }else{
            return $list;
        }
    }

    public function add($matron_id, $user_id){
        $res = Db::name('matron')->where('id', $matron_id)->find();
        $data = 0;
        if ($res['status'] == 1){
            $insert = [
                'matron_id' => $matron_id,
                'user_id' => $user_id,
                'create_time' => time()
            ];
            $data = Db::name('matroncollect')->insert($insert);
        }
        return $data;
    }

    public function del($id){
        $res = Db::name('matroncollect')->where('id', $id)->delete();
        return $res;
    }
}