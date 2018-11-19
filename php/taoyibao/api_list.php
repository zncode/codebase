<?php 
public function noticeList(){
        $p = I('p') ? I('p') : "1";
        $size = I('size') ? I('size') : 10;

        $where = array('type'=>2);

        $count = M('notice')->where($where)->count();
        $num  = $size;
        $page = (string)ceil($count/$num);
        $page_start = ($p-1) * $size;
        $page_end = $size;

        $notices = M('notice')->where($where)->order('create_time desc')->limit($page_start, $page_end)->select();
        if($notices){
            foreach($notices as $key => $notice){
                $list[$key]['id']       = $notice['id'];
                $list[$key]['title']    = mb_substr($notice['title'], 0, 20, 'UTF-8');
                $list[$key]['date']     = $notice['create_time'];
            }
        }

        $lists['page']      = $page;
        $lists['sum']       = $count;
        $lists['content']   = $list;

        $this->jsonArr($lists);
    }

    /**
     * 画廊列表
     */
    public function gallery_list(){
        $p      = I('p') ? I('p') : "1";
        $size   = I('size') ? I('size') : 15;
        $sort   = I('sort') ? I('sort') : 0; //1=week 2=quarter 3=year 4=total_price

        if(I('user_id')){
            $user_id = I('user_id');
        }else{
            $user_id = UID;
        }
        $Model = new \Think\Model();

        $sql = "select a.id AS goods_id,a.price,a.size,a.name AS goods_name,c.order_id,c.order_sn,c.pay_time,d.name AS artist_name FROM win_goods AS a"
            ." LEFT JOIN win_order_goods b ON a.id = b.gid"
            ." LEFT JOIN win_order AS c ON b.order_id = c.order_id"
            ." LEFT JOIN win_artist AS d ON a.artist_id = d.id"
            ." where c.user_id = {$user_id} AND b.status = 0 AND c.pay_status = 1";

        $goods_sum = $Model->query($sql);
        $goods_total_price = 0;
        if(is_array($goods_sum) && count($goods_sum)){
            foreach($goods_sum as $key => $value){
                $goods_total_price += $value['price'];
            }

            $goods_week     = (string)round($goods_total_price*0.08/52,2);
            $goods_quater   = (string)($goods_total_price*0.01);
            $goods_year     = (string)($goods_total_price*0.12);
        }else{
            $goods_week     = '';
            $goods_quater   = '';
            $goods_year     = '';
        }

        $count      = count($goods_sum);
        $num        = $size;
        $page_sum   = (string)ceil($count/$num);
        $page_start = ($p-1) * $size;
        $page_end   = $size;

        $sql = "select a.id AS goods_id,a.price,a.size,a.name AS goods_name,a.thumb,c.order_id,c.order_sn,c.pay_time,d.name AS artist_name FROM win_goods AS a"
            ." LEFT JOIN win_order_goods b ON a.id = b.gid"
            ." LEFT JOIN win_order AS c ON b.order_id = c.order_id"
            ." LEFT JOIN win_artist AS d ON a.artist_id = d.id"
            ." where c.user_id = {$user_id} AND b.status = 0 AND c.pay_status = 1"
            ." ORDER BY c.pay_time DESC"
            ." LIMIT {$page_start}, {$page_end} ";

        $goods = $Model->query($sql);

        if($goods){
            foreach($goods as $key => $good){
                $goods[$key]['thumb']       = 'http://'.$_SERVER['HTTP_HOST'].$good['thumb'];
                $goods[$key]['pay_time']    = date('Y-m-d H:i:s', $good['pay_time']);
                $goods[$key]['week']        = (string)round($good['price']*0.08/52,2);
                $goods[$key]['quarter']     = (string)($good['price']*0.01);
                $goods[$key]['year']        = (string)($good['price']*0.12);
                $goods[$key]['total']       = (string)0;
            }
        }

        $user = M('user')->where(array('user_id'=>$user_id))->find();

        if($sort){
            switch ($sort){
                case 1:
                    $sort_type = 'week';
                    break;
                case 2:
                    $sort_type = 'quarter';
                    break;
                case 3:
                    $sort_type = 'year';
                    break;
                default:
                    $sort_type = 'week';
                    break;
            }
            $sort_count = count($goods);
            for($i=0;$i<$sort_count;$i++){
                for($j=0;$j<$sort_count;$j++){
                    if($goods[$j][$sort_type] < $goods[$j+1][$sort_type]){
                        $tmp = $goods[$j];
                        $goods[$j+1] = $goods[$j];
                        $goods[$j] = $tmp;
                    }
                }
            }
        }

        $lists['username']              = $user['nickname'];
        $lists['avatar']                =  'http://'.$_SERVER['HTTP_HOST'].$user['avatar'];
        $lists['goods_total_price']     = (string)$goods_total_price;
        $lists['profit_week']           = $goods_week;
        $lists['profit_quarter']        = $goods_quater;
        $lists['profit_year']           = $goods_year;
        $lists['profit_total']          = '0';
        $lists['goods_sum']             = (string)$count;
        $lists['page']                  = (string)$page_sum;
        $lists['list']                  = $goods;
        $this->jsonArr($lists);
    }
?>
