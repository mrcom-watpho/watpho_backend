<?php
header("Content-type:application/json; charset=UTF-8");    
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 

include("../include/dbconnect.php");
$db = new DB();

$json_data = array();
//file_put_contents('test.txt', file_get_contents('php://input'));
$json = trim(file_get_contents('php://input'), "\xEF\xBB\xBF");
$decode_json = json_decode($json);

$qrcode = $_GET['qrcode'];



$sql = " SELECT id, qrcode, door_status, door_time, water_status, water_time, return_status, return_date
            FROM tb_sales_qrcode
            WHERE (qrcode = '".$qrcode."') order by create_date desc ";

$db->Execute($sql);
$data = $db->getData();

if($data['return_status'] == "1"){
    $result_json = array(
        "status" => 'error',
        "message_text" => 'คืนบัตรแล้ว',
    );
    echo json_encode($result_json);
}else if($data['return_status'] == "0"){
    if($data['water_status'] == "0"){
        $result_json = array(
            "status" => 'ok',
            "message_text" => 'ยังไม่ได้รับ',
        );
        echo json_encode($result_json);
    }else{
        $result_json = array(
            "status" => 'error',
            "message_text" => 'รับน้ำแล้ว',
        );
        echo json_encode($result_json);
    }
}else{
    $result_json = array(
            "status" => 'error',
            "message_text" => 'ไม่พบข้อมูล',
        );
        echo json_encode($result_json);
}



?>