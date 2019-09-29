<?php
namespace app\api\controller;
use \think\Db;
class Pay{
    public function getdata(){
        $appid="wxcd417936b51ed32a"; //小程序appid
        $appsecret= "43f4fa48efdf86e43a4a0b093e28189c"; //小程序的secret
        $MCHID="1455955802"; //商户号id
        $KEY="abef3c0b40dd00c283551204db78fd77"; //商户号key

        $orderid = input('id');
        if(!empty($orderid)){
            $orderid = intval($orderid);
            $order_res = Db::name('order')
            ->alias('o')
            ->field(['o.payable_price','u.openid','o.ordersn'])
            ->where('o.id',$orderid)
            ->join('user u','u.id=o.user_id')
            ->find();
            if(!$order_res){
                msg(0,'订单不存在');
            }
        }else{
            msg(0,'请传入id');
        }
        $total_fee = $order_res['payable_price']; //支付金额
        $openid = $order_res['openid']; //用户的Openid
        if(empty($total_fee) || empty($openid)){ //一定要有用户Openid和支付金额
            msg(0,'订单异常');
        }
        $total_fee = $total_fee * 100; //支付金额单位是分的，所以要乘100

        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";

        $data['appid'] = $appid;  //小程序appid
        $data['mch_id'] = $MCHID;	//商户号id
        $data['nonce_str'] = md5($MCHID.time()); //验证的支付
        $data['openid'] = $openid; //用户openid
        $data['body'] = '安徽罗网信息科技有限公司'; //微信支付对应的商家/公司主体名
        $data['out_trade_no'] = $order_res['ordersn']; //订单号id,用于回调改订单状态
        $data['total_fee'] = $total_fee; //支付金额，单位为分！！
        $data['spbill_create_ip'] = '8.8.8.8'; //验证ip地址，这个不用改随意
        $data['notify_url'] = domain_name()."/api/pay/notify"; //微信支付成功的回调路径，要写死这个路径，记得要是小程序允许访问的路径
        $data['trade_type'] = "JSAPI"; //小程序支付，所以是JSAPI

        ksort($data); 
        $sign_str = ToUrlParams($data);
        $sign_str = $sign_str."&key=".$KEY;
        $data['sign'] = strtoupper(md5($sign_str));
        $xml = arrayToXml($data);
        $r = postXmlCurl($xml,$url,true);
        $result = json_decode(xml_to_json($r));

        if($result->return_code == 'SUCCESS'){
            $sdata['appId'] = $appid;
            $sdata['timeStamp'] = time();
            $sdata['nonceStr'] = md5(time().rand().rand().$openid);
            $sdata['package'] = "prepay_id=".$result->prepay_id;
            $sdata['signType'] = "MD5";
            ksort($sdata);
            $sign_str = ToUrlParams($sdata);
            $sign_str = $sign_str."&key=".$KEY;
            $sdata['paySign'] = strtoupper(md5($sign_str));
            echo json_encode($sdata);
        }
    }
    public function notify(){
        $data = file_get_contents('php://input');
        $msg = (array)simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
        if($msg['result_code'] == "SUCCESS") {
            // 支付成功这里要做的操作！
            $myfile = fopen("notify.txt", "a");
            fwrite($myfile, json_encode($data));
            fwrite($myfile, json_encode($msg));
            fclose($myfile);
        } 
        echo '<xml>
          <return_code><![CDATA[SUCCESS]]></return_code>
          <return_msg><![CDATA[OK]]></return_msg>
        </xml>';       
    }
}