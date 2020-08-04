#!/bin/bash
base_dir="/www/wwwroot/$1/"
src_file="${base_dir}index.php"
time=$(date -d today +"%Y-%m-%d %H:%M:%S")
if [[ ! -d "$base_dir" ]] || [[ "$base_dir" == '/www/wwwroot/' ]];
then
  echo "根目录错误!"
  exit
fi

editFile(){
  if [ ! -f "$1" ];then
    echo "$1文件不存在"
    exit
  fi

  result=`grep "/dayrui/" $1`
  
  if [  "$result" != "" ];then
    echo "失败----${1}已经替换过!"
  else
#    chattr -i $1
#    sed -i 's#$#&:/www/wwwroot/dayrui/#1' $1
    echo "${time} 成功-${1}替换完成！" >> "${base_dir}dairui.log"
  fi
}

copyFile(){
  if [ ! -f "$2" ];then
    echo "$1文件不存在"
    exit
  fi

  if [ ! -x "$2" ];then
    echo "$1无执行权限"
    exit
  fi

 # cp -rf $1 $2
  echo "${time} $2覆盖完成!" >> "${base_dir}dairui.log"
}

dir=$(ls -l $base_dir |awk '/^d/ {print $NF}')
for i in $dir
do
  dayrui_dir="${base_dir}${i}/dayrui/"
  if [ -d "$dayrui_dir" ];then
    index_file="${base_dir}${i}/index.php"
    if [ -f "$index_file" ];then
     dst_file="${base_dir}${i}/index.php"
     userini="${base_dir}${i}/.user.ini"

     editFile $userini
     copyFile $src_file $dst_file
    fi
  fi
done
exit
