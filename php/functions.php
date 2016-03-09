<?php 

/**
 * 验证邮箱格式
 * @param  $email
 */
function check_email($email){
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if ( preg_match( $pattern, $email ) )
    {
        return true;
    }
    else
    {
        return false;
    }    
}

/**
 * 验证手机号
 * @param unknown $mobile
 * @return number
 */
function check_mobile($mobile)
{
	//return preg_match("/1[0-9]{1}\d{9}$/",$mobile);
	//if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$mobile))
	if(preg_match ( '/^\d{10}$/', $mobile ))
	{
		return true;
	}
	else 
	{
		return false;
	}
}

/**
 * 生成倒计时时间戳-小时分秒
 * @param $time
 * @return string
 */
function tim2tim($out_time)
{
	$day = floor($out_time / 86400);
	$hour_time = $out_time - $day * 86400;
	$hour = floor($hour_time / 3600);
	$minute_time = $hour_time - $hour * 3600;
	$minute = floor($minute_time / 60);

	$string = $day.'天'.$hour.'小时'.$minute.'分钟';
	return $string;
}


/**
 * 提交GET请求，curl方法
 * @param string  $url	   请求url地址
 * @param mixed   $data	  GET数据,数组或类似id=1&k1=v1
 * @param array   $header	头信息
 * @param int	 $timeout   超时时间
 * @param int	 $port	  端口号
 * @return array			 请求结果,
 *							如果出错,返回结果为array('error'=>'','result'=>''),
 *							未出错，返回结果为array('result'=>''),
 */
function curl_get($url, $data = array(), $header = array(), $timeout = 5, $port = 80)
{
	$ch = curl_init();
	if (!empty($data)) {
		$data = is_array($data)?http_build_query($data): $data;
		$url .= (strpos($url,'?')?  '&': "?") . $data;
	}

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_POST, 0);
	//curl_setopt($ch, CURLOPT_PORT, $port);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1); //是否抓取跳转后的页面

	$result = curl_exec($ch);
	if (0 != curl_errno($ch)) {
		$result = "Error:\n" . curl_error($ch);

	}
	curl_close($ch);
	return $result;
}

/**
 * 提交POST请求，curl方法
 * @param string  $url	   请求url地址
 * @param mixed   $data	  POST数据,数组或类似id=1&k1=v1
 * @param array   $header	头信息
 * @param int	 $timeout   超时时间
 * @param int	 $port	  端口号
 * @return string			请求结果,
 *							如果出错,返回结果为array('error'=>'','result'=>''),
 *							未出错，返回结果为array('result'=>''),
 */
function curl_post($url, $data = array(), $header = array(), $timeout = 5, $port = 80)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	//curl_setopt($ch, CURLOPT_PORT, $port);
	!empty ($header) && curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$result = curl_exec($ch);
	if (0 != curl_errno($ch)) {
		$result  = "Error:\n" . curl_error($ch);
	}
	curl_close($ch);

	return $result;
}

/**
 *  curl put 上传文件
 * @param <type> $url		  请求url
 * @param <type> $file		 文件位置
 * @param <type> $filehandle   文件resource
 * @param <type> $header	   请求头
 * @param <type> $timeout	  请求超时限制
 * @param <type> $port		 请求端口
 * @return string
 */
function curl_put($url, $file,$filehandle, $header = array(), $timeout = 5, $port = 80)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	!empty ($header) && curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_PUT, 1);
	curl_setopt($ch, CURLOPT_INFILE, $filehandle);
	curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file));

	$result = curl_exec($ch);
	if (0 != curl_errno($ch)) {
		$result = "Error:\n" . curl_error($ch);

	}
	curl_close($ch);
	return $result;
}

/**
* 获取程序运行毫秒
* @author zhaoning@Leju.com
* @example
*   $time_start = millisecond_time();
*   usleep(10000);
*   $time_end = millisecond_time();
*   $time = $time_end - $time_start;
*/
function millisecond_time()
{
	list($usec, $sec) = explode(" ", microtime());
	$micro_time = ((float)$usec + (float)$sec);
	$time = round($micro_time, 3) * 1000;
	return (int)$time;
}

/**
* 隐藏手机号
* @param  $mobile
* @return
*/
function hide_mobile($mobile)
{
	return substr_replace($mobile,"****",4,4);
}

?>
