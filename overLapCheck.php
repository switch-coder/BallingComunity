<?php

session_start();
include 'mysqldb.php';


// isset은 변수값의 유무를 확인하는 함수
if(isset($_POST['key'])){
      $key = $_POST['key'];

      if( $key == "id"){
         $id = $_POST['id'];
         $query = "SELECT * FROM user WHERE userID ='$id'";
         $result = $db->query($query);
         if(mysqli_num_rows($result)==1){
            
           echo "1";
           
         }else{
           echo "2";
         }
      }else if($key == "nickname"){
         $nickname = $_POST['nickname'];
         $query = "SELECT * FROM user WHERE nickname ='$nickname'";
         $result = $db->query($query);
         if(mysqli_num_rows($result)==1){
            
            echo "1";
           
         }else{
            echo "2";
         }
      
      
      }
} else {
      echo "다시 시도해 주세요";
}


$key = $_POST["key"];





?>