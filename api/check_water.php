<?php
header("Content-type:application/json; charset=UTF-8");    
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 

include("../include/dbconnect.php");
$db = new DB();
$db2 = new DB();
$dbCK = new DB();

$json_data = array();
//file_put_contents('test.txt', file_get_contents('php://input'));
$json = trim(file_get_contents('php://input'), "\xEF\xBB\xBF");
$decode_json = json_decode($json);

$qrcode = $_GET['qrcode'];
$water_id = $_GET['water_id'];

/*
$sql6 = " SELECT TOP (1) id, station_id, total, status FROM tb_water_stock WHERE (total = 6) AND (water_id = $station) ORDER BY NEWID() ";
$db->Execute($sql6);
$w1 = $db->getData();

if($w1['id'] != ""){
    $id = $w1['id'];
    $station_id = $w1['station_id'];
    $total = $w1['total'];
}else{
    $sql5 = " SELECT TOP (1) id, water_id, station_id, total, status FROM tb_water_stock WHERE (total = 5) AND (water_id = $station) ORDER BY NEWID() ";
    $db->Execute($sql5);
    $w2 = $db->getData();

    if($w2['id'] != ""){
        $id = $w2['id'];
        $station_id = $w2['station_id'];
        $total = $w2['total'];
    }else{
        $sql4 = " SELECT TOP (1) id, water_id, station_id, total, status FROM tb_water_stock WHERE (total = 4) AND (water_id = $station) ORDER BY NEWID() ";
        $db->Execute($sql4);
        $w3 = $db->getData();

        if($w3['id'] != ""){
            $id = $w3['id'];
            $station_id = $w3['station_id'];
            $total = $w3['total'];
        }else{
            $sql3 = " SELECT TOP (1) id, water_id, station_id, total, status FROM tb_water_stock WHERE (total = 3) AND (water_id = $station) ORDER BY NEWID() ";
            $db->Execute($sql3);
            $w4 = $db->getData();

            if($w4['id'] != ""){
                $id = $w4['id'];
                $station_id = $w4['station_id'];
                $total = $w4['total'];
            }else{
                $sql2 = " SELECT TOP (1) id, water_id, station_id, total, status FROM tb_water_stock WHERE (total = 2) AND (water_id = $station) ORDER BY NEWID() ";
                $db->Execute($sql2);
                $w5 = $db->getData();

                if($w5['id'] != ""){
                    $id = $w5['id'];
                    $station_id = $w5['station_id'];
                    $total = $w5['total'];
                }else{
                    $sql1 = " SELECT TOP (1) id, water_id, station_id, total, status FROM tb_water_stock WHERE (total = 1) AND (water_id = $station) ORDER BY NEWID() ";
                    $db->Execute($sql1);
                    $w6 = $db->getData();
                    $id = $w6['id'];
                    $station_id = $w6['station_id'];
                    $total = $w6['total'];
                }
            }
        }
    }
}
*/

$dbCK->Execute(" SELECT * FROM tb_sales_qrcode WHERE qrcode = '".$qrcode."' and water_status = 0 ");
$ck_data = $dbCK->getData();

if($ck_data['qrcode'] != ""){
    $sql6 = " SELECT TOP (1) id, station_id, total, status FROM tb_water_stock WHERE (water_id = $water_id) and total > 0 ORDER BY id desc ";
    $db->Execute($sql6);
    $w1 = $db->getData();

    if($w1['id'] != ""){

        $id = $w1['id'];
        $station_id = $w1['station_id'];
        $total = $w1['total'];

        $db2->Execute(" INSERT INTO tb_water_transection(water_id, station_id, qrcode, create_date, status) VALUES ('".$water_id."', '".$station_id."', '".$qrcode."', GETDATE(), 1) ");
        $db2->Execute(" UPDATE tb_sales_qrcode SET water_status = 1, water_time = GETDATE() WHERE (qrcode = '".$qrcode."') ");

        $sqlStock = " UPDATE tb_water_stock
                    SET total = total - 1
                    WHERE (water_id = '".$water_id."') AND (station_id = '".$station_id."') ";

        $db2->Execute($sqlStock);
        
        $result_json = array(
            "id" => $id,
            "water_id" => $station,
            "station_id" => $station_id,
            "total" => $total
        );
        echo json_encode($result_json);
    }else{
        $db2->Execute(" INSERT INTO tb_water_transection(water_id, station_id, qrcode, create_date, status) VALUES ('".$water_id."', '0', '".$qrcode."', GETDATE(), 0) ");
        $result_json = array(
            "error" => $qrcode
        );
        echo json_encode($result_json);
    }
}else{
    $db2->Execute(" INSERT INTO tb_water_transection(water_id, station_id, qrcode, create_date, status) VALUES ('".$water_id."', '0', '".$qrcode."', GETDATE(), 0) ");
}
?>