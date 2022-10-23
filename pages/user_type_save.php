<?php
$db = new DB();
 $iduser_type_edit = $_POST['Id_usertypeEdit'];
 $idusertype = $_POST['user_type_id'];
 $typeuser = $_POST['user_type_name'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO tb_user_type(id, userType) ";
    $sql .= " VALUES ('".$idusertype."','".$typeuser."') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=user_type';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_user_type ";
    $sql .= " SET userType = '".$typeuser."' ";
    $sql .= " WHERE id = '".$iduser_type_edit."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=user_type';</script>";
}

?>