<?php
$db = new DB();
 $idwater_edit = $_POST['Id_waterEdit'];
 $idwater = $_POST['water_id'];
 $namewater = $_POST['water_name'];
 $locationwater = $_POST['water_location'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO  tb_water(id, water_name, water_location, status) ";
    $sql .= " VALUES ('".$idwater."','".$namewater."','".$locationwater."','1') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=water';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE  tb_water ";
    $sql .= " SET water_name = '".$namewater."',water_location = '".$locationwater."' ";
    $sql .= " WHERE id = '".$idwater_edit."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=water';</script>";
}

?>