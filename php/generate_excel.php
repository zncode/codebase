require_once('lib_excel_exportexcel');
$excel = new lib_excel_ExportExcel('UTF-8', FALSE, '发起支付');
    
$excel_array[] = array ('佣金结算单ID', '城市', 'E信通ID', '项目名称','经纪公司', '付款公司', '订单号','联动佣金', '开发商额外提拥金额', '结拥金额', '付款时间', '财务编号', '结算单状态', '支付状态');
foreach($payments as $k=>$v){
    if($v['statement_status'] == 1){
        $statement_status = '未发起';
    }elseif ($v['statement_status'] == 2){
        $statement_status = '审核中';
    }elseif ($v['statement_status'] == 3){
        $statement_status = '已驳回';
    }elseif ($v['statement_status'] == 4){
        $statement_status = '已通过';
    }
    if($v['pay_status'] == 1){
        $pay_status = '未审核';
    }elseif ($v['pay_status'] == 2){
        $pay_status = '审核中';
    }elseif ($v['pay_status'] == 3){
        $pay_status = '已驳回';
    }elseif ($v['pay_status'] == 4){
        $pay_status = '已通过';
    }elseif ($v['pay_status'] == 5){
        $pay_status = '已支付';
    }
    
    if($v['chenxin_company_name_bak']){
        $chenxin_company_name = $v['chenxin_company_name_bak'];
    }else{
        $chenxin_company_name = $v['chenxin_company_name'];
    }
    
    $excel_array[] = array(
        $v['id'],
        $v['city_name'],
        $v['lx_id'],
        $v['project_name'],
        $v['company_name'],
        $v['chenxin_company_name'],
        $v['order_sn'],
        $v['commission'],
        $v['cash_commission'],
        $v['payment_amount'],
        '111',
        '222',
        $statement_status,
        $pay_status,
    );
}

$excel->addArray($excel_array);
$excel->generateXML('发起支付');
exit;
