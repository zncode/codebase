//数组查找
$a = array('aaa', 'bbb', 'ccc');
$b = 'aaa'
if(in_array($b, $a)){
  echo 'found';
}else{
  echo 'not found';
}

//判断windows, linux
$windows = strtoupper(substr(PHP_OS,0,3))==='WIN'? 1: 0;
