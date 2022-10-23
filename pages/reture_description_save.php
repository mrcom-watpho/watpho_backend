<?php
 $db = new DB();
 $Id_reture = $_POST['Id_reture'];
 $retureid = $_POST['reture_id'];
 $returename = $_POST['reture_name'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO tb_return_description(id, return_description) ";
    $sql .= " VALUES ('".$retureid."','".$returename."') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=reture_description';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_return_description ";
    $sql .= " SET return_description = '".$returename."' ";
    $sql .= " WHERE id = '".$Id_reture."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=reture_description';</script>";
}

?>