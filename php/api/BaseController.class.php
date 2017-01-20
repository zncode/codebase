<?php
namespace Home\Controller;

use Think\Controller;
use Think\Controller\RestController;

class BaseController extends RestController {

    protected $appSecret  = 'pio!lM)_5-x!k_ek4jpioFus83r2Q^Zo';         //秘钥
    protected $debug      = 0;                                          //debug=1 关闭签名验证

    /**
     * 验证签名
     */
    public function checkSign($params)
    {
      if($this->debug){
        return true;
      }

      $requestDebug = I('debug');
      if($requestDebug)
      {
        return true;
      }

      $signApp = $params['sign'];
      unset($params['sign']);

      $params['path'] = $this->getPath();

      ksort($params); 

      foreach ($params as $key => $value) {
        $paramsArray[] = $key.'='.$value;
      }

      $str = implode('&', $paramsArray);
      $str = $str.'&key='.$this->appSecret;

      $signServer  = strtoupper(md5($str));

      if($signApp != $signServer){
        $result = ['code'=>1, 'message'=>'Signature error', 'data'=>''];
        $this->response($result, 'json');
      }
      else{
        return true;
      }
    }

    /**
    * 获取当前路径
    */
    public function getPath($url){
      $fullPath = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
      $url      = parse_url($fullPath);
      $query    = substr($url['query'], 3);
      if(strpos($query, '&')){
        $query  = explode('&', $query);
        $path   =  $query[0];
      }
      else{
        $path = $query;
      }
      return $path;
    }

    /**
    * 生成随机数
    */
    function randomKeys($length)   
    {   
       $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ!@#$%^&*()-_=+';  
        for($i=0;$i<$length;$i++)   
        {   
            $random = mt_rand(0,76);
            $key .= $pattern{$random};
        }   
        return $key;   
    }   
}
