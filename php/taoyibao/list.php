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
