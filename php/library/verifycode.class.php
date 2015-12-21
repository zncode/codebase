<?php
/**
 * 验证码类
 * @author yapeng1@leju.com
 *
 */
class lib_verifycode
{
    private $_width = 100;
    private $_height = 25;
    private $_code_key = '';
    public $lib_redis;
    public $lib_memcache;
    
	public function __construct($code_key = 'verify_code', $width= 100, $height = 25)
	{
        $local_session = session_id();
        if(empty($local_session)) session_start();

	    $this->_code_key = md5('admin_eld_' . $code_key . $_COOKIE["PHPSESSID"]);
	    //$this->lib_redis = new lib_base_redis();
	    $this->lib_memcache = new lib_base_memcache();
	}

	/**
	 * 获取数学验证码
	 */
	public function get_math_code()
	{
    	$im = imagecreate($this->_width, $this->_height);
    
    	//imagecolorallocate($im, 14, 114, 180); // background color
    	$red = imagecolorallocate($im, 255, 0, 0);
    	$white = imagecolorallocate($im, 255, 255, 255);
    
    	$num1 = mt_rand(1, 20);
    	$num2 = mt_rand(1, 20);
    
    	//计算结果
    	$ari_type = mt_rand(1, 3);
    	switch ($ari_type)
    	{
    		case 1:
    		    $arithmetic = '+';
    		    $code_result = $num1 + $num2;
    		    break;
		    case 2:
		        $arithmetic = '-';
		        if($num1 < $num2)
		        {
		        	$test_num = $num1;
		        	$num1 = $num2;
		        	$num2 = $test_num;
		        }
		        $code_result = $num1 - $num2;
		        break;
		    case 3:
		        $arithmetic = 'x';
		        $num1 = mt_rand(1, 9);
		        $num2 = mt_rand(1, 9);
		        $code_result = $num1 * $num2;
		        break;
    	}    	
    	
    	//存储数据
    	$this->lib_memcache->set($this->_code_key, $code_result, 300);
    	//$this->lib_redis->set($this->_code_key, $code_result);
    	//$this->lib_redis->setTimeout($this->_code_key, 1800);
    
    	$gray = imagecolorallocate($im, 118, 151, 199);
    	$black = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
    
    	//画背景
    	imagefilledrectangle($im, 0, 0, 100, 24, $black);
    	//在画布上随机生成大量点，起干扰作用;
    	for ($i = 0; $i < 80; $i++) {
    		imagesetpixel($im, rand(0, $this->_width), rand(0, $this->_height), $gray);
    	}
    
    	imagestring($im, 5, 5, 4, $num1, $red);
    	imagestring($im, 5, 30, 3, $arithmetic, $red);
    	imagestring($im, 5, 45, 4, $num2, $red);
    	imagestring($im, 5, 70, 3, "=", $red);
    	imagestring($im, 5, 80, 2, "?", $white);
    
    	header("Content-type: image/png");
    	imagepng($im);
    	imagedestroy($im);
    }
    
    /**
     * 检查验证码
     */
    public function check_code($code)
    {
    	$verify_code = $this->lib_memcache->get($this->_code_key);
    	//$verify_code = $this->lib_redis->get($this->_code_key);
    	if($verify_code && $verify_code == $code)
    	{
    		return true;
    	}
    	else 
    	{
    	    //删除验证码
    	    $this->lib_memcache->delete($this->_code_key);
    	    //$this->lib_redis->delete($this->_code_key);
    	}
    	
    	return false;
    }
	
}
