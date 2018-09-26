<?php
    /**
     * 首页公告接口
     */
    public function noticeIndex(){
        if($this->redisDebug && ($noticeList = $this->redis->get('noticeList'))){
            $data = unserialize($noticeList);
        }else{
            $keyword = 'index_notice_app';
            $index_type = M("index_content")->where("keyword = '{$keyword}' ")->find();

            $contents = unserialize($index_type['content']);

            if (is_array($contents) && count($contents)) {
                foreach ($contents as $key => $value) {
                    if($value){
                        $id = $value;
                        $notice = M('notice')->where("id = {$id}")->find();

                        $create_time = $notice['create_time'];
                        $create_time = explode(' ', $create_time);
                        $create_time = explode('-', $create_time[0]);
                        $create_time = $create_time[1].'/'.$create_time[2];

                        $data[$key]['id']       = $id;
                        $data[$key]['title']    = mb_substr($notice['title'], 0, 20, 'UTF-8');
                        $data[$key]['date']   = $create_time;
                    }
                }
            }

            if($this->redisDebug){
                $data = serialize($data);
                $this->redis->set('noticeList', $data, RedisApi::$period);
                $data = unserialize($data);
            }
        }
        $this->jsonArr($data);
    }
