<?php


namespace app\admin\model;


use think\Model;
use think\Db;

class About extends Model
{

    public function detail(){
        $detail = Db::name('about')->field(['id','content'])->find();
        return $detail;
    }

    public function edit($id, $content, $detail){
        if (empty($detail)){
            $insert = [
                'content' => $content,
                'update_time' => time(),
                'create_time' => time()
            ];
            $data = Db::name('about')->insert($insert);
        }else{
            $update = [
                'id' => $id,
                'content' => $content,
                'update_time' => time(),
            ];
            $data = Db::name('about')->update($update);
        }
        return $data;
    }
}