<?php

/**
     * 获取我的商品
     */
    public function goods_give(){
        $sql = "SELECT b.id, a.user_id, a.order_id, b.gid as goods_id,b.give_status,c.name as product_name,c.price,d.name as artist_name, e.receiver_name, e.receiver_mobile from win_order as a "
            ." LEFT JOIN win_order_goods as b ON a.order_id = b.order_id"
            ." LEFT JOIN win_goods as c ON b.gid = c.id"
            ." LEFT JOIN win_artist as d ON c.artist_id = d.id"
            ." LEFT JOIN win_goods_give as e ON a.order_id = e.order_id"
            ." where a.user_id = {$this->user_id}";


        $Model = new \Think\Model();
        $goods = $Model->query($sql);
        foreach($goods as $k1 => $good){
            foreach($good as $k2 => $value){
                if($value == null){
                    $good[$k2] = "";
                }
            }
            $goods[$k1] = $good;
        }

        $user = M('user')->where(array('user_id'=>$this->user_id))->find();
        $mobile = $user['username'];
        $data['mobile_title'] = $this->account_hide_string($mobile);
        $data['mobile_number'] = $mobile;
        $data['goods'] = $goods;
        $this->jsonArr($data);

    }
