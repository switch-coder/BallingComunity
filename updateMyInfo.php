<?php

session_start();
include 'mysqldb.php';

$key = $_POST["key"];
if(!isset($_SESSION["userid"])){
   ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php
 }else{
$id = $_SESSION["userid"];

$query = "SELECT * FROM user WHERE userID ='$id'";
$result = $db->query($query);
if( $key == "email"){//이메일 변경
   $email = $_POST["email"];

   if(mysqli_num_rows($result)==1){
     $row=mysqli_fetch_assoc($result);

     $temporarily = "update user set email = '$email' where userID = '$id'";
     $db->query($temporarily);
      ?>"이메일이 변경되었습니다."<?php
     
   }
}else if($key == "nickname"){//닉네임 변경
   $nickname = $_POST['nickname'];
   $nicknameQuery = "SELECT * FROM user WHERE nickname ='$nickname'";
   $overleap= $db->query($nicknameQuery);

   if(mysqli_num_rows($overleap)==1){
      ?>1<?php
   }else if(mysqli_num_rows($overleap)==0){

      if(mysqli_num_rows($result)==1){
         $row=mysqli_fetch_assoc($result);
         $temporarily = "update user set nickname = '$nickname' where userID = '$id'";
         $_SESSION['userNickname'] = $nickname;
         $db->query($temporarily);
          ?>2<?php
      }

   }

  


}else if($key == "Password"){//패스워드 변경

   $password = $_POST['password'];

   if(mysqli_num_rows($result)==1){
      $row=mysqli_fetch_assoc($result);
      $temporarily = "update user set password = '$password' where userID = '$id'";
      $db->query($temporarily);
       ?>"비밀번호가 변경되었습니다."<?php
   }

   
}else if($key == "image"){ // 프로필사진 변경
   if($_POST['default_key']=="default"){
      $image_file = "defaultUserImage.jpg";
      $temporarily = "update user set userImage = '$image_file' where userID = '$id'";
      $db->query($temporarily);
      $_SESSION["userImage"]= $image_file;
   }else{
      $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
      $path = "./userimg/";//사진폴더 위치
      $image_id = "image_";
      $image_file = time().$id.".jpg";//이미지 이름 지정

         if(isset($_FILES[$image_id]) && !$_FILES[$image_id]['error']) {
            if(in_array($_FILES[$image_id]['type'], $imageKind)) {
               if(move_uploaded_file($_FILES[$image_id]['tmp_name'],$path.$image_file)) {//이미지 업로드
                  if(mysqli_num_rows($result)==1){
                     $row=mysqli_fetch_assoc($result);
                     $temporarily = "update user set userImage = '$image_file' where userID = '$id'";
                     $db->query($temporarily);
                     $_SESSION["userImage"]= $image_file;
                     
                  echo "프로필사진이 변경되었습니다";
                  }
               } else {
                  echo "Error Upload Image ";//사진폴더 권한확인
               }
            } else {
               echo "이미지확장자가 아닙니다.";//이미지 타입
            }
         } else {
            echo "Image Upload Fail ";
         }
   }

}else if($key == "remove_id"){//회원탈퇴
   $password = $_POST["password"];
   if(mysqli_num_rows($result)==1){
      $row=mysqli_fetch_assoc($result);
      if($row["password"] == $password){
         $temporarily = "update user set password = '탈퇴회원' where userID = '$id'";
         $db->query($temporarily);
          session_destroy();
          echo("<script>location.herf=byebye.php; </script>");
          
      }else{
         echo "비밀번호가 일치하지 않습니다.";
      }
      
   }

}
}
?>