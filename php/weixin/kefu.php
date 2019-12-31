<?php

public function kefu()
{
    //验证服务器地址有效性,验证通过后把代码注销
    /**$signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];
    $echoStr = $_GET['echostr'];
    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    if( $tmpStr == $signature ){
    echo $echoStr;exit;
    }else{
    return false;**/
    //接收客服消息
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    if (!empty($postStr) && is_string($postStr)) {
    $postArr = json_decode($postStr, true);
    $fromUsername = $postArr['FromUserName'];   //发送者openid
    if (!empty($postArr['MsgType']) && in_array($postArr['MsgType'], array("text", "image"))) {
        //若用户反馈的是图片消息
        if($postArr['MsgType'] == "image"){
            //微信输出的是二进制图片流，不支持小程序外部使用后，所以需要保存到自己服务。
            $dlImg = self::save_img($postArr['MediaId']);
            content  = $dlImg['img_url'];
        }else{
            //文字消息
            $content = $postArr['Content'];
    }
        //记录客服消息到数据库,同事发邮箱通知运营同事,根据个人具体业务做相应处理;
        // ....
 
    } else {//用户进入到客服消息页面
            self::send_message($fromUsername, "text", "您好,很高兴为您服务");
    }
 
    }
    echo "success";
    exit;
 
}
//回复微信客服消息
public function send_message($fromUsername, $msgType, $content)
{
    $data = array(
        "touser" => $fromUsername,
        "msgtype" => $msgType,
        "text" => array("content" => $content)
    );
 
 
    $json = self::json_encode($data);  //兼容php5.4以下json格式处理
    $access_token = self::get_access_token($this->app_id, $this->secret);
 
    /*
    * POST发送https请求客服接口api
    */
    $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $access_token;
    //以'json'格式发送post的https请求
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($json)) {
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($curl, CURLOPT_HTTPHEADER, $headers );
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
 
}
 
 
//保存接收到的图片消息
public function save_img($media_id){
$access_token = self::get_access_token($this->app_id,$this->secret);
//$media_id = CommonFunc::getStringParam("media_id");
$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$media_id";
$arr = $this->curl_file($url);
$dlres = $this->saveFile($arr);
return $dlres;
}
 
public  function get_access_token($appId = '', $appSecret = ''){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$appSecret";
        $result = file_get_contents($url);
        $result = json_decode($result,true);
        $accesstoken = $result['access_token'];
        return $accesstoken;
}
 
function curl_file($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_NOBODY, 0);                //只取body头
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//curl_exec执行成功后返回执行的结果；不设置的话，curl_exec执行成功则返回true
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
 
//保存图片到本地服务器
function saveFile($filecontent){
    $path = '/wx_kf/'.date("Ym")."/";
    $imgDir = IMG_ROAD.$path;
    if(!is_dir($imgDir))
    {
        if(!mkdir($imgDir,0777,true))
        {
            return array(
            'code'=>-1
            );
        }
    }
    //需要保存的图片名字；
    $name = date("dHis").CommonFunc::jetRandomStr(6).".png";
    $filename = $imgDir.$name;
    $local_file = fopen($filename, 'w');
    if (false !== $local_file){//不恒等于（恒等于=== 就是false只能等于false，而不等于0）
    if (false !== fwrite($local_file, $filecontent)) {
    fclose($local_file);
    }
    }
    $filename = PROJECT_IMG.$path.$name;
    return array('code'=>1,'img_url'=>$filename);
}
//json中文处理
function json_encode($array)
{
    if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    $str = json_encode($array);
    $str = preg_replace_callback("#\\\u([0-9a-f]{4})#i", function ($matchs) {
    return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
    }, $str);
    return $str;
    } else {
    return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}
