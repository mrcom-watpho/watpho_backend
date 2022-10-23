<?php
$db = new DB();
 $id = $_POST['id'];
 $water_id = $_POST['water_id'];
 $wsname = $_POST['water_stock_name'];
 $wsstation = $_POST['water_stock_station'];
 $wstotal = $_POST['water_stock_total'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO tb_water_stock(id, water_id, station_id, total, status) ";
    $sql .= " VALUES ('".$id."','".$wsname."','".$wsstation."','".$wstotal."','1') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=water_stock';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_water_stock ";
    $sql .= " SET station_id = '".$wsstation."',total = '".$wstotal."' ";
    $sql .= " WHERE id = '".$id."' and water_id = '".$water_id."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=water_stock';</script>";
}

?>