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
        if(strtotime($post['start_time']) <= time()){
            msg(0,'预约日期必须从明天以后的日期');
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
        // $res = Db::name('order')
        // ->where('matron_id',$post['matron_id'])
        // ->where('start_time','<=',strtotime($post['start_time']))
        // ->where('end_time','>=',strtotime($post['start_time']))
        // ->where('(status=0 or status=1 or status=2 or status=4)')
        // ->select();
        $res = Db::name('order')
        ->where('matron_id',$post['matron_id'])
        ->where('(start_time'.'<='.strtotime($post['start_time']).' and end_time'.'>='.strtotime($post['start_time']).') or (start_time<='.(strtotime($post['start_time']) + 86400*($post['days']-1)).' and end_time>='.(strtotime($post['start_time']) + 86400*($post['days']-1)).")")
        ->where('(status=0 or status=1 or status=2 or status=4)')
        ->select();
        if(!empty($res)){
            msg(0,'当前预约日期该月嫂有档期安排，请重新选择');
        }
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
        $end_time = strtotime($post['start_time']) + 86400*($post['days']-1);
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
    public function refund(){
        $id = input('id');
        $user_id = get_token();
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请传入正确的id');
        }
        $id = intval($id);
        $data = [
            'status'=>4,
            'update_time'=>time()
        ];
        $res = Db::name('order')->where('id',$id)->where('user_id',$user_id)->find();
        if($res){
           if($res['status'] != 1){
              msg(0,'该笔订单不是已付款状态，请刷新后重试');
           } 
        }else{
            msg(0,'未查询到订单，请重试');
        }
        try {
            Db::name('order')->where('id',$id)->where('user_id',$user_id)->update($data);
            return ['status'=>1,'msg'=>'申请成功'];
        } catch (\Exception $e) {
            return ['status'=>0,'msg'=>'申请退款失败'];  
        }
    }
    public function list(){
        $user_id = get_token();
        $status = input('status');
        $where = '';
        if($status == 0 || $status == 1 || $status == 2 || $status == 4){
            $where = order_status_where($status);
        }else{
            return ['status'=>0,'msg'=>'状态码不正确'];
        }
        $data = Db::name('order')
        ->alias('o')
        ->field(['u.name','u.avatar_url','m.head_img','o.status','o.payable_price','o.start_time','o.id','o.is_evaluate','o.ordersn','o.days'])
        ->join('matron m','m.id=o.matron_id')
        ->join('user u','m.user_id=u.id')
        ->where('o.user_id',$user_id)
        ->where($where)
        ->order('o.create_time desc')
        ->select();
        if(!empty($data)){
            foreach($data as $k => $v){
                $data[$k]['start_time'] = date("Y-m-d",$v['start_time']);
                if($v['head_img']){
                    $data[$k]['head_url'] = domain_name().$v['head_img'];
                }else{
                    $data[$k]['head_url'] = $v['avatar_url'];
                }
                unset($data[$k]['avatar_url']);
                unset($data[$k]['head_img']);
            }
            $data = ['status'=>1,'data'=>$data];
        }else{
            $data = ['status'=>0,'data'=>$data];
        }
        return $data;
    }
    public function evaluate(){
        $user_id = get_token();
        $post = input('post.');
        $rule = [
            'id'  => 'require|number',
            'b_nursing'=>'require|in:1,2,3,4,5',
            'early_education'=>'require|in:1,2,3,4,5',
            'collocation'=>'require|in:1,2,3,4,5',
            'feed'=>'require|in:1,2,3,4,5',
            'm_nursing'=>'require|in:1,2,3,4,5',
            'communicate'=>'require|in:1,2,3,4,5',
            'content'=>'require',
        ];
        $msg = [
            'id.require'     => '请传入id',
            'id.number'     => '请传入正确的id',

            'b_nursing.require' =>'请传入宝宝护理评分',
            'b_nursing.in'=>'请传入正确的宝宝护理评分',

            'early_education.require' =>'请传入宝宝早教评分',
            'early_education.in'=>'请传入正确的宝宝早教评分',

            'collocation.require' =>'请传入膳食搭配评分',
            'collocation.in'=>'请传入正确的膳食搭配评分',

            'feed.require' =>'请传入科学喂养评分',
            'feed.in'=>'请传入正确的科学喂养评分',

            'm_nursing.require' =>'请传入产妇护理评分',
            'm_nursing.in'=>'请传入正确的产妇护理评分',

            'communicate.require' =>'请传入沟通技巧评分',
            'communicate.in'=>'请传入正确的沟通技巧评分',

            'content.require'=>'内容不能为空',
        ];
        $validate = new Validate($rule,$msg);
        if (!$validate->check($post)) {
            msg(0,$validate->getError());
        }
        $id = intval($post['id']);
        unset($post['id']);
        $res = Db::name('order')->where('id',$id)->where('user_id',$user_id)->find();
        if(!$res){
            msg(0,'订单不存在,请刷新重试');
        }
        if($res['status'] != 2){
            msg(0,'订单必须为已完成');
        }
        if($res['is_evaluate'] == 1){
            msg(0,'订单已评价');
        }
        $data = [
            'b_nursing'=>$post['b_nursing'],
            'early_education'=>$post['early_education'],
            'collocation'=>$post['collocation'],
            'feed'=>$post['feed'],
            'm_nursing'=>$post['m_nursing'],
            'communicate'=>$post['communicate'],
            'content'=>$post['content'],
            'matron_id'=>$res['matron_id'],
            'order_id'=>$res['id'],
            'create_time'=>time(),
            'update_time'=>time(),
        ];
        Db::startTrans();
        try {
            Db::name('evaluate')->insert($data);
            Db::name('order')->where('id',$id)->where('user_id',$user_id)->update(['is_evaluate'=>1,'update_time'=>time()]);
            Db::commit();
            msg(1,'评价成功');
        } catch (\Exception $e) {
            Db::rollback();
            msg(0,'评价失败');
        }
    }
    public function matron_list(){
        $user_id = get_token();
        $status = input('status');//0历史订单   1当前订单
        if($status == 1){
            $status = 1; 
        }else{
            $status = 2;
        }
        $matron = model('matron')->matron_get($user_id);
        if(empty($matron)){
            msg(-2,'您还不是月嫂，请申请入驻');
        }
        $data = Db::name('order')
        ->alias('o')
        ->field(['o.name','o.mobile','o.ordersn','o.address','o.start_time','o.days','o.payable_price','o.commission','o.is_receive','o.remark','u.avatar_url','o.id'])
        ->join('user u','o.user_id=u.id')
        ->where('o.matron_id',$matron['id'])
        ->where('o.status',$status)
        ->select();
        if(!empty($data)){
            foreach($data as $k => $v){
                $data[$k]['start_time'] = date('Y-m-d',$v['start_time']); 
            }
            $data = ['status'=>1,'data'=>$data];
        }else{
            $data = ['status'=>0,'data'=>[]];
        }
        return $data;
    }
    public function cancel(){
        $id = input('id');
        $user_id = get_token();
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请传入正确的id');
        }
        $id = intval($id);
        $data = [
            'status'=>3,
            'update_time'=>time()
        ];
        $res = Db::name('order')->where('id',$id)->where('user_id',$user_id)->find();
        if($res){
           if($res['status'] != 0){
              msg(0,'该笔订单不是待付款状态，请刷新后重试');
           } 
        }else{
            msg(0,'未查询到订单，请重试');
        }
        try {
            Db::name('order')->where('id',$id)->where('user_id',$user_id)->update($data);
            return ['status'=>1,'msg'=>'取消订单成功'];
        } catch (\Exception $e) {
            return ['status'=>0,'msg'=>'取消订单失败'];  
        }
    }
    public function evaluate_detail(){
        $id = input('id');
        $user_id = get_token();
        if (empty($id) || !is_numeric($id)) {
            msg(0,'请传入正确的id');
        }
        $id = intval($id);
        $data = Db::name('order')
        ->alias('o')
        ->field(['o.days','o.id','o.name','o.mobile','o.address','u.name as m_name','m.head_img','u.avatar_url'])
        ->join('matron m','m.id=o.matron_id')
        ->join('user u','m.user_id=u.id')
        ->where('o.id',$id)
        ->where('o.user_id',$user_id)
        ->find();
        if(empty($data)){
            msg(0,'订单不存在');
        }
        if(!empty($data['head_img'])){
            $data['head_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace("\\",'/',$res['head_img']);
        }else{
            $data['head_url'] = $data['avatar_url'];
        }
        unset($data['head_img']);
        unset($data['avatar_url']);
        return ['status'=>1,'data'=>$data];
    }
}