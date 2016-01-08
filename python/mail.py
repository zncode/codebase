#!/usr/bin/python
# -*- coding:gbk -*- 
"""
   邮件发送类
"""
# mail.py
#
# Copyright (c) 2014 by http://blog.csdn.net/CleverCode
#
# modification history:
# --------------------
# 2014/8/15, by CleverCode, Create

import threading
import time
import random
from email.MIMEText import MIMEText
from email.MIMEMultipart import MIMEMultipart
from email.MIMEBase import MIMEBase
from email import Utils, Encoders
import mimetypes
import sys
import smtplib
import socket
import getopt
import os

class SendMail:
    def __init__(self,smtpServer,username,password):
        """
        smtpServer:smtp服务器,        
        username:登录名,
        password:登录密码
        """
        self.smtpServer = smtpServer        
        self.username = username
        self.password = password
    
    def genMsgInfo(self,fromAddress,toAddress,subject,content,fileList,\
            subtype = 'plain',charset = 'gb2312'):
        """
        组合消息发送包
        fromAddress:发件人,
        toAddress:收件人,
        subject:标题,
        content:正文,
        fileList:附件,
        subtype:plain或者html
        charset:编码
        """
        msg = MIMEMultipart()
        msg['From'] = fromAddress
        msg['To'] = toAddress  
        msg['Date'] = Utils.formatdate(localtime=1)
        msg['Message-ID'] = Utils.make_msgid()
        
        #标题
        if subject:
            msg['Subject'] = subject
        
        #内容        
        if content:
            body = MIMEText(content,subtype,charset)
            msg.attach(body)
        
        #附件
        if fileList:
            listArr = fileList.split(',')
            for item in listArr:
                
                #文件是否存在
                if os.path.isfile(item) == False:
                    continue
                    
                att = MIMEText(open(item).read(), 'base64', 'gb2312')
                att["Content-Type"] = 'application/octet-stream'
                #这里的filename邮件中显示什么名字
                filename = os.path.basename(item) 
                att["Content-Disposition"] = 'attachment; filename=' + filename
                msg.attach(att)
        
        return msg.as_string()                
                                                  
    def send(self,fromAddress,toAddress,subject = None,content = None,fileList = None,\
            subtype = 'plain',charset = 'gb2312'):
        """
        邮件发送函数
        fromAddress:发件人,
        toAddress:收件人,
        subject:标题
        content:正文
        fileList:附件列表
        subtype:plain或者html
        charset:编码
        """
        try:
            server = smtplib.SMTP(self.smtpServer)
            
            #登录
            try:
                server.login(self.username,self.password)
            except smtplib.SMTPException,e:
                return "ERROR:Authentication failed:",e
                            
            #发送邮件
            server.sendmail(fromAddress,toAddress.split(',') \
                ,self.genMsgInfo(fromAddress,toAddress,subject,content,fileList,subtype,charset))
            
            #退出
            server.quit()
        except (socket.gaierror,socket.error,socket.herror,smtplib.SMTPException),e:
            return "ERROR:Your mail send failed!",e
           
        return 'OK'


def usage():
    """
    使用帮助
    """
    print """Useage:%s [-h] -s <smtpServer> -u <username> -p <password> -f <fromAddress> -t <toAddress>  [-S <subject> -c
        <content> -F <fileList>]
        Mandatory arguments to long options are mandatory for short options too.
            -s, --smtpServer=  smpt.xxx.com.
            -u, --username=   Login SMTP server username.
            -p, --password=   Login SMTP server password.
            -f, --fromAddress=   Sets the name of the "from" person (i.e., the envelope sender of the mail).
            -t, --toAddress=   Addressee's address. -t "test@test.com,test1@test.com".          
            -S, --subject=  Mail subject.
            -c, --content=   Mail message.-c "content, ......."
            -F, --fileList=   Attachment file name.            
            -h, --help   Help documen.    
       """ %sys.argv[0]
        
def start():
    """
    
    """
    try:
        options,args = getopt.getopt(sys.argv[1:],"hs:u:p:f:t:S:c:F:","--help --smtpServer= --username= --password= --fromAddress= --toAddress= --subject= --content= --fileList=",)
    except getopt.GetoptError:
        usage()
        sys.exit(2)
        return
    
    smtpServer = None
    username = None
    password = None
               
    fromAddress = None    
    toAddress = None    
    subject = None
    content = None
    fileList = None
    
    #获取参数   
    for name,value in options:
        if name in ("-h","--help"):
            usage()
            return
        
        if name in ("-s","--smtpServer"):
            smtpServer = value
        
        if name in ("-u","--username"):
            username = value
        
        if name in ("-p","--password"):
            password = value
        
        if name in ("-f","--fromAddress"):
            fromAddress = value
        
        if name in ("-t","--toAddress"):
            toAddress = value
        
        if name in ("-S","--subject"):
            subject = value
        
        if name in ("-c","--content"):
            content = value
        
        if name in ("-F","--fileList"):
            fileList = value
    
    if smtpServer == None or username == None or password == None:
        print 'smtpServer or username or password can not be empty!'
        sys.exit(3)
           
    mail = SendMail(smtpServer,username,password)
    
    ret = mail.send(fromAddress,toAddress,subject,content,fileList)
    if ret != 'OK':
        print ret
        sys.exit(4)
    
    print 'OK'
    
    return 'OK'    
     
if __name__ == '__main__':
    
    start()
             
