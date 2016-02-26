<?php

 public function loglist()
    {
        //权限判断
        $this->check_permis(__CLASS__,__FUNCTION__);

        //参数初始化 
        $search_controller      = lib_context::request('controller', lib_context::T_STRING, '');
        $search_action          = lib_context::request('action', lib_context::T_STRING, '');
        $search_start_time      = lib_context::request('start_time', lib_context::T_STRING, '');
        $search_end_time        = lib_context::request('end_time', lib_context::T_STRING, '');
        $search_code            = lib_context::request('code', lib_context::T_STRING, '');
        $search_keyword         = lib_context::request('keyword', lib_context::T_STRING, '');
        $search_keyword_value   = lib_context::request('keyword_value', lib_context::T_STRING, '');
        $search_type            = lib_context::request('type', lib_context::T_INT, 1);
        $page                   = lib_context::request('page', lib_context::T_INT, 0);


        $params = array();
        if($search_controller)
        {
            $params[] = "a.ctl = '{$search_controller}'";
        }
        if($search_action)
        {
            $params[] = "a.act = '{$search_action}'";
        }
        if($search_start_time && $search_end_time)
        {
            
            $start_time = explode('-', $search_start_time);
            $start_time = mktime(0,0,0,$start_time[1],$start_time[2],$start_time[0]);
            $end_time   = explode('-', $search_end_time);
            $end_time   = mktime(0,0,0,$end_time[1],$end_time[2],$end_time[0]);
            
            $params[] = "a.create_time > {$start_time}";
            $params[] = "a.create_time < {$end_time}";
        }
        if($search_code)
        {
            $params[] = "a.code = {$search_code}";
        }
        if($search_keyword && $search_keyword_value)
        {
            $params[] = "t.tag = {$search_keyword}";
            $params[] = "t.val = '{$search_keyword_value}'";
        }
        if($search_keyword && $search_keyword_value)
        {
            $order      = 'a.id DESC ';
            $logs       = $this->_module_log->get_logs_tag($params, $order, $page, 10, $search_type);
            $logs_count = $this->_module_log->get_logs_tag($params, $order, $page, 10, $search_type, 1);
            $page_html  = $this->getPage($logs_count, $page);


            foreach($logs as $key => $value)
            {
                if($value['tag'] == 1)
                {
                    $logs[$key]['tag_str'] = '结佣单';
                }
                if($value['tag'] == 2)
                {
                    $logs[$key]['tag_str'] = '立项';
                }
                if($value['tag'] == 3)
                {
                    $logs[$key]['tag_str'] = '订单';
                }

                $logs[$key]['data']           = unserialize(urldecode($value['data']));
            }
        }
        else
        {
            $order      = 'a.id DESC ';
            $logs       = $this->_module_log->get_logs($params, $order, $page, 10, $search_type);
            $logs_count = $this->_module_log->get_logs($params, $order, $page, 10, $search_type, 1);
            $page_html  = $this->getPage($logs_count, $page);

            foreach($logs as $key => $value)
            {
                $logs[$key]['data']           = unserialize(urldecode($value['data']));
            }
        }
        $this->assign("title",                  'API日志列表');
        $this->assign("page",                   $page_html,'NO_DENY');//分页数据$
        $this->assign("logs",                   $logs); 
        $this->assign("search_controller",      $search_controller); 
        $this->assign("search_action",          $search_action); 
        $this->assign("search_start_time",      $search_start_time); 
        $this->assign("search_end_time",        $search_end_time); 
        $this->assign("search_code",            $search_code); 
        $this->assign("search_keyword",         $search_keyword); 
        $this->assign("search_keyword_value",   $search_keyword_value);
        $this->assign("search_type",            $search_type);

        $this->display('log/log_list');
    }
    
     /**
     * 获取日志列表
     * $type = 1 查询异常表, = 2 查询API表
     * 
     */
    public function get_logs_tag($params = array(), $order='', $page=0, $page_size=10, $type=1, $count=false)
    {
        switch($type)
        {
            case 1:
            if($count)
            {
                $sql = "SELECT COUNT(a.id) as num FROM fnl_log_tags as t LEFT JOIN fnl_abnormal_log as a ON t.data_id = a.id ";
            }
            else{
                $sql = "SELECT t.tag, t.val, t.act, t.type, a.id, a.ctl, a.act, a.msg, a.create_time, a.data, a.code FROM fnl_log_tags as t LEFT JOIN fnl_abnormal_log as a ON t.data_id = a.id ";
            }
                break;
            case 2:
                if($count)
                {
                    $sql = "SELECT COUNT(a.id) as num FROM fnl_log_tags as t LEFT JOIN fnl_api_log as a ON t.data_id = a.id ";
                }
                else
                {
                    $sql = "SELECT t.tag, t.val, t.act, t.type, a.id, a.ctl, a.act, a.msg, a.create_time, a.data, a.code FROM fnl_log_tags as t LEFT JOIN fnl_api_log as a ON t.data_id = a.id ";
                }
                break;
        }

        if(count($params))
        {
            $where = ' WHERE ';
            $where .= implode(' AND ', $params);
            $sql   .= $where;
        }

        if($count)
        {
            $result = $this->_module_dboperate->fetchAll($sql);
            return $result[0]['num'];
        }

        if($order)
        {
            $sql .= " ORDER BY {$order}";
        }

        $sql .= " LIMIT {$page}, {$page_size}";
        $result = $this->_module_dboperate->fetchAll($sql);
        return $result;
    }

?>
