/* 远程上传图片 */
$curl = curl_init();     
$file = new CurlFile($upload['tmp_name']); 

$data = array('picture'=>$file, 'dir'=>$dir, 'name'=>$upload['name']);  

curl_setopt($curl, CURLOPT_URL, "http://img2.t.jiayou9.com/upload_image.php?debug=1");   
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    
curl_setopt($curl, CURLOPT_POST, true);    
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);   
$result = curl_exec($curl);    
curl_close($curl);
$upload_result = json_decode($result);

if($upload_result->code == 0){
    return $upload_result->data->file_path;
}else{
    return false;
}

/************ 服务器接收部分 ***********/
<?php
$debug = $_GET['debug'];
if(!$debug){
	echo json_encode(array('message'=>'目前只支持调试模式', 'file_path'=>''));die();
}

$dir        = '/var/www/img.t.jiayou9.com/upload/'.$_POST['dir'];
$name       = $_POST['name'];
$tmp_name   = $_FILES['picture']['tmp_name'];

$img_name = unique_name($dir);

$target = $dir .'/'. $img_name . get_filetype($name);
$file_path = 'upload/' . $_POST['dir'] .'/'. $img_name . get_filetype($name);

if(move_uploaded_file($tmp_name, $target))  
{   
    echo json_encode(array('code'=>0, 'message'=>'上传成功', 'data'=>array('file_path'=>$file_path))); 
    die();
}    
else  
{  
    echo json_encode(array('code'=>1, 'message'=>'上传失败', 'data'=>array($_FILES))); die();
    die();
}  

/**
 * 生成随机的数字串
 *
 * @author: weber liu
 * @return string
 */
function random_filename()
{
    $str = '';
    for($i = 0; $i < 9; $i++)
    {
        $str .= mt_rand(0, 9);
    }
   
    return time() . $str;
}

/**
 *  生成指定目录不重名的文件名
 *
 * @access  public
 * @param   string      $dir        要检查是否有同名文件的目录
 *
 * @return  string      文件名
 */
function unique_name($dir)
{
    $filename = '';
    while (empty($filename))
    {
        $filename = random_filename();

        if (file_exists($dir . $filename . '.jpg') || file_exists($dir . $filename . '.gif') || file_exists($dir . $filename . '.png'))
        {
            $filename = '';
        }
    }

    return $filename;
}

/**
 *  返回文件后缀名，如‘.php’
 *
 * @access  public
 * @param
 *
 * @return  string      文件后缀名
 */
function get_filetype($path)
{
    $pos = strrpos($path, '.');
    if ($pos !== false)
    {
        return substr($path, $pos);
    }
    else
    {
        return '';
    }
}
