<?php
include_once('includes/database.php');
$db = new Database();
$db->Query('SELECT * FROM tb_sales');
while($row=$db->Read()){
    echo $row['sale_id'];
}
?>