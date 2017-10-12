#! /bin/bash
dir=$(ls -l /data/www/learning_system/Public/Uploads/rework/ | awk '/^d/ {print $NF}')
for i in $dir
do
strA=$i
strB=$1
result=$(echo $strA | grep "${strB}")
  if [[ "$result" != "" ]]
  then
    mv $i /data/oss/backup_rework/
    echo $i
  fi
done
