<?php
$id = $_GET['id'];
 $sql = " UPDATE tb_water_stock ";
 $sql .= " SET total = '6' ";
 $sql .= " WHERE water_id = '".$id."' ";
 $db->Execute($sql);
 echo "<script>alert('Reset Success !!');</script>";
 echo "<script>window.location.href='main.php?t=setup&page=water_stock';</script>";
?>