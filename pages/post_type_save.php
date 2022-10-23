<?php
 $db = new DB();
 $Id_posttype = $_POST['Id_posttype'];
 $ptypeid = $_POST['post_type_id'];
 $ptypename = $_POST['post_type_name'];
if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO  tb_pos_type(id, pos_type) ";
    $sql .= " VALUES ('".$ptypeid."','".$ptypename."') ";
    $db->Execute($sql);
    echo "<script>alert('Save Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=post_type';</script>";
}
else if(isset($_POST['btn_edit'])){
    $sql = " UPDATE tb_pos_type ";
    $sql .= " SET pos_type = '".$ptypename."' ";
    $sql .= " WHERE id = '".$Id_posttype."' ";
	$db->Execute($sql);
    echo "<script>alert('edit Success !!');</script>";
    echo "<script>window.location.href='main.php?t=setup&page=post_type';</script>";
}

?>