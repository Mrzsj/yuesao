<?php

namespace app\admin\model;

use think\Db;
use think\Model;

class Agreement extends Model
{
    public function detail(){
        $detail = Db::name('agreement')->field(['id','content'])->find();
        return $detail;
    }

    public function edit($id, $content, $detail){
        if (empty($detail)){
            $insert = [
                'content' => $content,
                'update_time' => time(),
                'create_time' => time()
            ];
            $data = Db::name('agreement')->insert($insert);
        }else{
            $update = [
                'id' => $id,
                'content' => $content,
                'update_time' => time(),
            ];
            $data = Db::name('agreement')->update($update);
        }
        return $data;
    }
}