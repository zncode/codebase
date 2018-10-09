<?php

    /**
     * 赠送订单列表
     * @author zhaoning
     */
    public function index_give(){
        $start_time     = I("get.start_time");  //开始日期1
        $end_time       = I("get.end_time");    //结束日期1
        $start_time2    = I("get.start_time2"); //开始日期2
        $end_time2      = I("get.end_time2");   //结束日期2
        $keywords       = I("get.keywords");    //关键字
        $Model          = M("order");

        if(!empty($start_time) && !empty($end_time)){
            $stime                  = strtotime($start_time." 00:00:00");
            $etime                  = strtotime($end_time." 23:59:59");
            $where['c.add_time']    = array(array("EGT",$stime),array("ELT",$etime));
            $this->start_time       = $start_time;
            $this->end_time         = $end_time;
        }
        if(!empty($start_time2) && !empty($end_time2)){
            $stime2                         = $start_time2." 00:00:00";
            $etime2                         = $end_time2." 23:59:59";
            $where['a.create_time']         = array(array("EGT", $stime2),array("ELT", $etime2));
            $this->start_time2              = $start_time2;
            $this->end_time2                = $end_time2;
            $order                          = "b.back_refund_time desc";
        }

        //关键字
        if(!empty($keywords)){
          $where['b.username|c.order_sn|d.name'] = array('like',"%$keywords%");
          $this->keywords = $keywords;
        }
        
        $count = $Model->table("win_goods_give a")
                    ->field("a.*")
                    ->join("win_user as b on a.user_id=b.user_id", 'left')
                    ->join("win_order as c on a.order_id=c.order_id", 'left')
                    ->join("win_goods as d on a.goods_id=d.id", 'left')
                    ->join("win_artist as e on d.artist_id=e.id", 'left')
                    ->where($where)
                    ->count();

        $Page   = new \Think\Page($count, 20);
        $show   = $Page->show();
        $order  = "a.create_time desc";
        $list   = $Model ->table("win_goods_give a")
                     ->field("a.id,a.order_id, a.user_id, a.goods_id,a.status,a.create_time,a.receiver_name,a.receiver_mobile,a.receiver_region,a.receiver_address,b.username,c.order_sn,c.add_time,c.total_price as order_price,d.name as goods_name,d.price as goods_price,e.name as artist_name")
                     ->join("win_user as b on a.user_id=b.user_id", 'left')
                     ->join("win_order as c on a.order_id=c.order_id", 'left')
                     ->join("win_goods as d on a.goods_id=d.id", 'left')
                     ->join("win_artist as e on d.artist_id=e.id", 'left')
                     ->where($where)
                     ->order($order)
                     ->limit($Page->firstRow.','.$Page->listRows)
                     ->select();

        $this->assign('page', $show);
        $this->list         = $list;
        $this->meta_title   = "赠送列表";
        $this->display();
    }
    
?>
