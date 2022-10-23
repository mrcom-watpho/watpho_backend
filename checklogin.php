<?php
include("include/dbconnect.php");
$db = new DB();
$username = $_POST['txt_username'];
$password = md5($_POST['txt_password']);

if(isset($_POST['btn_login'])){
    $sql_check = " SELECT id, fname, lname, email, password, address, status,type,user_image
    FROM  tb_user
    WHERE (email = N'".$username."') AND (password = N'".$password."')";
    $db->Execute($sql_check);
   // echo $sql_check;
   $data = $db->getData();
  // echo $data['id'];
    if($data['id'] != ""){
        $emp_fullname = $data['fname']." ".$data['lname'];
        $imageUser = $data['user_image'];
        setcookie("idUsert", $data['id'], time()+(86400 * 30));
        setcookie("emp_fullname", $emp_fullname, time()+(86400 * 30));
        setcookie("auth", $data['type'], time()+3600);
        setcookie("imageUser", $imageUser, time()+(86400 * 30));
        $url = "main.php";
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=".$url."\" />";
    }else{
        $url = "login.php";
        echo "<script>alert('username or password ไม่ถูกต้อง');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"1; URL=".$url."\" />";
    }
}
?>