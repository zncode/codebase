<?php

/**
 * 读取经纪公司
 * @author zhaoning@leju.com
 */
public function get_companys($params = array(), $order='', $page=0, $page_size=10, $count=false, $limit=true)
{
    if($count)
    {
        $sql = "SELECT COUNT(c.id) as num, b.city_id FROM fnl_broker_company AS c LEFT JOIN fnl_leju_branch AS b ON c.branch_id = b.id ";
    }
    else{
        $sql = "SELECT c.id,c.company_name,c.company_number,c.company_owner,c.status,c.create_time,c.branch_id,b.city_name,b.city_id FROM fnl_broker_company AS c LEFT JOIN fnl_leju_branch AS b ON c.branch_id = b.id ";
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
    if($page > 1)
    {
        $page = ($page-1)*$page_size;
    }
    else
    {
        $page = 0;
    }
    if($limit)
    {
        $sql .= " LIMIT {$page}, {$page_size}";
    }
    $result = $this->_module_dboperate->fetchAll($sql);
    return $result;
}

/**
* 获取日志列表
* $type = 1 查询异常表, = 2 查询API表
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
    if($page > 1)
    {
        $page = ($page-1)*$page_size;
    }
    else
    {
        $page = 0;
    }
    
    $sql .= " LIMIT {$page}, {$page_size}";
    $result = $this->_module_dboperate->fetchAll($sql);
    return $result;
}

 /**
     * 读取经纪人
     * @author zhaoning@leju.com
     */
    public function get_users($params = array(), $order='', $page=0, $page_size=10, $count=false, $limit=true)
    {
        $where = ' WHERE ';
        $main_table = "fnl_user AS u";
        $join_tabls[] = "fnl_broker_company AS c ON u.company_id = c.id";
        $join_tabls[] = "fnl_broker_shop AS s ON u.shop_id = s.id";
        $join_tabls[] = "fnl_leju_branch AS b ON c.branch_id = b.id";
        $join_table = implode(' LEFT JOIN ', $join_tables);
        $table = $main_table.' LEFT JOIN '.$join_table;

        if($count)
        {
            $columns[] = 'COUNT(u.id) AS num';
            $columns[] = 'b.city_id';
            $columns[] = 'u.user_name';
            $columns[] = 'u.real_name';
            $columns[] = 'u.certificate_status';
            
            $column = implode(', ', $columns);
            $sql = "SELECT {$column} FROM {$table} ";
            $result = $this->_module_dboperate->fetchAll($sql);
            return $result[0]['num'];
        }
        else{
            $columns[] = 'u.id';
            $columns[] = 'u.user_name';
            $columns[] = 'u.real_name';
            $columns[] = 'u.company_id';
            $columns[] = 'u.shop_id';
            $columns[] = 'u.certificate_status';
            $columns[] = 'u.status';
            $columns[] = 'u.create_time';
            $columns[] = 'c.company_name';
            $columns[] = 's.shop_name';
            $columns[] = 'b.city_id';
            $columns[] = 'b.city_name';
            $column = implode(', ', $columns);
            $sql = "SELECT {$column} FROM {$table} ";
        }

        if(count($params))
        {
            $where .= implode(' AND ', $params);
            $sql   .= $where;
        }

        if($order)
        {
            $sql .= " ORDER BY {$order}";
        }
        if($limit)
        {
            if($page > 1)
            {
                $page = ($page-1)*$page_size;
            }
            else
            {
                $page = 0;
            }
            $sql .= " LIMIT {$page}, {$page_size}";
        }
        $result = $this->_module_dboperate->fetchAll($sql);
        return $result;
    }

 /**
     * 二张表，带计数。
     * @author zhaoning <zhaoning@leju.com>
     * @return
     */
    public function get_project_abnormal_list_new($params='', $order='a.id DESC', $page=1, $page_size=PAGE_SIZE, $count=false, $limit=true)
    {
        $where = ' WHERE ';
        $main_table = "fnl_statistics_project_abnormal AS a";
        $join_table = "fnl_project AS p ON p.id = a.project_id";
        $table = $main_table.' LEFT JOIN '.$join_table;

        if($count)
        {
            $columns[] = 'a.*';
            $columns[] = 'p.start_time';
            $columns[] = 'p.end_time';
            $columns[] = 'COUNT(a.id) AS num';
            
            $column = implode(', ', $columns);
            $sql = "SELECT {$column} FROM {$table} ";
        }
        else{
            $columns[] = 'a.*';
            $columns[] = 'p.start_time';
            $columns[] = 'p.end_time';
            $column = implode(', ', $columns);
            $sql = "SELECT {$column} FROM {$table} ";
        }

        if(count($params))
        {
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
        if($limit)
        {
            if($page > 1)
            {
                $page = ($page-1)*$page_size;
            }
            else
            {
                $page = 0;
            }
            $sql .= " LIMIT {$page}, {$page_size}";
        }
        $result = $this->_module_dboperate->fetchAll($sql);
        return $result;
    }

?>
