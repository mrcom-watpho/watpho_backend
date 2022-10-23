<?php
$db = new DB();
if($_GET['id'] != ""){
$sql = " DELETE FROM tb_pos_station ";
$sql .= " WHERE pos_id = '".$_GET['id']."' ";
$db->Execute($sql);
echo "<script>alert('delete Success !!');</script>";
echo "<script>window.location.href='main.php?t=setup&page=post_station';</script>";
}
?>