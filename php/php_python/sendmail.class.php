<?php

/**
 * SendMail.php
 * 
 * 发送邮件类
 *
 * Copyright (c) 2015 by http://blog.csdn.net/CleverCode
 *
 * modification history:
 * --------------------
 * 2015/5/18, by CleverCode, Create
 *
 */
class SendMail{

    /**
     * 发送邮件方法
     *
     * @param string $fromAddress 发件人,'clevercode@qq.com' 或者修改发件人名 'CleverCode<clevercode@qq.com>'
     * @param string $toAddress 收件人,多个收件人逗号分隔,'test1@qq.com,test2@qq.com,test3@qq.com....'， 或者 'test1<test1@qq.com>,test2<test2@qq.com>,....'
     * @param string $subject 标题
     * @param string $content 正文
     * @param string $fileList 附件，附件必须是绝对路径,多个附件逗号分隔。'/data/test1.txt,/data/test2.tar.gz,...'
     * @return string 成功返回'OK'，失败返回错误信息
     */
    public static function send($fromAddress, $toAddress, $subject = NULL, $content = NULL, $fileList = NULL){
        if (strlen($fromAddress) < 1 || strlen($toAddress) < 1) {
            return '$fromAddress or $toAddress can not be empty!';
        }
        // smtp服务器
        $smtpServer = 'smtp.qq.com';
        // 登录用户
        $username = 'clevercode@qq.com';
        // 登录密码
        $password = '123456';
        
        // 拼接命令字符串，实际是调用了/home/CleverCode/mail.py
        $cmd = "LANG=C && /usr/bin/python /home/CleverCode/mail.py";
        $cmd .= " -s '$smtpServer'";
        $cmd .= " -u '$username'";
        $cmd .= " -p '$password'";
        
        $cmd .= " -f '$fromAddress'";
        $cmd .= " -t '$toAddress'";
        
        if (isset($subject) && $subject != NULL) {
            $cmd .= " -S '$subject'";
        }
        
        if (isset($content) && $content != NULL) {
            $cmd .= " -c '$content'";
        }
        
        if (isset($fileList) && $fileList != NULL) {
            $cmd .= " -F '$fileList'";
        }
        
        // 执行命令
        exec($cmd, $out, $status);
        if ($status == 0) {
            return 'OK';
        } else {
            return "Error,Send Mail,$fromAddress,$toAddress,$subject,$content,$fileList ";
        }
        return 'OK';
    }
}
