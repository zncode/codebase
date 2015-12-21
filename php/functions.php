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
?>
