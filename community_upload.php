<?php
session_start();
include 'mysqldb.php';

if(isset($_SESSION["userid"])){
$key = $_POST["key"];
$id = $_SESSION["userid"];
$user_num = $_SESSION['user_num'];
$date = date('Y-m-d H:i:s');
$nickname = $_SESSION['userNickname'];

if($key == "post_upload"){//게시글 작성
   if(isset($_POST['title']) ||isset($_POST['category']) ||isset($_POST['smarteditor'])){
      $title = $_POST["title"];
      $category = $_POST["category"];
      $contents = $_POST["smarteditor"];

   
      $query = "insert into community (title, category, contents, user_no,day) 
                           values ('$title', '$category', '$contents','$user_num', '$date')";
      
      $result = $db->query($query);
      
      if($result){
         $incre = mysqli_insert_id($db);
        
         ?>
         <script>
            
            location.replace("./community_detail.php?num_=<?php echo $incre?>") 
         </script><?php
      
      }else{
         echo "다시 시도해주세요.";
      }
   }else{
      echo"post null";
   }
}else if( $key== 'post_update'){//게시글 수정
   if(isset($_POST['post_no']) ||isset($_POST['category']) ||isset($_POST['smarteditor'])){
      $post_no = $_POST['post_no'];
      $title = $_POST["title"];
      $category = $_POST["category"];
      $contents = $_POST["smarteditor"];
     
      $query = "update community set title ='$title', contents ='$contents' ,category ='$category',  update_post = '$date' where no ='$post_no'";
      $result = $db->query($query);
      if($result){
         
         
           echo  "<script>location.replace('./community_detail.php?num_=$post_no')</script>";
           
      }else{
         echo "오류".mysqli_error($db);
        
      }
   }else{
      echo"post null";
   }



}else if($key == 'post_remove'){//게시글 삭제
   $no =$_POST['post_no'];
   $query = "delete from community where no ='$no'";
   $result = $db->query($query);
   if($result){
     echo "1";
   }else{
     echo "2";
   }

}else if ($key == "reply"){//리플 작성
   if(!isset($_POST["post_title"])){
     echo "값없음";
   }
   
   $post_no = $_POST["post_no"];
   $post_title = $_POST["post_title"];
   $contents = $_POST["reply_contents"];
   
   $query = "insert into reply (post_no, post_title, user_no, contents,day) 
   values ('$post_no', '$post_title', '$user_num', '$contents','$date')";



   $result = $db->query($query);
   $err = mysqli_error($db);
   if($result === TRUE){
      $reply_num_incre = "update community set reply=reply+1 where no ='$post_no'";//게시글에 리플숫자 더하기
      $res = $db->query($reply_num_incre);
      if($res){
        echo "1";
      }else{
         echo "2";
      }
     
   }else{
      
      // echo "$err".mysqli_error($result);
      echo "error: " . $query . $db->error;
   
   }
}else if($key =="reply_modify"){//리플 수정
   $reply_no = $_POST["reply_no"];
   $contents = $_POST["text"];

   $query ="update reply set contents='$contents' where no = '$reply_no'";
   
   if($result = $db->query($query)){
     echo  "1";
   }else{
     echo  "2".mysqli_error($db);
   }

}else if($key =="reply_remove"){//리플 삭제
   if(!isset( $_POST["post_no"])){
      echo '값없음';
      return false;
   }
   $post_no = $_POST["post_no"];
   $reply_no = $_POST['reply_no'];
   $query = "delete from reply where no = '$reply_no'";

   $result = $db->query($query);
   if($result){
      $reply_num_incre = "update community set reply=reply-1 where no ='$post_no'";//게시글에 리플숫자 빼기
      $reply_result = $db->query($reply_num_incre);
      if($reply_result){
         echo "1";
       }else{
          echo "2".mysqli_error($db);
       }
     
   }else{
      // echo "$err".mysqli_error($result);
      echo "error: " . $query . $db->error;
   }
}else if($key =="like_cancel"){//좋아요 or 싫어요 취소

   $category = $_POST['category'];// 텍스트
   $post_no = $_POST['post_no'];
   $contents = $_POST['contents'];// like / unlike
   $query = "delete from u_$id where post_no = '$post_no' and category = '$category' and contents = '$contents'";
   $result = $db->query($query);

   if($result){
      $update ="update community set $contents=$contents-1 where no ='$post_no'";//게시글 좋아요/싫어요 숫자 빼기
      $db->query($update);
      echo "1";
   }else{
      echo "2".$contents.$category;
   }

}else if($key =="like_new"){//좋아요 or 싫어요
   $category = $_POST['category'];//비디오 / 텍스트
   $post_no = $_POST['post_no'];
   $contents = $_POST['contents'];// like / unlike
   $query = "insert into u_$id (post_no,category,contents,day) values ('$post_no','$category','$contents','$date')" ;
   $result = $db->query($query);

   if($result){ 
      $update ="update community set $contents=$contents+1 where no ='$post_no'";//게시글 좋아요/싫어요 숫자 더하기
      
      if($db->query($update)){
         echo "1";
      }else{
         echo "2".mysqli_error($db);
      }
      
   }else{
      echo "2".mysqli_error($db);
   }
}else if($key =="like_update"){// 좋아요/싫어요 바꾸기
   $now_contents = $_POST['now_contents'];
   $new_contents = $_POST['new_contents'];
   $post_no = $_POST['post_no'];
   $category = $_POST['category'];// like / unlike
   $query = "update u_$id set contents='$new_contents', day='$date' where post_no = '$post_no' and category = '$category' and contents='$now_contents' ";
   
   $result = $db->query($query);

   if($result){
      $update ="update community set $new_contents=$new_contents+1,$now_contents=$now_contents-1 where no ='$post_no'";//게시글 좋아요/싫어요 숫자 바꾸기
      $db->query($update);
         echo "1";
      }else{
         echo "2";
   }
}else if($key =="report"){//게시글 신고
  $post_no= $_POST['post_no'];
  $contents= $_POST['contents'];
  $typ= $_POST['typ'];
  $category= $_POST['category'];
  $writer_no = $_POST['writer_no'];
  $post_title = $_POST['post_title'];
  $query = "insert into report (post_no,post_title,repoter,category,contents,day,checked,writer_no,typ) values ('$post_no','$post_title','$nickname','$category','$contents','$date','검토중','$writer_no','$typ')" ;
  $result = $db->query($query);

  if($result){
     $update ="update community set report =report+1 where no ='$post_no'";//게시글 신고숫자 더하기
     $db->query($update);
     echo "1";
  }else{
     echo "2".mysqli_error($db);
  }
}else if($key =="v_post_upload"){//영상 게시글 작성
   if(isset($_POST['title']) ||isset($_POST['smarteditor'])){

      $title = $_POST["title"];
      $youtu_id = $_POST["youtu_id"];
      $youtu_url = $_POST["youtu_url"];
      $youtu_title = $_POST["youtu_title"];
      $contents = $_POST["smarteditor"];
      
      $query = "insert into v_community (title, youtu_id, youtu_title, youtu_url, contents, user_no,day) 
                           values ('$title', '$youtu_id', '$youtu_title', '$youtu_url', '$contents','$user_num', '$date')";
      $result = $db->query($query);
      if($result){
           $incre = mysqli_insert_id($db);

         ?><script>    
            location.replace("./v_community_detail.php?num_=<?php echo $incre?>") 
         </script><?php
      
      }else{
         echo "다시 시도해주세요.";
      }
   }else{
      echo"post null";
   }
}else if( $key== 'v_post_update'){//영상 게시글 수정
   if(isset($_POST['post_no'])  ||isset($_POST['smarteditor'])){
      $post_no = $_POST['post_no'];
      $title = $_POST["title"];
      $contents = $_POST["smarteditor"];
     
      $query = "update v_community set title ='$title', contents ='$contents' ,  update_post = '$date' where no ='$post_no'";
      $result = $db->query($query);
      if($result){
         
         
           echo  "<script>location.replace('./v_community_detail.php?num_=$post_no')</script>";
           
      }else{
         echo "오류".mysqli_error($db);
        
      }
   }else{
      echo"post null";
   }



}else if($key == 'v_post_remove'){//영상 게시글 삭제
   $no =$_POST['post_no'];
   $query = "delete from v_community where no ='$no'";
   $result = $db->query($query);
   if($result){
     echo "1";
   }else{
     echo "2";
   }

}else if ($key == "v_reply"){//영상 리플 작성
   if(!isset($_POST["post_title"])){
     echo "값없음";
   }
   $post_no = $_POST["post_no"];
   $post_title = $_POST["post_title"];
   $contents = $_POST["reply_contents"];
   
   $query = "insert into v_reply (post_no, post_title, user_no, contents,day) 
   values ('$post_no', '$post_title', '$user_num', '$contents','$date')";



   $result = $db->query($query);
   $err = mysqli_error($db);
   if($result === TRUE){
      $reply_num_incre = "update v_community set reply=reply+1 where no ='$post_no'";//게시글에 리플숫자 더하기
      $res = $db->query($reply_num_incre);
      if($res){
        echo "1";
      }else{
         echo "2";
      }
     
   }else{
      
      // echo "$err".mysqli_error($result);
      echo "error: " . $query . $db->error;
   
   }
}else if($key =="v_reply_modify"){//영상 리플 수정
   $reply_no = $_POST["reply_no"];
   $contents = $_POST["text"];

   $query ="update v_reply set contents='$contents' where no = '$reply_no'";
   
   if($result = $db->query($query)){
     echo  "1";
   }else{
     echo  "2".mysqli_error($db);
   }

}else if($key =="v_reply_remove"){//영상 리플 삭제
   
   $reply_no = $_POST['reply_no'];
   $post_no = $_POST['post_no'];

   $query = "delete from v_reply where no = '$reply_no'";

   $result = $db->query($query);
   if($result){
      $reply_num_incre = "update v_community set reply=reply-1 where no ='$post_no'";//게시글에 리플숫자 빼기
      $reply_result = $db->query($reply_num_incre);
      if($reply_result){
         echo "1";
       }else{
          echo "2".mysqli_error($db);
       }
   }else{
      echo "2".mysqli_error($db);;
   }

}else if($key =="v_like_cancel"){//영상 좋아요 or 싫어요 취소
   $contents =$_POST['contents'];
   $category = $_POST['category'];
   $post_no = $_POST['post_no'];
   $query = "delete from u_$id where post_no = '$post_no' and category = '$category' and contents = '$contents'";
   $result = $db->query($query);
   //category = 비디오 / 텍스트
   //contents = like / unlike
   if($result){
      $update ="update v_community set $contents=$contents-1 where no ='$post_no'";//게시글 좋아요/싫어요 숫자 빼기
      $db->query($update);
      echo "1";
   }else{
      echo "2";
   }

}else if($key =="v_like_new"){//영상좋아요 or 싫어요
   $category = $_POST['category'];//비디오 / 텍스트
   $contents = $_POST['contents'];//like / unlike  `  
   $post_no = $_POST['post_no'];//게시글 번호
   //category = 비디오 / 텍스트
   //contents = like / unlike
   $query = "insert into u_$id (post_no,category,contents,day) values ('$post_no','$category','$contents','$date')" ;
   $result = $db->query($query);

   if($result){
      $update ="update v_community set $contents=$contents+1 where no ='$post_no'";//게시글 좋아요/싫어요 숫자 더하기
      $db->query($update);
      echo "1";
   }else{
      echo "2";
   }
}else if($key =="v_like_update"){//영상 좋아요/싫어요 바꾸기
   $now_contents = $_POST['now_contents'];//
   $new_contents = $_POST['new_contents']; 
   $category = $_POST['category'];
   $post_no = $_POST['post_no'];
   $query = "update u_$id set contents='$new_contents', day='$date' where post_no = '$post_no' and category='$category' and contents ='$now_contents'";
   
   $result = $db->query($query);

   if($result){
      $update ="update v_community set $new_contents=$new_contents+1,$now_contents=$now_contents-1 where no ='$post_no'";//게시글 좋아요/싫어요 숫자 바꾸기
         if( $db->query($update)){
            echo "1";
         }else{
            echo "2".mysqli_error($db);
         }
        
      }else{
         echo "2".mysqli_error($db);
   }

}

}else{
  echo "로그인이 필요합니다."; 
}





?>