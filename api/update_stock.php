<?php
header("Content-type:application/json; charset=UTF-8");    
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 

include("../include/dbconnect.php");
$dbCK = new DB();
$db = new DB();

$json_data = array();
//file_put_contents('test.txt', file_get_contents('php://input'));
$json = trim(file_get_contents('php://input'), "\xEF\xBB\xBF");
$decode_json = json_decode($json);

$water_id = $_GET['water_id'];
$id = $_GET['id'];
$station_id = $_GET['station_id'];
$qrcode = $_GET['qrcode'];

$dbCK->Execute(" SELECT * FROM tb_sales_qrcode WHERE qrcode = '".$qrcode."' and water_status = 0 ");
$ck_data = $dbCK->getData();

if($ck_data['qrcode'] != ""){
    $db->Execute(" INSERT INTO tb_water_transection(water_id, station_id, qrcode, create_date, status) VALUES ('".$water_id."', '".$station_id."', '".$qrcode."', GETDATE(), 1) ");
    $db->Execute(" UPDATE tb_sales_qrcode SET water_status = 1, water_time = GETDATE() WHERE (qrcode = '".$qrcode."') ");

    $sql6 = " UPDATE tb_water_stock
                SET total = total - 1
                WHERE (water_id = '".$water_id."') AND (station_id = '".$station_id."') ";
    $db->Execute($sql6);
    $w1 = $db->getData();
}

$result_json = array(
    "status" => 'OK'
);
echo json_encode($result_json);
?>