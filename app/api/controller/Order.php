<?php
namespace app\api\controller;
use \think\Db;
use \think\Validate;
class Order{
    public function add(){
        $user_id = get_token();
        $post = input('post.');
        $rule = [
            'name'  => 'require|chs',
            'mobile' => 'require|number',
            'matron_id'=>'require|number',
            'address'=>'require',
            'days'=>'require|number',
            'start_time'=>'require|date'
        ];
        $msg = [
            'name.require' => '请输入姓名',
            'name.chs'=>'姓名只能为汉字',
            'mobile.require'     => '请输入手机号',
            'mobile.number'     => '请输入正确的手机号',
            'matron_id.require'   => '请传入月嫂id',
            'matron_id.number'   => '请传入正确的月嫂id',
            'address.require'  => '请输入联系地址',
            'days.require'  => '请选择天数',
            'days.number'        => '请输入正确的天数',
            'start_time.require'  => '请选择日期',
            'start_time.date'        => '请选择正确的日期',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($post)) {
            msg(0,$validate->getError());
        }
        $post['matron_id'] = intval($post['matron_id']);
        $post['days'] = intval($post['days']);
        if(isset($post['coupon'])){
            $post['coupon'] = intval($post['coupon']);
        }else{
            $post['coupon'] = 0;
        }
        if(!isset($post['remark'])){
            $post['remark'] = '';
        }
        if($post['days']<26){
            msg(0,'天数不能小于26天');
        }
        $matron = model('admin/matron')->getone($post['matron_id']);
        if(empty($matron)){
            msg(0,'选择的月嫂不存在,请返回重试');
        }
        if($matron['status'] == 0){
            msg(0,'选择的月嫂已被禁用,请更换月嫂');
        }
        if($matron['price'] <= 0){
            msg(0,'月嫂价格未设定，不能下单');
        }
        if($matron['user_id'] == $user_id){
            msg(0,'不能给自己下单');
        }
        //此处缺少，判断用户选择的月嫂有没有档期安排

        if(isset($post['coupon']) && !empty($post['coupon']) && is_numeric($post['coupon'])){
            $coupon_log_id = intval($post['coupon']);
            $coupon_log = Db::name('coupon_log')->where('id',$coupon_log_id)->where('expire_time','>',time())->where('status','1')->find();
            if(empty($coupon_log)){
                $coupon_log_id = 0;
                $coupon_log['face_value'] = 0;
                $coupon_log['full'] = 0;
            }
        }else{
            $coupon_log_id = 0;
            $coupon_log['face_value'] = 0;
            $coupon_log['full'] = 0;
        }
        $total_price = ($post['days']-26)*($matron['price']/26) + $matron['price'];
        $total_price = sprintf("%.2f", $total_price);
        if($total_price>=$coupon_log['full']){
            $payable_price = $total_price - $coupon_log['face_value'];
            $payable_price = sprintf("%.2f", $payable_price);
        }else{
            msg(0,'优惠券满减金额没有达到订单金额');
        }
        $end_time = strtotime($post['start_time']) + 86400*$post['days'];
        $data['name'] = $post['name'];
        $data['mobile'] = $post['mobile'];
        $data['matron_id'] = $post['matron_id'];
        $data['address'] = $post['address'];
        $data['days'] = $post['days'];
        $data['start_time'] = strtotime($post['start_time']);
        $data['end_time'] = $end_time;
        $data['user_id'] = $user_id;
        $data['remark'] = $post['remark'];
        $data['region'] = $matron['region'];
        $data['matron_price'] = $matron['price'];
        $data['coupon_log_id'] = $coupon_log_id;
        $data['coupon_price'] = $coupon_log['face_value'];
        $data['status'] = 0;
        $data['total_price'] = $total_price;
        $data['payable_price'] = $payable_price;
        $data['create_time'] = time();
        $data['update_time'] = time();
        $data['ordersn'] =  false;
        $data['matron_star'] = $matron['star'];
        $data['matron_proportion'] = star_value($matron['star']);
        $data['commission'] = sprintf("%.2f", $data['payable_price']*(star_value($matron['star'])/100));
        while(!$data['ordersn']){
            $data['ordersn'] = date('Ymd').mt_rand(10000,99999);
            if(Db::name('order')->where('ordersn',$data['ordersn'])->find()){
                $data['ordersn'] = false;
            }
        }
        Db::startTrans();
        try {
            if($coupon_log_id){
                Db::name('coupon_log')->where('id',$coupon_log_id)->update(['status'=>0]);
            }
            Db::name('order')->insert($data);
            $order_id = Db::name('order')->getLastInsID();
            Db::commit();
            return ['status'=>1,'order_id'=>$order_id,'msg'=>'提交订单成功'];  
        } catch (\Exception $e) {
            Db::rollback();
            return ['status'=>0,'msg'=>'提交订单失败'];  
        }
    }
}