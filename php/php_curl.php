<?php

//Post json 
$data = array(
    'version'           => $version,
    'level'             => 10,
    'description'       => 'this is new version framework!',
    'md5'               => '9a7232f9a2a48f3fa5116f810475e01b',
);
$json_data = json_encode($data);
$url = 'http://xxx';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS,$json_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json_data))
);

$result = curl_exec($ch);
if (0 != curl_errno($ch)) {
    $result = "Error:\n" . curl_error($ch);
}
curl_close($ch);

//post upload file
// $fields['upload_file'] = '@/var/www/test/image.tar.gz';
$fields['upload_file'] = new CurlFile('/var/www/test/image.tar.gz');
$ch = curl_init();
$url = trim($result);
$url = str_replace('"', '', $url);
curl_setopt($ch, CURLOPT_URL,  $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
$result_upload = curl_exec($ch);
if (0 != curl_errno($ch)) {
    $result_upload = "Error:\n" . curl_error($ch);
}
curl_close($ch);

//get url
$ch = curl_init();
$url = "http://xxx";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array());
$result = curl_exec($ch);

if (0 != curl_errno($ch)) {
    $result = "Error:\n" . curl_error($ch);
}

curl_close($ch);


