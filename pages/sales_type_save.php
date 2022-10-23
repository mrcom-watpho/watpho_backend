<?php
 $db = new DB();
 $Id_Stype = $_POST['Id_Saletype'];
 $Stypeid = $_POST['sale_type_id'];
 $Stypename = $_POST['sale_type_name'];
 $Stypestatus = $_POST['sale_type_status'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO  tb_sales_type(id, sale_type, status) ";
    $sql .= " VALUES ('".$Stypeid."','".$Stypename."','".$Stypestatus."') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=sales_type';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_sales_type ";
    $sql .= " SET sale_type = '".$Stypename."', status = '".$Stypestatus."'  ";
    $sql .= " WHERE id = '".$Id_Stype."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=sales_type';</script>";
}

?>