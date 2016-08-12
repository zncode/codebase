$type = $this->_request['type'];
$page = $this->_request['page'];
$page_size = $this->_request['page_size'];

switch($type)
{
    case 1:
        $shop = array(
            'id' => 1,
            'name' => '龙湾小包子',
            'address' => '龙湾商业大街牧歌铺子56号',
            'star' => 5,
            'price' => 168,
            'distance' => 1.5,
            'thumbnail' => 'image/1.jpg',
        );

    case 2:
        $shop = array(
            'id' => 1,
            'name' => '麦当劳',
            'address' => '东环商业大街牧歌铺子56号',
            'star' => 4,
            'price' => 115,
            'distance' => 1.8,
            'thumbnail' => 'image/2.jpg',
        );
    case 3:
        $shop = array(
            'id' => 1,
            'name' => '肯德基',
            'address' => '星光商业大街牧歌铺子56号',
            'star' => 4.5,
            'price' => 201,
            'distance' => 3.2,
            'thumbnail' => 'image/3.jpg',
        );

    case 4:
        $shop = array(
            'id' => 1,
            'name' => '永和大王',
            'address' => '富力商业大街牧歌铺子56号',
            'star' => 3.5,
            'price' => 305,
            'distance' => 9.5,
            'thumbnail' => 'image/4.jpg',
        );
    default:
            $shop = array(
                'id' => 1,
                'name' => '龙湾小包子',
                'address' => '龙湾商业大街牧歌铺子56号',
                'star' => 5,
                'price' => 168,
                'distance' => 1.5,
                'thumbnail' => 'image/1.jpg',
            );
        break;
}

for($i=1;$i<101;$i++)
{
    $shop['id'] = $i;
    $shops[] = $shop;
}

$i =0;
if($page < 1)
{
    $page = 1;
}

$shop_pages = array();

foreach($shops as $key => $shop_page)
{
    $start = ($page - 1) * $page_size;
    $end = $page * $page_size;
    if($start <= $key  && $key <= $end)
    {
        $shop_pages[] = (object)$shop_page;
    }
    $i++;
}

$data = array('code'=>0, 'msg'=>'success', 'data'=>(object)$shop_pages);
$data = json_encode($data);
return $data;
