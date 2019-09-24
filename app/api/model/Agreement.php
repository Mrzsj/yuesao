<?php

namespace app\api\model;

use think\Db;
use think\Model;

class Agreement extends Model
{
    public function detail(){
        $detail = Db::name('agreement')->field('content')->find();
        return $detail;
    }
}