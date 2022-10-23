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

$water_id = $_GET['water_id'];

$sql6 = " UPDATE tb_water_stock
            SET total = 6
            WHERE (water_id = '".$water_id."') ";
$db->Execute($sql6);
$w1 = $db->getData();

$result_json = array(
    "status" => 'OK'
);
echo json_encode($result_json);
?>