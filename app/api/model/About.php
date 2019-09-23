<?php


namespace app\api\model;


use think\Model;
use think\Db;

class About extends Model
{
    public function detail(){
        $detail = Db::name('about')->field('content')->find();
        return $detail;
    }
}