<?php

$file = $_FILES;
$name = $file['upload_file']['name'];
$type = $file['upload_file']['type'];
$tmp_name = $file['upload_file']['tmp_name'];
$error = $file['upload_file']['error'];
$size = $file['upload_file']['size'];
if($size >104857600)
{
    echo 'upload file too big!';
}
$path = '/var/www/cloud.big.openfin.com/web/download/'.$name;
$result = move_uploaded_file($tmp_name, $path);
if($result)
{
    echo 'upload successful!';
}
else
{
    echo 'upload error';
}
