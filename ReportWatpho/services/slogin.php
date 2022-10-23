<?php
session_start();
include("../includes/database.php");
$User = $_POST['User'];
$Pass = $_POST['Pass'];
//$str = "123456";


//echo $User;
//echo md5($Pass);
//$str = "admin";
//echo md5($str);

$db = new DB();
$param = array();
$param[]=array('s',$User);
$param[]=array('s',md5($Pass));
$db->QueryParam('SELECT * FROM tb_user WHERE email=? AND password=?',$param);
$Type = '';
$Name = '';
while($row=$db->Read()){
    $Type =  $row['type'];
    $Name = $row['fname'];
    $Lname = $row['lname'];
}
if($Type==''){
    $data = array('status'=>'Fail');
}else{
    $data = array('status'=>'OK','Name'=>$Name);
    $_SESSION['session_name']=$Name;
    $_SESSION['session_lname']=$Lname;
    $_SESSION['cookie_session']='OK';
}
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($data);
?>