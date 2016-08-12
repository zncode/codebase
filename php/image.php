//输出图片到浏览器
function get($picname){
    $content = Storage::get('public/'.$picname);
    header("Content-Type: image/jpeg;text/html; charset=utf-8");
    echo $content;
    exit; 
}
