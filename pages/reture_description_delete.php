<?php
$db = new DB();
if($_GET['id'] != ""){
$sql = " DELETE FROM tb_return_description ";
$sql .= " WHERE id = '".$_GET['id']."' ";
$db->Execute($sql);
echo "<script>alert('delete Success !!');</script>";
echo "<script>window.location.href='main.php?t=setup&page=reture_description';</script>";
}
?>