<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include("../includes/database.php");
$data=array('status'=>'OK','updateTime'=>date("Y-m-d H:i:s"));

$db = new DB();
$db2 = new DB();
$DateControl = 0;
$db->Query('SELECT pos_id, isnull(sum(total_price),0) as price,isnull(sum(pick_total),0) as ticket  FROM tb_sales WHERE CAST(sale_date AS DATE) = DATEADD(DAY,'.$DateControl.',CAST(GETDATE() as DATE)) GROUP BY pos_id');
$sumprice = '0';
$sumticket = '0';
$sumGroup = 0;
$POS=array();
while($row=$db->Read()){

    $sql_Group = " SELECT SUM(tb_sales_detail.ticket_total) AS total ";
    $sql_Group .= " FROM tb_sales_detail INNER JOIN ";
    $sql_Group .= " tb_sales ON tb_sales_detail.sale_id = tb_sales.sale_id ";
    $sql_Group .= " WHERE (tb_sales.pos_id = '".$row['pos_id']."') AND (tb_sales_detail.ticket_id = 2) AND (DAY(tb_sales.sale_date) = DAY(GETDATE())) AND (MONTH(tb_sales.sale_date) = MONTH(GETDATE())) AND(YEAR(tb_sales.sale_date) ";
    $sql_Group .= " = YEAR(GETDATE())) ";

    $db2->Query($sql_Group);
    while($row2=$db2->Read()){
        $ticket_group = $row2['total'];
        $sumGroup += $ticket_group;
    }

    $price =  $row['price'];
    $ticket = $row['ticket'];

    $diff = $ticket - $ticket_group;

    $POS[$row['pos_id']]=array(
        'price'=>number_format($price),
        'ticket_group'=>number_format($ticket_group),
        'ticket_diff'=>number_format($diff),
        'ticket'=>number_format($ticket)
    );
    $sumprice +=  $price;
    $sumticket += $ticket;
}

$diff_all = $sumticket - $sumGroup;

$db->Query('SELECT pos_id,isnull(sum(tb_sales_qrcode.door_status),0) as door,isnull(sum(water_status),0) as water,isnull(sum(return_status),0) as reticket  FROM tb_sales INNER JOIN tb_sales_qrcode ON tb_sales.sale_id=tb_sales_qrcode.sale_id WHERE CAST(sale_date AS DATE) = DATEADD(DAY,'.$DateControl.',CAST(GETDATE() as DATE)) GROUP BY pos_id');
$sumwater='0';
$sumdoor='0';
$sumreticket='0';
while($row=$db->Read()){
    $water =  $row['water'];
    $door =  $row['door'];
    $reticket = $row['reticket'];
    $POS[$row['pos_id']]['water']=number_format($water);
    $POS[$row['pos_id']]['door']=number_format($door);
    $POS[$row['pos_id']]['reticket']=number_format($reticket);
    $sumwater +=  $row['water'];
    $sumdoor +=  $row['door'];
    $sumreticket += $row['reticket'];
}

$db->Query('SELECT tb_pos_workcheck.pos_id,tb_pos_workcheck.work_type,tb_pos_workcheck.user_id,fname FROM tb_pos_workcheck INNER JOIN (SELECT pos_id,max(id) as id FROM tb_pos_workcheck WHERE CAST(create_date AS DATE) = DATEADD(DAY,'.$DateControl.',CAST(GETDATE() as DATE)) GROUP BY pos_id) tbp ON tbp.id = tb_pos_workcheck.id INNER JOIN tb_user ON tb_user.id = tb_pos_workcheck.user_id');
while($row=$db->Read()){
    if(isset($POS[$row['pos_id']]))
    $POS[$row['pos_id']]['fname']=$row['fname'];
}

$data['TotalDay']=array(
    'price'=>number_format($sumprice),
    'ticket'=>number_format($sumticket),
    'ticket_group'=>number_format($sumGroup),
    'ticket_diff'=>number_format($diff_all),
    'water'=>number_format($sumwater),
    'door'=>number_format($sumdoor),
    'reticket'=>number_format($sumreticket));

$data['POS']=array('data'=>$POS);
$txtNULL = 'OR sale_date is null';
$txtNULL = '';
$txtSQL="SELECT tb_pos_station.pos_location,tbs.* FROM tb_pos_station INNER JOIN (select tb_pos_station.pos_id,isnull(sum(total_price),0) as price,isnull(sum(pick_total),0) as ticket from tb_pos_station LEFT JOIN tb_sales ON tb_pos_station.pos_id=tb_sales.pos_id WHERE CAST(sale_date AS DATE) = CAST(GETDATE() AS DATE) $txtNULL GROUP BY tb_pos_station.pos_id) tbs ON tb_pos_station.pos_id=tbs.pos_id ORDER BY tb_pos_station.pos_id";
$db->Query($txtSQL);
$pos=array();
$total_price=0;
$total_ticket=0;
while($row=$db->Read()){
    $ticket = $row['ticket'];
    $price = $row['price'];
    $total_ticket+=$ticket;
    $total_price+=$price;
    $pos[]=array('pos_id'=>$row['pos_id'],'name'=>$row['pos_location'],'price'=>$price,'ticket'=>intval($ticket));
}
$data['posAll']=array('data'=>$pos,'total_ticket'=>$total_ticket,'total_price'=>$total_price);

$txtSQL="SELECT CAST(sale_date AS DATE) as saledate,sum(total_price) as price,sum(pick_total) as ticket FROM tb_sales WHERE CAST(sale_date as DATE) > DATEADD(DAY,-10,GETDATE()) GROUP BY CAST(sale_date AS DATE) ORDER BY CAST(sale_date AS DATE)";
$db->Query($txtSQL);
$chart=array();
while($row=$db->Read()){
    $chart[]=array('saledate'=>$row['saledate'],'price'=>$row['price'],'ticket'=>$row['ticket']);
}
$data['Chart']=array('data'=>$chart);

header("Content-Type:application/json; charset=UTF-8");
echo json_encode($data);
?>