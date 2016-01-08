<?php

/**
 * test.php
 *
 * 压缩excel成附件，发送邮件
 *
 * Copyright (c) 2015 http://blog.csdn.net/CleverCode
 *
 * modification history:
 * --------------------
 * 2015/5/14, by CleverCode, Create
 *
 */
include_once ('SendMail.php');

/*
 * 客户端类
 * 让客户端和业务逻辑尽可能的分离，降低页面逻辑和业务逻辑算法的耦合，
 * 使业务逻辑的算法更具有可移植性
 */
class Client{

    public function main(){
        
        // 发送者
        $fromAddress = 'CleverCode<clevercode@qq.com>';
        
        // 接收者
        $toAddress = 'all@qq.com';
        
        // 标题
        $subject = '这里是标题！';
        
        // 正文
        $content = "您好：\r\n";
        $content .= "   这里是正文\r\n ";
        
        // excel路径
        $filePath = dirname(__FILE__) . '/excel';
        $sdate = date('Y-m-d');
        $PreName = 'CleverCode_' . $sdate;
        
        // 文件名
        $fileName = $filePath . '/' . $PreName . '.xls';
        
        // 压缩excel文件
        $cmd = "cd $filePath && zip $PreName.zip $PreName.xls";
        exec($cmd, $out, $status);
        $fileList = $filePath . '/' . $PreName . '.zip';
        
        // 发送邮件（附件为压缩后的文件）
        $ret = SendMail::send($fromAddress, $toAddress, $subject, $content, $fileList);
        if ($ret != 'OK') {
            return $ret;
        }
        
        return 'OK';
    }
}

/**
 * 程序入口
 */
function start(){
    $client = new Client();
    $client->main();
}

start();

?>
