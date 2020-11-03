<?php
  include 'mysqldb.php';
  $no = $_GET['num_'];
  $cookieName="community"+$no;
 

  $coo = $_COOKIE[$cookieName];

 if(empty($_COOKIE[$cookieName])){
  $views = "update community set view=view+1 where no ='$no'"; //조회수 증가
  $db->query($views); 
  setcookie($cookieName, 'no', time() + 3600);
  } ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Item - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <!-- Custom styles for this template -->
  <link href="bootstrap/css/shop-homepage.css" rel="stylesheet">

</head>
<style>
   .wrheader{
      margin : 80px 0px 10px 0px;
      border-bottom:5px solid #000066;
      
      
   }
   .writer{
      float:left;
      color : #5D5D5D;
      margin-top:5px;
   }
   .writer span{
      color : #000000
   }
   .ot{
      float:right;
      margin-bottom:20px;
   }
   textarea:focus {outline:none;}
   .bot-body{
      text-align:center;
     
   }
   .like-box{
    
    font-size:20px;
    display:flex;
    align-items:center;
    justify-content:flex-end;
    
    margin : 0px 0px 0px 0px;
   }
   .icon-btn{
      padding:0px 12px 0px 12px;
      font-size:50px;
      border:none;
   }
   .like-btn{
    margin:0px 15px 0px 3px;
   }
 
   .modal {
            display: none; /* Hidden by default */
            position: center; /* Stay in place */
            z-index: 10; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
   }
   .modal_content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 500px; /* Could be more or less, depending on screen size */
            z-index:11;                          
   }
[type="radio"] {
  border: 0;
  height: 1px; margin: -1px;
  padding: 0;
  position: absolute;
  width: 1px;
}
 
/* One radio button per line */
label {
  display: block;
  cursor: pointer;  /*hand view when on hover*/
  line-height: 2.5;
  font-size: 17px;
}
 
/* the basic, unchecked style */
[type="radio"] + span:before {
  content: '';
  display: inline-block;
  width: 17px;
  height: 17px;
  vertical-align: -0.25em;
  border-radius: 1em;           /*hard border*/
  border: 3px solid #FFFFFF;
  box-shadow: 0 0 0 2px #ADADAD;   /*light shadow*/
  margin-right: 0.75em;
  transition: 0.5s ease all;    /*animation here*/
}
 
/* the checked style using the :checked pseudo class */
[type="radio"]:checked + span:before {
  background: #33a2c6;
  box-shadow: 0 0 0 2px #33a2c6;
}

.guide{
font-size:14px;
color:#5C5C5C;
margin: 20px 0px 0px 0px;
}
.guide p{
  margin : 3px 0px 0px 0px;
}
 
/* body attributes here */
.my-4 a:hover{
  text-decoration:none;
  color:#000066
}
.col-lg-2{
  position:fixed;
}
  
</style>
<body>


<?php 
  $thisPage = 'commu';
  include 'navigationbar.php';
  include 'mysqldb.php';

  if(!isset($_GET['num_'])){
    ?><script>
    history.back();</script>
    <?php
  }
  $no = $_GET['num_'];
  $query_post = "select * from community where no ='$no'";           //글번호 받아와서 community 테이블에서 글찾기
      $result = $db->query($query_post);
      if(mysqli_num_rows($result)==0){
        ?><script>alert("잘못된 접근입니다.");history.back(); </script> <?php
      }
      $rows =mysqli_fetch_assoc($result);
      $cont = $rows['contents'];     
      $post_user_no = $rows['user_no'];                    //찾은글 row에 넣어주기 $rows[사용할쿼리];
    

  $query_reply = "select * from reply where post_no =$no"; // reply 테이블에서 댓글 찾기
  $reply_result = $db->query($query_reply);
  $query_user = "select * from user where num =$post_user_no"; // 유저닉네임 가져오기
            $user_result = $db->query($query_user);
            $user_rows = mysqli_fetch_assoc($user_result);
            $user_nickname = $user_rows['nickname'];
            
  $u_id=$_SESSION['userid'];                                  //유저 개인db에서 lilke/unlike 조회
  $text = "text";
  $user_db = "select * from u_$u_id where post_no = $no AND category = '$text' ";
  $u_result= $db ->query($user_db);
  $u_contents = '';


  if(!mysqli_num_rows($u_result)==0){
    $u_row = mysqli_fetch_assoc($u_result);
    $u_category = $u_row['category'];
    $u_contents = $u_row['contents'];
    
  };
 
?>
  
<input type="hidden" value="<?php echo $u_contents?>" id=u_contents>

  <!-- Page Content -->
  <div class="container" style="width:100%">

    <div class="row">

    <!--사이드바 -->
      <div class="col-lg-2" style="min-width:100px;margin-top:80px;">
        <h1 class="my-4 "><a  style="color:#000066;font-weight:800;" href="community.php?page=1">커뮤니티</a></h1>
       
        <div class="list-group">
          <a href="community.php?page=1" class="list-group-item active">일반 커뮤니티</a>
          <a href="v_community.php?page=1" class="list-group-item ">영상 커뮤니티</a>
          
        </div>
        <?php if(isset($_SESSION['user_num'])){?>
        <div class="list-group " style="margin-top:20px;">
          <a href="./community_write.php" class="list-group-item bg-dark text-center text-white">글쓰기</a>
        </div>
        <?php } ?>
      </div>
    <!-- /.col-lg-3 사이드바-->

      <div class="col-lg-10" style=min-width:600px;>

        
        <!-- 본문 -->
          <div class="card-body" style="min-width:600px;min-height:500px;">
         
             <div class="wrheader">
               <h3 class="card-title" id="title"><?php echo $rows['title'] ?><span style="float:right"><?php echo $user_nickname ?> </span></h3>
               <span class="writer"><span > <?php echo $rows['category']?> / <?php echo $rows['day'] ?></span></span>
               <span class="writer ot">좋아요 <?php echo $rows['like_'] ?>  /  조회수 <?php echo $rows['view'] ?> / 댓글 <?php echo $rows['reply'] ?></span>
             </div>
            <br/>

            <div >
               <!-- <h4><?php echo $rows['category'] ?></h4> -->
            </div>

            <div style="margin-top:50px;">
              <p class="card-text"><?php echo $rows['contents'] ?></p>
            </div>

          </div>
        <!-- /.card  본문끝-->

        <!-- 본문 바텀 신고/좋아요/싫어요/수정/삭제 -->
         <div class="bot-body">
            <div  class="like-box">
               <button type=button id="post_like" class="btn btn-outline-secondary" style="border:none;font-size:30px;" ><i class="far fa-thumbs-up"></i></button>
               <span class="like-btn"><?php echo $rows['like_'] ?></span>
               
           
               <button type=button id="post_unlike" class="btn btn-outline-secondary" style="border:none;font-size:30px;"><i class="far fa-thumbs-down" ></i></button>
               <span class="like-btn"><?php echo $rows['unlike_'] ?></span>
               <button type=button id="post_report" class="btn btn-outline-danger" style="border:none;font-size:30px;"><i class="fas fa-exclamation-triangle"></i></button>
               
               
              
            </div>
            <?php if($post_user_no==$_SESSION['user_num']){?>
            <div class="like-box" style="margin-top:15px;">
            <button type=button id="post_modify" class="btn btn-secondary" style="font-size:15px; margin-right:10px">수정</button>
            <button type=button id="post_remove" class="btn btn-secondary" style="font-size:15px  margin-right:10px">삭제</button>
            
            </div>
            <?php } ?>
          </div>
          <br>
        <!-- /본문 바텀 신고/좋아요/싫어요/수정/삭제 -->

        <!-- 리플 -->
        <div class="card card-outline-secondary my-4">
          <div class="card-header" >
            <h4>리플 </h4>
          </div>
          <div class="card-body">

          <!-- 리플보여주는칸 -->

            <?php while($reply_rows = mysqli_fetch_assoc($reply_result)){if($total%2==0){}else{}//리플 가져오기
            $user_no =$reply_rows['user_no'];$reply_no=$reply_rows['no'];
            $query_user = "select * from user where num ='$user_no'"; //댓글쓴 유저 닉네임찾기
            $user_result = $db->query($query_user);
            $user_rows = mysqli_fetch_assoc($user_result);
            $user_nickname = $user_rows['nickname'];
            ?>


            <div class="reply" id="reply_<?php echo $reply_no ?>">
              <p><?php echo $reply_rows['contents']; ?></p>
              <input type="hidden" id="reply_contents_<?php echo$reply_no; ?>" value="<?php echo $reply_rows['contents']; ?>">
              <small class="text-muted">Posted by <?php echo $user_nickname; ?>  <?php echo" "; echo$reply_rows['day']; ?>
              <?php if($reply_rows['user_no']==$_SESSION['user_num']){?>
                <button id="post_modify_btn<?php echo$reply_no?>" type=button class="btn btn-light btn-modify"style="font-size:13px;border:none" onclick="reply_modify('<?php echo $reply_no?>')" >수정</button>
              <?php } if($post_user_no==$_SESSION['user_num'] or $reply_rows['user_no']==$_SESSION['user_num']){?>
                <button id="post_remove_btn<?php echo$reply_no?>" type=button class="btn btn-light btn-modify" style="font-size:13px;border:none" onclick="reply_remove('<?php echo $reply_no?>')">삭제</button>
                <?php }?>
              </small>
            </div><!-- /리플보여주는칸 -->

            <!-- 리플수정칸 -->
            <div id="reply_modify_<?php echo $reply_no ?>" style="border:1px solid #1B1B1B; text-align:right;padding:10px 3px 10px 3px;display:none;">
               <textarea id="reply_text_<?php echo $reply_no ?>" name=reply_text_  cols=85 rows=15 style="border:none;width:100%;height:100px;resize:none"><?php echo $reply_rows['contents']; ?> </textarea>
               <div class="like-box" style="font-size:16px;">
               <span id=counter>(0 / 최대 200자)</span>
             
               <button type=button onclick="replyModifyBtn('<?php echo $reply_no ?>')" class="btn btn-outline-dark" style="font-size:17px;font-weight:900;margin-right:10px;margin-left:10px;" >리플수정</button>
               <button  type=button onclick="replyCancelBtn('<?php echo $reply_no ?>')" class="btn btn-outline-danger" style="font-size:17px;font-weight:900;margin-right:10px;margin-left:10px;" >취소</button></div>
            </div><hr><?php }?> <!-- /리플수정칸 -->
          
           <!-- 리플작성칸 -->
            <div style="border:1px solid #1B1B1B; text-align:right;padding:10px 3px 10px 3px;">
               <textarea id="reply" name=reply  cols=85 rows=15 style="border:none;width:100%;height:100px;resize:none" placeholder="(최소 5자 이상 입력해주세요)"> </textarea>
               <div class="like-box" style="font-size:16px;">
               <span id=counter>(0 / 최대 200자)</span>
               <button type=button id="reply-btn" class="btn btn-outline-dark" style="font-size:17px;font-weight:900;margin-right:10px;margin-left:10px;" >리플등록</button></div>
            </div>
          </div>
        </div>
        <!-- /.card 리플끝 -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->
  <div style="display:none">
    <form id="post_modify_form" name="post_modify_form" method="post" action='./community_write.php'>
            <input type=hidden value="<?php echo $no ?>" id="post_no" name="post_no" >
            <input type="hidden" value="<?php echo $rows['contents']?>" id="post_contents" name="post_contents">
            <input type=hidden value="<?php echo $rows['title']?>" id="post_title" name="post_title" >
            <input type=hidden value="<?php echo $rows['category']?>" id="post_category" name="post_category" >
    </form>
  </div>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

 

    </div>
  <!-- madal 모달창 -->
    <div id="myModal" class="modal" >
    
    <!-- Modal content -->
    <div class="modal_content" >
              <p style="text-align: center;"><span style="font-size: 14pt;"><b><span style="font-size: 24pt;">해당글 신고</span></b></span></p>
              <div class="report-1" id="report-1">
              <label for="radio-one">
              <input type="radio" value="성적인 콘텐츠" name="quality" id="radio-one"> <span>성적인 콘텐츠</span>
              </label><br/>
              
              <label for="radio-two">
              <input type="radio" value="폭력/혐오 콘텐츠" name="quality" id="radio-two"> <span>폭력/혐오 콘텐츠</span>
              </label><br/>
              
              <label for="radio-three">
              <input type="radio" value="아동학대 콘텐츠"  name="quality" id="radio-three" > <span>아동학대 콘텐츠</span>
              </label><br/>

              <label for="radio-four">
              <input type="radio" value="스팸 오해 소지 콘텐츠"  name="quality" id="radio-four" > <span>스팸/오해 소지 콘텐츠</span>
              </label><br/>

              <label for="radio-five">
              <input type="radio" value="기타"  name="quality" id="radio-five" > <span>기타</span>
              </label><br/>
              </div>
              <div class="report-2" id="report-2" style="display:none;">
              <label > *<span style="margin-bottom:30px;font-size:20px"id='report-category'></span></label>
              <hr style="margin: 30px 0px 0px 0px">
              <textarea id="report-contents" name="report-contents"cols=85 rows=15 style="width:100%;height:120px;resize:none" placeholder="추가 세부정보를 입력해주세요 (최소 10자이상)"></textarea>
              <span id=counter2>(0 / 최대 200자)</span>
              <div class="guide">
                <p>신고접수 관리자 및 글쓴이에게 통보되며 검토 후 조치됩니다.</p>
                <p>허위신고 및 장난신고 시 이용제한을 받을 수 있습니다.</p>
                <p>신고가 접수되면 취소 할 수 없습니다 신중히 신고하시기 바랍니다.</p>
              </div>
              </div>
              <hr style="margin: 30px 0px 10px 0px;background-color:#C2C2C2"/>
          <!-- <div style="cursor:pointer;background-color:#DDDDDD;text-align:left;padding-bottom: 10px;padding-top: 10px;" onClick="close_pop();"> -->
          <button type=button class="btn" id="modal-cancel" style="background-color:#fff;border:none;width:70px" >취소</button>
          <div class="report-1" style="float:right;margin-bottom:10px;">
          
          <button type=button class="btn btn-link" id="modal-next-1"  style="border:none;width:70px;margin-right:10px;" disabled>다음 <i class="fas fa-angle-right"></i></button>
          </div>
          <div class="report-2" style="margin-bottom:10px;display:none;float:right;">
          <button type=button class="btn" id="modal-previous-1"style="background-color:#fff;border:none;width:70px;"><i class="fas fa-angle-left"></i> 이전</button>
          <button type=button class="btn btn-link" id="modal-next-2"  style="border:none;width:70px;margin-right:10px;" disabled>신고</button>
          </div>
              
          
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
  //본문 수정
    $("#post_modify").click(function(e){
      e.preventDefault();
      if(confirm("게시글을 수정 하시겠습니까?")){
        
        document.post_modify_form.submit();
      }
    });
  //본문 삭제
    $("#post_remove").click(function(e){
      e.preventDefault();
      if(confirm("게시글을 삭제 하시겠습니까?")){
        var no =$("#post_no").val();
        var data = new FormData();
                data.append("key","post_remove");
                data.append("post_no",no);
                var xhr = new XMLHttpRequest();
                xhr.open("POST","community_upload.php");
                 xhr.onload = function(e) {
                     if(this.status == 200) {
                         if( e.currentTarget.responseText =="1"){
                          location.replace('./community.php?page=1');
                           return true;
                         }else{
                           alert("다시시도해주세요");
                           return false;
                         }
                         
                     }
                 }
                 xhr.send(data);
      }
    });

  //페이지 불러올때 like/unlike 체크
   $(document).ready(function(){
    var u_contents = $("#u_contents").val();
    
    // 카테고리 - 텍스트 
    // contents - like / unlike
    if(u_contents =="like_"){
      $("#post_like").attr('class','btn btn-outline-danger ');
    }else if(u_contents =="unlike_"){
      $("#post_unlike").attr('class','btn btn-outline-danger ');
    }
  
  //좋아요
    $("#post_like").click(function(e){
    e.preventDefault();
    var post_num = $("#post_no").val();
    if(u_contents =="like_"){//이미 좋아요 눌렸던상태 좋아요 삭제
      
       var data = new FormData();//데이터 통신
            data.append("key","like_cancel");
            data.append("post_no",post_num);
            data.append("contents","like_")
            data.append("category","text");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                      $("#post_like").attr('class','btn btn-outline-secondary');
                       location.reload();
                     }else{
                       alert("다시시도해주세요"+e.currentTarget.responseText);
                       return false;
                     }
                     
                 }
             }
             xhr.send(data);

    }else if(u_contents =="unlike_"){//싫어요 눌렸던상태 좋아요 업데이트
      
      var data = new FormData();//데이터 통신
            data.append("key","like_update");
            data.append("post_no",post_num);
            data.append("category","text");
            data.append("now_contents","unlike_");
            data.append("new_contents","like_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                     if( e.currentTarget.responseText =="1"){
                      $("#post_like").attr('class','btn btn-outline-danger ');
                      $("#post_unlike").attr('class','btn btn-outline-secondary');
                      location.reload();
                     }else{
                       alert("다시시도 해주세요");
                       return false;
                     }
                     
                 }
             }
        xhr.send(data);

    }else if(u_contents == ""){//아무것도 안눌렸던 상태 
      
      var data = new FormData();//데이터 통신
            data.append("key","like_new");
            data.append("post_no",post_num);
            data.append("category","text");
            data.append("contents","like_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                      $("#post_like").attr('class','btn btn-outline-danger ');
                      location.reload();
                     }else{
                       alert("다시 시도해주세요."+e.currentTarget.responseText);                       
                       return false;
                     }
                     
                 }
             }
             xhr.send(data);
    }
    });

  //싫어요
   $("#post_unlike").click(function(e){
      e.preventDefault();

    var post_num = $("#post_no").val();
    if(u_contents =="unlike_"){//이미 싫어요 눌렸던상태 delete
      
       var data = new FormData();//데이터 통신
            data.append("key","like_cancel");
            data.append("post_no",post_num);
            data.append("category","text");
            data.append("contents","unlike_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                      $("#post_unlike").attr('class','btn btn-outline-secondary');
                      location.reload();
                     }else{
                       alert("다시시도해주세요");
                       return false;
                     }
                     
                 }
             }
             xhr.send(data);

    }else if(u_contents =="like_"){//좋아요 눌렸던상태 싫어요 업데이트
      
      var data = new FormData();//데이터 통신
            data.append("key","like_update");
            data.append("post_no",post_num);
            data.append("category","text");
            data.append("now_contents","like_");
            data.append("new_contents","unlike_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                     if( e.currentTarget.responseText =="1"){
                      $("#post_unlike").attr('class','btn btn-outline-danger ');
                      $("#post_like").attr('class','btn btn-outline-secondary');
                      location.reload();
                     }else{
                       alert("다시시도 해주세요");
                       return false;
                     }
                     
                 }
             }
        xhr.send(data);

    }else if(u_contents == ""){//아무것도 안눌렸던 상태 
      
      var data = new FormData();//데이터 통신
            data.append("key","like_new");
            data.append("post_no",post_num);
            data.append("category","text");
            data.append("contents","unlike_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                      $("#post_unlike").attr('class','btn btn-outline-danger');
                      location.reload();
                     }else{
                       alert("다시 시도해주세요.");                       
                       return false;
                     }
                     
                 }
             }
             xhr.send(data);
    }
    });
  //신고
    //다이얼로그 띄우기
      $("#post_report").click(function(e){
        e.preventDefault();
        $("#myModal").show();
      })

    //취소버튼
      $("#modal-cancel").click(function(e){
        $('#myModal').hide();
        $(".report-1").css('display','');
        $(".report-2").css('display','none');
        $("#report-contents").val('');
      });

    //라디오체크시 다음버튼 활성화  
      $("input:radio[name=quality]").change(function(){
        $("#modal-next-1").prop('disabled',false);
      });

    //다음버튼
      $("#modal-next-1").click(function(e){
        e.preventDefault();
        var category = $("input:radio[name=quality]:checked").val();
        $("#report-category").text(category);
        $(".report-1").css('display','none');
        $(".report-2").css('display','');
        $("#modal-previous-1").css('display','');
        });

    //이전버튼  
      $("#modal-previous-1").click(function(e){
      e.preventDefault();
      var category = $("input:radio[name=quality]:checked").val();
      $("#report-category").text(category);
      $(".report-1").css('display','');
      $(".report-2").css('display','none');
      // $("input:radio[name=quality]:radio[value="category"]").prop("checked",false);
      $("#report-contents").val('');
      });
    //신고버튼
      $("#report-contents").keyup(function (e){//글자수 체크
        e.preventDefault;
        var content = $(this).val();
        $("#counter2").html("("+content.length+" / 최대 200자)");
       
       //10자넘으면 신고버튼 활성화
          if(content.length <10){
            $("#modal-next-2").prop('disabled',true);
          }else{
            $("#modal-next-2").prop('disabled',false);
          }

        //글자수 제한
          if(content.length >200){
            alert("최대 200자까지 입력 가능합니다.");
            $(this).val(content.substring(0,200));
            $('#counter').html("(200 / 최대 200자)");
          }
      });
    //신고버튼클릭시
      $("#modal-next-2").click(function(e){
        e.preventDefault();
        var writer_no = '<?php echo $post_user_no?>';
        var post_num = $("#post_no").val();
        var category = $("input:radio[name=quality]:checked").val();
        var contents = $("#report-contents").val();
        var post_title = $("#post_title").val();

         var data = new FormData();
              data.append("key","report");
              data.append("typ","일반");
              data.append("category",category);
              data.append("contents",contents);
              data.append("post_no",post_num);
              data.append("writer_no",writer_no);
              data.append("post_title",post_title);
              var xhr = new XMLHttpRequest();
              xhr.open("POST","community_upload.php");
               xhr.onload = function(e) {
                   if(this.status == 200) {
                  
                       if( e.currentTarget.responseText =="1"){
                        alert("신고 접수 되었습니다.");
                        $('#myModal').hide();
                        $(".report-1").css('display','');
                        $(".report-2").css('display','none');
                        $("#report-contents").val('');
                       }else{
                         alert("다시시도해주세요"+e.currentTarget.responseText);
                        
                       }
                       
                   }
               }
               xhr.send(data);

        });
      });
  //리플 수정

    function reply_modify(no){// 리플 수정
        $("#reply_"+no).css("display","none");
        $("#reply_modify_"+no).css("display","");
    }

    function reply_remove(no){// 리플 삭제
      
       

        if(confirm('리플을 삭제하시겠습니까?')){
          var post_no = $("#post_no").val();
         
          
          var data = new FormData();
                data.append("key","reply_remove");
                data.append("reply_no",no);
                data.append("post_no",post_no);
                var xhr = new XMLHttpRequest();
                xhr.open("POST","community_upload.php");
                 xhr.onload = function(e) {
                     if(this.status == 200) {
                         if( e.currentTarget.responseText =="1"){
                           window.location.reload();
                           return true;
                         }else{
                           alert("다시시도해주세요"+e.currentTarget.responseText);
                           return false;
                         }
                         
                     }
                 }
                 xhr.send(data);
        }
    }

    function replyCancelBtn(no){//리플 수정 취소
      $("#reply_"+no).css("display","");
      $("#reply_modify_"+no).css("display","none");
    }

    function replyModifyBtn(no){//리플 수정 확인버튼
      var text = $("#reply_text_"+no);
      var textValue = text.val();
   
      if(textValue.length <5){
        alert("리플은 5자이상 등록 가능합니다.");
        return false;
      }
      var post_no = $("#post_no").val();
      var post_title = $("#post_title").val();
      var data = new FormData();
                data.append("key","reply_modify");
                data.append("reply_no",no);
                data.append("text",textValue)
                var xhr = new XMLHttpRequest();
                xhr.open("POST","community_upload.php");
                 xhr.onload = function(e) {
                     if(this.status == 200) {
                         if( e.currentTarget.responseText =="1"){
                           window.location.reload();
                           return true;
                         }else{
                           alert("다시시도해주세요");
                           return false;
                         }
                         
                     }
                 }
                 xhr.send(data);
    }

   
  //리플 글자수체크
    $("#reply").keyup(function (e){
      var content = $(this).val();
      $("#counter").html("("+content.length+" / 최대 200자)");

      if(content.length <5){//5자 이상 썼을때 활성화
            $("#reply-btn").prop('disabled',true);
          }else{
            $("#reply-btn").prop('disabled',false);
      }

      if(content.length >200){
        alert("최대 200자까지 입력 가능합니다.");
        $(this).val(content.substring(0,200));
        $('#counter').html("(200 / 최대 200자)");
      }
    });

  //리플등록 버튼
    $("#reply-btn").click(function(e){
    
      var text = $("#reply");
      var textValue = text.val();
    
      if(textValue.length <5){
        alert("리플은 5자이상 등록 가능합니다.");
        return false;
      }
      var post_no = $("#post_no").val();//해당글 키값
      var post_title = $("#post_title").val();  //해당글 제목
      

      var data = new FormData();
            data.append("key","reply");//키값
            data.append("post_no",post_no);
            data.append("post_title",post_title);
            data.append("reply_contents",textValue);

            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
            xhr.onload = function(e) {
                if(this.status == 200) {
                
                    if( e.currentTarget.responseText =="1"){
                      window.location.reload();
                      return true;
                    }else if(e.currentTarget.responseText =="2"){
                      alert("댓글수 오류");
                      
                      
                      return false;
                    }else{
                      alert("댓글 오류"+e.currentTarget.responseText);
                      return false;
                    }
                    
                }
            }
            xhr.send(data);
    });

  </script>

</body>

</html>
