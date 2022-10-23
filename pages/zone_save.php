<?php
$db = new DB();
 $id = $_POST['id'];
 $zone_name = $_POST['zone_name'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO tb_zone(id, zone_name) ";
    $sql .= " VALUES ('".$id."','".$zone_name."') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=zone';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_zone ";
    $sql .= " SET zone_name = '".$zone_name."' ";
    $sql .= " WHERE id = '".$id."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=zone';</script>";
}

?>