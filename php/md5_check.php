<?php

  $md5 = '111111';
  $md5_file = md5_file($path);
  if($md5 != $md5_file)
  {
      echo 'Md5 check failed!';
      return false;
  }
