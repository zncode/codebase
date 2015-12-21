<?php
/* HTML部分*/ 
// <div class='form-group'>
// <input type="text" name="verify_code" class="form-control input-sm" placeholder="验证码" required>
// </div>

// <div class='form-group text-left'>
// <img src="/?site=manager&ctl=login&act=verifycode"/>
// </div>

require_once('library/verifycode.class.php');

//检车验证码
$lib_verifycode = new lib_verifycode();
$check_res      = $lib_verifycode->check_code($verify_code);
if (!$check_res) {
    $this->show_message_crm('验证码错误','?site=manager&ctl=login&act=login');
}

/**
 * 生成验证码
 * @author shiyao2@leju.com
 * @date 2015-10-26
 */
function verifycode()
{
    $lib_verifycode = new lib_verifycode('verify_code',60,28);
    $lib_verifycode->get_math_code();
}
