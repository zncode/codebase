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

