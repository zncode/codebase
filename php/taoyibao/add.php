<?php

     /**
     * 赠送商品
     */
    public function goods_give_submit(){
        $code               = I('code');
        $user_id            = $this->user_id;
        $order_id           = I('order_id');
        $goods_id           = I('goods_id');
        $receiver_name      = I('receiver_name');
        $receiver_mobile    = I('receiver_mobile');
        $receiver_region    = I('receiver_region');
        $receiver_address   = I('receiver_address');
        $status             = 0;
        $create_time        = date('Y-m-d H:i:s');
        $give               = M('goods_give');

        if(!$code){
            $this->json("请填写验证码！",2);
        }
        if($code !=$_SESSION['PAYLINECODE']){
            $this->json("验证码错误！",2);
        }

        $data = array(
            'user_id'           => $user_id,
            'order_id'          => $order_id,
            'goods_id'          => $goods_id,
            'status'            => $status,
            'receiver_name'     => $receiver_name,
            'receiver_mobile'   => $receiver_mobile,
            'receiver_region'   => $receiver_region,
            'receiver_address'  => $receiver_address,
            'create_time'       => $create_time
        );

        if($give->add($data)){
            $this->json('赠送成功！',1);
        }else{
            $this->json('赠送失败！',2);
        }

    }
