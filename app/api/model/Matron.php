<?php
namespace app\api\model;

use \think\Model;
use \think\Db;
class Matron extends Model{
    public function temp($data,$userid){
        $temp = serialize($data);
        $data = [
            'temp'=>$temp,
            'is_data_audit'=>2,
            'update_time'=>time()
        ];
        return Db::name('matron')->where('user_id',$userid)->update($data);
    }
    public function matron_get($userid){
        return Db::name('matron')->where('user_id',$userid)->find();
    }
    public function home_page_list($number,$limit,$region){
        return Db::name('matron')
        ->alias('m')
        ->field(['m.id','m.star','m.introduce','m.head_img','u.name','u.avatar_url'])
        ->join('user u','u.id=m.user_id')
        ->where('m.status','1')
        ->where('m.is_home_page','1')
        ->where('m.region',$region)
        ->limit($number,$limit)
        ->order('u.id desc')
        ->select();
    }
    public function list($number,$limit,$region,$where='',$order_by){
        return Db::name('matron')
        ->alias('m')
        ->field(['m.id','m.star','m.introduce','m.head_img','u.name','u.avatar_url','m.age','m.price','m.native_place','m.year'])
        ->join('user u','u.id=m.user_id')
        ->where($where)
        ->where('m.status','1')
        ->where('m.region',$region)
        ->limit($number,$limit)
        ->order($order_by)
        ->select();
    }
    public function detail($id){
        return Db::name('matron')
        ->alias('m')
        ->field(['m.id','m.star','m.introduce','m.head_img','u.name','u.avatar_url','m.age','m.price','m.native_place','m.year','m.label','m.status','m.households','m.nation'])
        ->join('user u','u.id=m.user_id')
        ->where('m.id',$id)
        ->order('u.id desc')
        ->find();
    }
    public function evaluate_num($matron_id){
        $evaluate = Db::name('evaluate')
        ->field(['avg(b_nursing) as b_nursing','avg(early_education) as early_education','avg(collocation) as collocation','avg(feed) as feed','avg(m_nursing) as m_nursing','avg(communicate) as communicate'])
        ->where('matron_id',$matron_id)
        ->find();
        if(empty($evaluate)){
            return [
                'b_nursing'=>3.0,
                'early_education'=>3.0,
                'collocation'=>3.0,
                'feed'=>3.0,
                'm_nursing'=>3.0,
                'communicate'=>3.0,
                'total'=>3.0
            ];
        }
        $evaluate['b_nursing'] = number_format($evaluate['b_nursing'], 1);
        $evaluate['early_education'] = number_format($evaluate['early_education'], 1);
        $evaluate['collocation'] = number_format($evaluate['collocation'], 1);
        $evaluate['feed'] = number_format($evaluate['feed'], 1);
        $evaluate['m_nursing'] = number_format($evaluate['m_nursing'], 1);
        $evaluate['communicate'] = number_format($evaluate['communicate'], 1);
        $total = 0;
        foreach($evaluate as $k => $v){
            $total += $v;
        }
        $evaluate['total'] = number_format($total/6,1);
        return $evaluate;
    }
    public function evaluate_list($matron_id){
        $evaluate = Db::name('evaluate')
        ->alias('e')
        ->field(['e.b_nursing','e.early_education','e.collocation','e.feed','e.m_nursing','e.communicate','e.content','e.create_time','o.days','o.name','u.avatar_url'])
        ->join('order o','e.order_id=o.id')
        ->join('user u','u.id=o.user_id')
        ->where('e.matron_id',$matron_id)
        ->select();
        if(empty($evaluate)){
            return [];
        }
        foreach($evaluate as $k => $v){
            $evaluate[$k]['total'] = number_format(($v['b_nursing'] + $v['early_education'] + $v['collocation'] + $v['feed'] + $v['m_nursing'] + $v['communicate'])/6, 1);
            $evaluate[$k]['create_time'] = date('Y-m-d',$v['create_time']);
            unset($evaluate[$k]['b_nursing']);
            unset($evaluate[$k]['early_education']);
            unset($evaluate[$k]['collocation']);
            unset($evaluate[$k]['feed']);
            unset($evaluate[$k]['m_nursing']);
            unset($evaluate[$k]['communicate']);
        }
        return $evaluate;
    }
}
