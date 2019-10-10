<?php
// 应用公共文件
/**
 * 根据附件表的id返回url地址
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function geturl($id){
	if ($id) {
		$geturl = \think\Db::name("attachment")->where(['id' => $id])->find();
		if($geturl['status'] == 1) {
			//审核通过
			return $geturl['filepath'];
		} elseif($geturl['status'] == 0) {
			//待审核
			return '/uploads/xitong/beiyong1.jpg';
		} else {
			//不通过
			return '/uploads/xitong/beiyong2.jpg';
		}
    }
    return false;
}
/**
 * 发送HTTP请求方法
 * @param  string $url    请求URL
 * @param  array  $params 请求参数
 * @param  string $method 请求方法GET/POST
 * @return array  $data   响应数据
 */
function httpCurl($url, $params, $method = 'POST', $header = array(), $multi = false){
    date_default_timezone_set('PRC');
    $opts = array(
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER     => $header,
        CURLOPT_COOKIESESSION  => true,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_COOKIE         =>session_name().'='.session_id(),
    );
    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            // $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            // 链接后拼接参数  &  非？
            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            break;
        case 'POST':
            //判断是否传输文件
            $params = $multi ? $params : http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            throw new Exception('不支持的请求方式！');
    }
    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if($error) throw new Exception('请求发生错误：' . $error);
    return  $data;
}
/**
 * 微信信息解密
 * @param  string  $appid  小程序id
 * @param  string  $sessionKey 小程序密钥
 * @param  string  $encryptedData 在小程序中获取的encryptedData
 * @param  string  $iv 在小程序中获取的iv
 * @return array 解密后的数组
 */
function decryptData( $appid , $sessionKey, $encryptedData, $iv ){
    $OK = 0;
    $IllegalAesKey = -41001;
    $IllegalIv = -41002;
    $IllegalBuffer = -41003;
    $DecodeBase64Error = -41004;
 
    if (strlen($sessionKey) != 24) {
        return $IllegalAesKey;
    }
    $aesKey=base64_decode($sessionKey);
 
    if (strlen($iv) != 24) {
        return $IllegalIv;
    }
    $aesIV=base64_decode($iv);
 
    $aesCipher=base64_decode($encryptedData);
 
    $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
    $dataObj=json_decode( $result );
    if( $dataObj  == NULL )
    {
        return $IllegalBuffer;
    }
    if( $dataObj->watermark->appid != $appid )
    {
        return $DecodeBase64Error;
    }
    $data = json_decode($result,true);
 
    return $data;
}
 
/**
 * 请求过程中因为编码原因+号变成了空格
 * 需要用下面的方法转换回来
 */
function define_str_replace($data)
{
    return str_replace(' ','+',$data);
}
function showjson($arr){
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
    exit();
}
function msg($status,$msg){
    echo json_encode(['status'=>$status,'msg'=>$msg],JSON_UNESCAPED_UNICODE);
    exit();
}
function ueditor_img_src($content = ''){
    return str_replace('<img src="','<img src="'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]",$content);
}
function get_star_name($star){
    if($star == 2){
        return '二星月嫂';
    }else if($star == 3){
        return '三星月嫂';
    }else if($star == 4){
        return '四星月嫂';
    }else if($star == 5){
        return '五星月嫂';
    }else if($star == 6){
        return '六星月嫂';
    }else if($star == 7){
        return '金牌月嫂';
    }else if($star == 8){
        return '月子管家';
    }else{
		return '暂无等级';
	}
}
	/**
	 * 用户post方法请求xml信息用的
	 * @author write by leoyi 2018-04-8
	*/
	function postXmlCurl($xml, $url, $useCert = false, $second = 10)
	{
	    $ch = curl_init();
	    //设置超时
	    curl_setopt($ch, CURLOPT_TIMEOUT, $second);
	    curl_setopt($ch,CURLOPT_URL, $url);
	    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
	    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//严格校验2
	    //设置header
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);
	    //要求结果为字符串且输出到屏幕上
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_POST, TRUE);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	    //运行curl
	    $data = curl_exec($ch);
	    //返回结果
	    if($data){
	      curl_close($ch);
	      return $data;
	    } else {
	      $error = curl_errno($ch);
	      curl_close($ch);
	      return $error;
	    }
	}
	/*
	*   用于微信支付转换认证的信息用的
	*   by:leoyi
	*   date:2018-4-8
	*/
	function ToUrlParams($data)
	{
	  $buff = "";
	  foreach ($data as $k => $v)
	  {
	    if($k != "sign" && $v != "" && !is_array($v)){
	      $buff .= $k . "=" . $v . "&";
	    }
	  }

	  $buff = trim($buff, "&");
	  return $buff;
	}
	/*
	*   微信支付-数组转xml
	*   by:leoyi
	*   date:2018-4-8
	*/
	function arrayToXml($arr)
	{
	    $xml = "<xml>";
	    foreach ($arr as $key=>$val)
	    {
	        if (is_numeric($val)){
	            $xml.="<".$key.">".$val."</".$key.">";
	        }else{
	             $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
	        }
	    }
	    $xml.="</xml>";
	    return $xml;
	}
	/*
	*   微信支付-数组转xml
	*   by:leoyi
	*   date:2018-4-8
	*/
	function  xml_to_json($xmlstring) {
	    return json_encode(xml_to_array($xmlstring),JSON_UNESCAPED_UNICODE);
	}
	/*
	*   post方法
	*   by:leoyi
	*   date:2018-4-8
	*/
	function post_url($post_data, $url)
	{
	  $ch = curl_init();
	  //设置超时
	  curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	  curl_setopt($ch,CURLOPT_URL, $url);

	  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
	  curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//严格校验2

	  curl_setopt($ch, CURLOPT_HEADER, FALSE);

	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);


	  curl_setopt($ch, CURLOPT_POST, TRUE);
	  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

	  $data = curl_exec($ch);
	  curl_close($ch);
	  return $data;
	}
	/*
	* 把xml转换成array
	* by:leoyi
	* Date:2018-4-11
	*/
	function xml_to_array($xml) {
	    //return ((array) simplexml_load_string($xmlstring));
	  return simplexml_load_string($xml,'SimpleXMLElement',LIBXML_NOCDATA);

	    //return json_decode(xml_to_json($xmlstring));
	}
	function domain_name(){
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
	}
	function star_value($star = ''){
		$res = \think\Db::name('commission_setting')->where('star',$star)->find();
		if(!empty($res)){
			return $res['proportion'];
		}else{
			return 0;
		}
	}
	function matron_time_arrange($id){
		/*应前端要求，参数格式如下，=,=
        [
            {'date':'2019-09-01','price':'已约'},
            {'date':'2019-09-02','price':'已约'},
            {'date':'2019-09-03','price':'已约'}
        ]
		*/
		$order = \think\Db::name('order')
        ->field(['start_time','end_time'])
        ->where('matron_id',$id)
        ->where("end_time",'>=',strtotime(date('Y-m-').'1'))
        ->where("start_time",'<=',strtotime(date('Y-m-',strtotime("+1 year")).'30'))
        ->where('(status=0 or status=1 or status=2 or status=4)')
        ->select();
		$data = [];
		foreach($order as $k => $v){
            $start_time = $v['start_time'];
            $end_time = $v['end_time'];
            while($start_time<=$end_time){
                $data[] = ['date'=>date('Y-m-d',$start_time),'price'=>'●'];
                $start_time += 86400;
            }
		}
		return $data;
	}