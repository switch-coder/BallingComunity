<?php

session_start();

include 'mysqldb.php';

$id = $_POST['inputUserame'];
$pw = $_POST['inputpassword'];

$query = "SELECT * FROM user WHERE userID ='$id'";
$result = $db->query($query);

if(mysqli_num_rows($result)==1){
  $row=mysqli_fetch_assoc($result);

  if($row['password']==$pw){
    $_SESSION['userid']=$id;
    $_SESSION['userNickname']=$row['nickname'];
    $_SESSION['userImage']=$row['userImage'];
    $_SESSION['user_num']=$row['num'];
    if(isset($_SESSION['userid']) || isset($_SESSION['userNickname'])){
      ?>
      <script>
          // alert("로그인 되었습니다.");
          location.replace("./main.php");
          </script>
<?php

    }
    else{
      echo"session fail";
    }
  }else{
    ?><script>
    alert("아이디 혹은 비밀번호가 잘못되었습니다.");
    history.back();
    </script>
    <?php
  }
}else{
  ?><script>
  alert("아이디 혹은 비밀번호가 잘못되었습니다.");
  history.back();
  </script>
  <?php
   error_reporting(E_ALL);
   ini_set('display_errors', '1');

 
  
}
?>