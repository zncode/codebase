<?php 
  //获取微信信息
  $wx_appid       = $this->_module_variable->variable_get('wx_appid',     'wxeec8e7ef21c540e4');
  $wx_appsecret   = $this->_module_variable->variable_get('wx_appsecret', '8f10e981c2bb56e29a04e96c4cb6cfee');
  $wx_noncestr    = $this->_module_variable->variable_get('wx_noncestr',  '123456abc');

  //1. 获取access_token
  $api_access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$wx_appid}&secret={$wx_appsecret}";
  $access_token = json_decode(curl_get($api_access_token));
  $access_token = @$access_token->access_token;
  
  //2. 获取jssdk_ticket
  $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket";
  $params = "access_token={$access_token}&type=jsapi";
  $url_result = curl_get($url, $params);
  $url_result = json_decode($url_result);
  $wx_jssdk_ticket = @$url_result->ticket;
  
  //3. 生成签名
  $sig_str = 'jsapi_ticket='.$wx_jssdk_ticket;
  $sig_str .= '&noncestr='.$wx_noncestr;
  $sig_str .= '&timestamp='.$wx_timestamp;
  $sig_str .= '&url='.$wx_sig_url;
  $wx_signature = sha1($sig_str);
?>
