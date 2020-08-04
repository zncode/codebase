#!/bin/bash
index="/www/wwwroot/hb_new/${1}/index.php"
userini="/www/wwwroot/hb_new/${1}/.user.ini"
 
if [ ! -f "$index" ];then
  echo "index文件不存在"
  exit
fi
if [ ! -x "$index" ];then
  echo "index无执行权限"
  exit
fi
if [ ! -f "$userini" ];then
  echo "userini文件不存在"
  exit 
fi
dayrui=`grep "define('FCPATH', dirname(__FILE__).'/dayrui/')" $index`
echo $dayrui     
exit     
if [ "$dayrui" -eq 0 ];then     27   sed -i "s#define('FCPATH', dirname(__FILE__).'/dayrui/');#define('FCPATH', dirname(__FILE__).'/../dayrui/');\define('MYPATH', WEBPATH.'dayrui/My/');\define('APPSPATH', WEBPATH.'dayrui/App/');        #g" $index     28   echo "成功-index.php内容替换完成！"     29 else
  echo "失败-index.php文件中未找到指定内容！"
fi
grep "/www/wwwroot/hb_new/dayrui/" $userini > /dev/null
if [ $? -eq 0 ];then
  echo "失败-.user.ini已经替换过!"
else
  chattr -i $userini
  echo ':/www/wwwroot/hb_new/dayrui/' >> $userini
  echo "成功-.user.ini替换完成！"
fi
