<?php
$db = new DB();
if($_GET['id'] != ""){
$sql = " DELETE FROM tb_water_stock ";
$sql .= " WHERE id = '".$_GET['id']."' and water_id = '".$_GET['idwaters']."' ";
$db->Execute($sql);
echo "<script>alert('delete Success !!');</script>";
echo "<script>window.location.href='main.php?t=setup&page=water_stock';</script>";
}
?>