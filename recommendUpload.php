<?php


session_start();
include 'mysqldb.php';


//키값 체크
if(!isset($_POST['key'])){
   echo 'error';
}else if(isset($_SESSION["userid"])){

   $key = $_POST["key"];
   $id = $_SESSION["userid"];
   $user_num = $_SESSION['user_num'];
   $date = date('Y-m-d H:i:s');
   $nickname = $_SESSION['userNickname'];
   $name = $_POST['title'];


   //글작성
   if($key == "upload"){
      $query_post = "select * from totalstore where name ='$name'"; //글번호 받아와서 community 테이블에서 글찾기
      $result = $db->query($query_post);


      $address = $_POST["addressValue"];// 주소
      $tel = $_POST["telValue"];// 전화번호
      $grade = $_POST["star"];//평점
      $line = $_POST["line"];//볼링장 레일수
      $line_condition = $_POST["line_quality"];//레일 상태
      $content = $_POST["smarteditor"];//레일 상태
      $price = $_POST["price"];//볼링장 가격
      $placesId = $_POST["placesId"];//카카오맵 장소id
      $placesx = $_POST["placesx"];//카카오맵 장소id
      $placesy = $_POST["placesy"];//카카오맵 장소id
      $hours = '';
      if(isset($_POST["hours"])){
         $hours = $_POST["hours"];//볼링장 운영시간
      }
      

      //새로운 볼링장인지 아닌지 체크
      if(mysqli_num_rows($result)==0){
         //새로 볼링장 데이터 입력
         //가게명,주소,전화번호,평가,라인수,라인상태 순으로 입력
         
         $query = "insert into totalstore (name, address, tel, grade,line,line_condition,price,hours,placesId,place_x,place_y) 
         values ('$name', '$address', '$tel','$grade','$line', '$line_condition','$price','$hours','$placesId','$placesx','$placesy')";

         // 데이터 넣기 검사
         if($db->query($query)){
            $post_no = mysqli_insert_id($db);
            //회원들 볼링장 평가 입력
            $query = "insert into evaluate (name, post_no,writer, rate, line, line_condition, price, content, tel,day) 
            values ('$name', '$post_no', '$nickname','$grade','$line', '$line_condition','$price','$content','$tel','$date')";
            
            if($db->query($query)){
               
               echo  "<script>location.replace('./recommend_detail.php?num_=$post_no')</script>";
            }else{
               echo '1fail'.mysqli_error($db);
            }

         }else{// 실패
         echo '2fail'.mysqli_error($db);
         }
      
      }else{// 값이 있을때 

         //post_no 값 가져오기
         $rows =mysqli_fetch_assoc($result);

         $post_no = $rows['no'];
         $search = "select * from evaluate where writer = '$nickname'";
         $result = $db->query($search);
         if(mysqli_num_rows($result)==0){
         //회원들 볼링장 평가 입력
         //rate /레일수 레일상태 더하기로 업데이트  입력수 +1  나중에 조회때 입려수 나누기 값들 = 평균값 1,2,3으로 나눠 비슷한값 보여주기
         $query = "insert into evaluate (name, post_no,writer, rate,line,line_condition,price,content,tel,day) 
         values ('$name', '$post_no', '$nickname','$grade','$line', '$line_condition','$price','$content','$tel','$date')";
         if($db->query($query)){
            
            //사람들이 가장 많이 입력한 가격찾기
            $query_post = "select price,count(price) as coun from evaluate group by price order by coun desc";
            $result = $db->query($query_post);
            $row=mysqli_fetch_row($result);
            $pri=$row[0];
            
            // 회원들의 평가 종합
            //ex) 평점 기존 1 이면 1+ 새로들어올 데이터값 2 =3 스택처럼 쌓고 카운트로 나눠서 값을 구한다
            $query = "update totalstore set price='$pri', grade=grade+'$grade', line_condition =line_condition+'$line_condition' , line = line+'$line',count =count+1 where no ='$post_no'";
            if($db->query($query)){
               echo  "<script>location.replace('./recommend_detail.php?num_=$post_no')</script>";
            }else{
               echo 'fail1'.mysqli_error($db);
            }
         }else{
            echo 'fail2'.mysqli_error($db);
         }
      }else{
         echo  "<script>alert('이미 추천한 볼링장입니다.');location.replace('./recommend.php')</script>";
      }

      }

   //글수정
   }else if($key=="update"){//수정

   }

}else{
   ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php

}



?>
