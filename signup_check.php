<?php
include "mysqldb.php";



     $id = $_POST["inputid"]; 
     $pw =  $_POST["inputpassword"];
     $nickname = $_POST["nickname"];
     $email = $_POST["email"];
     $address1 = $_POST["sido1"];
     $address2 = $_POST["gugun1"];

    
     if (!mysqli_query($db,"INSERT INTO user (id, pw, nickname, email, address1, address2) VALUES ('$id', '$pw', '$nickname', '$email', '$address1', '$address2')")) {
      echo("Error description: " . mysqli_error($db));
    }

     $query = "insert into user (userID, password, nickname, email, address1, address2) 
                        values ('$id', '$pw', '$nickname', '$email', '$address1', '$address2')";


     $result = $db->query($query);

     if($result){
           $query = "create table u_$id( no int not null, post_no int not null,category varchar(10) not null, contents textarea ,day datetime, primary key (no)";
           if($db->query($query)){
            ?>      <script>
            alert('가입 되었습니다.');
            location.replace("./login.php");
            </script><?php
           }else{
                 ?><script>
            alert("fail").mysqli_error($db);
            </script><?php
           }
      

 }
else{
?>    <script>
      alert("fail").mysqli_error($db);
      </script>
<?php   }

mysqli_close($db);
?>
