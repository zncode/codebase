//获取目录下所有文件1
$dir = '/var/www/test';
if (is_dir($dir)) {
  if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
          $files[] = $file;
      } 
      closedir($dh);
  }
}

//获取目录下所有文件2
$files = scandir($dir);

