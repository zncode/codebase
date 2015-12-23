<?php

/**
 * 遍历一个文件夹下的所有文件和子文件夹
 */
function listDir($dir = '.'){
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle))) {
			if($file == '.' || $file == '..'){
				continue;
			}
			if(is_dir($sub_dir = realpath($dir.'/'.$file))){
				echo 'FILE in PATH:'.$dir.':'.$file.'<br>';
				listDir($sub_dir);
			}else{
				echo 'FILE:'.$file.'<br>';
			}
		}
		closedir($handle);
	}
}
 
listDir('e:\www\abc');

?>
