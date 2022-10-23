<?php
$db = new DB();
 $idwork_edit = $_POST['Id_workEdit'];
 $idwork = $_POST['work_id'];
 $typework = $_POST['work_type_name'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO tb_work_type(id, work_name) ";
    $sql .= " VALUES ('".$idwork."','".$typework."') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=work_type';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_work_type ";
    $sql .= " SET work_name = '".$typework."' ";
    $sql .= " WHERE id = '".$idwork_edit."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=work_type';</script>";
}

?>