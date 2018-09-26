<?php

    /**
     * 公告详情
     */
    public function noticeInfo(){
        $id = I('id') ? I('id') : '';
        $notice = M('notice')->where("id = {$id}")->find();
        $data = "";

        if($notice){
            $data['id']            = $id;
            $data['title']         = $notice['title'];
            $data['content']       = $notice['content'];
            $data['date']          = $notice['create_time'];
        }

        $this->jsonArr($data);
    }
    
  ?>
