<?php
$db = new DB();
$Id_poststation = $_POST['Id_poststation']; 
$pos_type = $_POST['pos_type'];
$pos_zone = $_POST['pos_zone'];

 $pstationid = $_POST['post_station_id'];
 $pstationip = $_POST['post_station_ip'];
 $pstationlo = $_POST['post_station_location'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO  tb_pos_station(pos_id, pos_type, pos_zone, pos_ip, pos_location, create_date, create_by, status) ";
    $sql .= " VALUES ('".$pstationid."', '".$pos_type."', '".$pos_zone."','".$pstationip."','".$pstationlo."',getdate(),'".$_COOKIE['id']."','1') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=post_station';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_pos_station ";
    $sql .= " SET pos_ip = '".$pstationip."',pos_location = '".$pstationlo."', pos_type = '".$pos_type."', pos_zone = '".$pos_zone."' ";
    $sql .= " WHERE pos_id = '".$Id_poststation."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=post_station';</script>";
}

?>