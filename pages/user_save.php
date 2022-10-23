<?php
$db = new DB();
 $iduserEdit = $_POST['id_userEdit'];
 $iduser = $_POST['User_id'];
 $nameuser = $_POST['User_name'];
 $lnameuser = $_POST['User_lname'];
 $emailuser = $_POST['User_Email'];
 $passworduser = $_POST['User_password'];
 $addressuser = $_POST['User_address'];
 $cityuser = $_POST['User_city'];
 $zipuser = $_POST['User_zip'];
 $phoneuser = $_POST['User_phone'];
 $stationuser = $_POST['User_station'];
 $typeuser = $_POST['User_type'];
 $new_images = "";

 ini_set('upload_max_filesize', '8M');
 $dd = date('Ymdhms');
 //$sn = $_GET['id'];
 if(trim($_FILES["image_file"]["tmp_name"]) != "")
 {
     $name_file = 
     $images = $_FILES["image_file"]["tmp_name"];
     $new_images = $dd."_".$_FILES["image_file"]["name"];
     copy($_FILES["image_file"]["tmp_name"],"uploads/".$dd."_".$_FILES["image_file"]["name"]);
     $width=128; //*** Fix Width & Heigh (Autu caculate) ***//
     $size=GetimageSize($images);
     $height=round($width*$size[1]/$size[0]);
     $images_orig = ImageCreateFromJPEG($images);
     $photoX = ImagesX($images_orig);
     $photoY = ImagesY($images_orig);
     $images_fin = ImageCreateTrueColor($width, $height);
     ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
     ImageJPEG($images_fin,"uploads/".$new_images);
     ImageDestroy($images_orig);
     ImageDestroy($images_fin);
 }
     $bb = new DB();
     $sql = " SELECT * FROM tb_user_type where id = '".$typeuser."'  ";
     $bb->Execute($sql);
     $hos_data = $bb->getData();  

if(isset($_POST['btn_save'])){
    $sql = " INSERT INTO tb_user(id, fname, lname, email, password, address, city, zip, phone, station, type, create_date, isActive, status,user_image,type_name_th) ";
    $sql .= " VALUES ('".$iduser."','".$nameuser."','".$lnameuser."','".$emailuser."','".md5($passworduser)."','".$addressuser."','".$cityuser."','".$zipuser."' ";
    $sql .= " ,'".$phoneuser."','".$stationuser."','".$typeuser."',getdate(),'1','1','".$new_images."','".$hos_data['userType']."' ) ";
    $db->Execute($sql);
   echo "<script>alert('Save Success !!');</script>";
   echo "<script>window.location.href='main.php?t=setup&page=user';</script>";

}
else if(isset($_POST['btn_edit'])){
    if($passworduser == "" && $new_images == ""){
        $sql = " UPDATE tb_user ";
        $sql .= " SET fname = '".$nameuser."',lname = '".$lnameuser."',email = '".$emailuser."',address = '".$addressuser."',city = '".$cityuser."' ";
        $sql .= " ,zip = '".$zipuser."',phone = '".$phoneuser."',station = '".$stationuser."',type = '".$typeuser."' ,type_name_th = '".$hos_data['userType']."'";
        $sql .= " WHERE id = '".$iduserEdit."' ";
    }else{
        $sql = " UPDATE tb_user ";
        $sql .= " SET fname = '".$nameuser."',lname = '".$lnameuser."',email = '".$emailuser."' ";
        if($passworduser != ""){
            $sql .= " ,password = '".md5($passworduser)."' ";
        }
        $sql .= " ,address = '".$addressuser."',city = '".$cityuser."' ";
        $sql .= " ,zip = '".$zipuser."',phone = '".$phoneuser."',station = '".$stationuser."',type = '".$typeuser."' ";
        if($new_images != ""){
            $sql .= " ,user_image = '".$new_images."' ";
        }
        $sql .= " ,type_name_th = '".$hos_data['userType']."' ";
        $sql .= " WHERE id = '".$iduserEdit."' ";
    }
	$db->Execute($sql);
    echo "<script>alert($new_images);</script>";
    echo "<script>window.location.href='main.php?t=setup&page=user';</script>";

}

?>