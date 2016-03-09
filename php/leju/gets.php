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

