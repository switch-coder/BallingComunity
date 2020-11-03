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
  .textover{
    
    overflow: hidden; 
    text-overflow: ellipsis; 
    display: -webkit-box;  
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical; 
    word-break: keep-all;
  }
  .textover:hover{
    
    overflow: initial ; 
    text-overflow: clip; 
    display:inline-block;
  }

  .fa-star{
    
    margin: 0px 10px 0px 10px;
  }
</style>
<body>


<?php 
  $thisPage = 'recom';
  include 'navigationbar.php';
  include 'mysqldb.php';
  

  if(!isset($_GET['num_'])){
    ?><script>
    history.back();</script>
    <?php
  }
  $no = $_GET['num_'];
  $query_post = "select * from totalstore where no ='$no'"; //글번호 받아와서 종합추천 테이블에서 글찾기
      $result = $db->query($query_post);
      if(mysqli_num_rows($result)==0){
        ?><script>alert("잘못된 접근입니다.");history.back(); </script> <?php
      }
      $rows =mysqli_fetch_assoc($result);
      $place = $rows['name'];     //볼링장 이름
      $address= $rows['address']; //볼링장 주소
      $tel = $rows['tel'];        //볼링장 전화번호
      $grade = $rows['grade'];    //볼링장 평점 
      $line = $rows['line'];      //볼링장 레일 수
      $line_condition = $rows['line_condition'];  //볼링장 레일상태
      $count = $rows['count'];      //회원들이 추천한 수
      $price = $rows['price'];      //볼링장 가격 (사람들이 가장많이 입력한 가격)
      $grade = ($grade/$count);
      $line = ($line/$count);
      $line_condition = ($line_condition/$count);


      $post_user_no = $rows['user_no'];                    //찾은글 row에 넣어주기 $rows[사용할쿼리];
      $views = "update v_community set view=view+1 where no ='$no'"; //조회수 증가
      $db->query($views); 
    
     
      
     
  $query_reply = "select * from evaluate where post_no ='$no'"; // reply 테이블에서 댓글 찾기
  $reply_result = $db->query($query_reply);
  $query_user = "select * from user where num ='$post_user_no'"; // 유저닉네임 가져오기
            $user_result = $db->query($query_user);
            $user_rows = mysqli_fetch_assoc($user_result);
            $user_nickname = $user_rows['nickname'];
            $user_img = "./userimg/".$_SESSION['userImage'];
            
  $u_id=$_SESSION['userid'];                                  //유저 개인db에서 lilke/unlike_ 조회
  $text = "video";
  $user_db = "select * from u_$u_id where post_no = $no AND category = '$text' ";
  $u_result= $db ->query($user_db);
  $u_contents = '';
          
          
  if(!mysqli_num_rows($u_result)==0){
    $u_row = mysqli_fetch_assoc($u_result);
    $u_category = $u_row['category'];
    $u_contents = $u_row['contents'];
  };
 

?>
  
  <input type=hidden value="<?php echo $u_contents?>" id="u_contents">
  <input type=hidden value="<?php echo $place?>" id="place">
  <input type=hidden value="<?php echo $grade?>" id="star">
  <input type=hidden value="<?php echo $line?>" id="line">
  <input type=hidden value="<?php echo $line_condition?>" id="line_quality">


  <!-- Page Content -->
  <div class="container" style="max-width:1400px;width:100%;padding-top:80px;margin-bottom:135px">

    <div class="row">

    <!--사이드바 -->
      <div class="col-lg-2" style="min-width:100px;margin-top:80px;">
        <h1 class="my-4 "><a  style="color:#000066;font-weight:800;" href="recommend.php?page=1">볼링장 </a></h1>
        <h1 class="my-4 "><a  style="color:#000066;font-weight:800;" href="recommend.php?page=1">추천</a></h1>
        <?php if(isset($_SESSION['user_num'])){?>
        <div class="list-group " style="margin-top:20px;">
          <a href="./recommendstore.php" class="list-group-item bg-dark text-center text-white">볼링장 추천하기</a>
        </div>
        <?php } ?>
      </div>
    <!-- /.col-lg-3 사이드바-->

      <div class="col-lg-10" style="max-width:1200px;">

        
        <!-- 본문 -->
          <div class="card-body" style="min-width:600px;min-height:500px;padding:0px;">
         
             <div class="wrheader">
               <h3 class="card-title" id="title"><?php echo  $place ?>
               
             </div>
            <br/>

            <div style="padding-top:10px;">
             <h4 for="product_name" class="col-sm-2 control-label text-center">세부정보 정보</h4>
             <div style="margin:15px 00px 30px 0px;padding:30px 30px 30px 30px;border:1px solid #c2c2c2;display:flex;">
             <div style="justify-content:left;display:inline-block;border-right:1px solid #c2c2c2;margin-right:20px" >
               
                <div class="form-inline form-group" style="width:460px;margin-top:40px">
                <h4 class="col-sm-4 control-label text-center" style="width:120px"> 전화번호  </h4> <span id="telValue" style="font-size:18px"><?php echo $tel ?></span>
                </div>
                <div class=" form-group" style="width:460px;margin-top:50px">
                <h4 class="col-sm-4 control-label text-center" style="width:300px"> 주 소  </h4> 
                <div id="address" style="margin:20px 30px;font-size:18px;"><?php echo $address ?></div>
                </div>
                
              </div>


              <div style="justify-content:right;">
                <div class="form-inline " style="width:580px">
                  <h4 class="col-sm-4 control-label text-center" style="margin-right:50px">가격<p style="font-size:15px;">(주말 기준)</p>  </h4> 
                  <span ><span style="font-size:18px"><?php echo $price ?></span> 원</span>
                </div>


               <div class="form-inline form-group" style="width:500pxdisplay:flex;align-items:center;margin-top:30px">
              <h4 class="col-sm-4 control-label text-center" style="margin-right:10px;">레인수  </h4> 
              <span style="justify-content:center;">
                            
              <span id="line-1" style="font-size:30px;width:120px;color:#fff;display:inline-block;">
                <i class="fas fa-check"></i><span style="font-size:17px;margin-left:10px;color:#000000;width:100px;">12 이하</span>
              </span>

              <span id="line-2" style="font-size:30px;width:120px;color:#fff;display:inline-block;">
                <i class="fas fa-check"></i><span style="font-size:17px;margin-left:10px;color:#000000;width:100px;">12~20</span>
              </span>
                            
              <span id="line-3" style="font-size:30px;width:120px;color:#fff;display:inline-block;">
                <i class="fas fa-check"></i><span style="font-size:17px;margin-left:10px;color:#000000;width:100px;">20 이상</span>
              </span>
          
                    </span>
               </div>
               <div class="form-inline form-group" style="width:580px;display:flex;align-items:center;margin-top:30px">
              <h4 class="col-sm-4 control-label text-center" style="margin-right:10px;">레인상태  </h4> 
                   <span style="justify-content:center;display:inline-block;">
                            
                            <span id="line-condition3" style="font-size:30px;width:120px;color:#fff;display:inline-block;">
                              <i class="fas fa-check"></i><span style="font-size:17px;margin-left:10px;color:#000000;">좋음</span> 
                            </span>
                           
                         
                            <span id="line-condition2" style="font-size:30px;width:120px;color:#fff;display:inline-block;"><i class="fas fa-check">
                              </i><span style="font-size:17px;margin-left:10px;color:#000000;">보통</span>
                            </span>
                           
                            
                         
                            <span id="line-condition1" style="font-size:30px;width:120px;color:#fff;display:inline-block;">
                              <i class="fas fa-check"></i> <span style="font-size:17px;margin-left:10px;color:#000000;">나쁨</span>
                            </span>
                            </span>
                    
               </div>
              </div>
              
             </div>
             </div>
             <div style="display:flex;">
                <div style="justify-content:left;display:inline-block;margin-right:20px" >
                    <div class="form-inline form-group" style="width:500px;margin-top:10px">
                      <h3 for="product_name" class="col-sm-3 control-label text-center">평 점</h4>
                      <i id="1-star" style="font-size:25px" class="fas fa-star" ></i></p>
                      <i id="2-star" style="font-size:25px" class="far fa-star"></i>
                      <i id="3-star" style="font-size:25px" class="far fa-star"></i>
                      <i id="4-star" style="font-size:25px" class="far fa-star"></i>
                      <i id="5-star" style="font-size:25px" class="far fa-star"></i>
                      
                    </div>
                </div>
                <div style="justify-content:right;">
                    <div class="form-inline form-group" style="margin-bottom:40px;width:550px;">
                    <h3 for="product_name" class="col-sm-5 control-label text-center" style="margin-right:10px">타 사이트 검색</h4>
                    <span><button onclick="herf()" class="btn btn-outline-link" style="margin-right:40px">
                      <a href='https://search.naver.com/search.naver?sm=top_hty&fbm=1&ie=utf8&query=<?php echo $place?>' target="_blank">
                      <img src='./naver_Green.PNG' width=50px height=50px></button></span>
                      
                    <span><button onclick="herf()" class="btn btn-outline-link" style="margin-right:40px">
                      <a href='https://www.google.com/search?q=<?php echo $place ?>' target="_blank"><img src='./google.png' width=50px height=50px></button></span>

                    <span><button  class="btn btn-outline-link">
                    <a href='https://search.daum.net/search?w=tot&DA=YZR&t__nil_searchbox=btn&sug=&sugo=&sq=&o=&q=<?php echo $place ?>' target="_blank">
                      <img src='./daum.ico' width=50px height=50px></a></button></span>

                    </div>
                </div>
                  
             </div>


             <div class="map_wrap">
                <div id="map" style="width:100%;height:450px"></div>

         
                </div>
          </div>
         
        <!-- /.card  본문끝-->

          <br>
       

        <!-- 회원들 평가 -->
        <div class="card card-outline-secondary my-4">
          <div class="card-header" >
            <h4>회원들의 평가 </h4>
          </div>
          <div class="card-body">

          <!-- 회원들 평가보여주는칸 -->

            <?php while($reply_rows = mysqli_fetch_assoc($reply_result)){if($total%2==0){}else{}//리플 가져오기
              $user_no =$reply_rows['writer'];$reply_no=$reply_rows['no'];
              $query_user = "select * from user where nickname ='$user_no'"; //댓글쓴 유저 닉네임찾기
              $user_result = $db->query($query_user);
              $user_rows = mysqli_fetch_assoc($user_result);
              $user_img = $user_rows['userImage'];
            ?>

            <div style="border:1px solid #1B1B1B;padding:10px 3px 10px 3px;display:flex;width:1090px;">
               <div class="" style="display:flex;align-items:center;justify-content:center;height:110px;padding-right:20px;width:150px;">
               <img src="<?php echo './userimg/'.$user_img ?>" width=60px height=60px style="align-items:center;"> <?php echo $reply_rows['writer'];?>
               </div>
               <div style="width:800px;border-left:1px solid #c2c2c2;padding-left:20px;">
               <span style="width:300px;display:inline-block;margin-bottom:7px">레인 상태 :
                  <?php $condition =$reply_rows['line_condition']; if($condition =='3'){ echo '좋음';}else if($condition =='2'){echo '보통';}else{echo '보통';}
                  ?>
               </span>

               <span style="width:300px;display:inline-block;">총 평점 : 
                  <?php $star =$reply_rows['rate'];  for($i=0; $i<5 ;$i++){
                        if( $i< $star){
                              echo '<i style="font-size:20px;color:#FFD62E;" class="fas fa-star"></i>';
                        }else{echo '<i style="font-size:20px;" class="far fa-star"></i>';}
                              }
                      ?>
               </span>
              
                <br>
                <div class="textover" style="width:900px;font-size:16px;">
                <?php echo $reply_rows['content']; ?>
                <!-- <br/><input class="btn" type=button onclick="folder(this)" value="더보기" style="border:none;background-color:#fff;color:#8F8F8F"> -->
                </div> 
               </div>
            </div>

           <!-- /리플보여주는칸 -->

            <!-- 리플수정칸 -->
            <div id="reply_modify_<?php echo $reply_no ?>" style="border:1px solid #1B1B1B; text-align:right;padding:10px 3px 10px 3px;display:none;">
               <textarea id="reply_text_<?php echo $reply_no ?>" name=reply_text_  cols=85 rows=15 style="border:none;width:100%;height:100px;resize:none"><?php echo $reply_rows['contents']; ?> </textarea>
               <div class="like-box" style="font-size:16px;">
               <span id=counter>(0 / 최대 200자)</span>
             
               <button type=button onclick="replyModifyBtn('<?php echo $reply_no ?>')" class="btn btn-outline-dark" style="font-size:17px;font-weight:900;margin-right:10px;margin-left:10px;" >리플수정</button>
               <button  type=button onclick="replyCancelBtn('<?php echo $reply_no ?>')" class="btn btn-outline-danger" style="font-size:17px;font-weight:900;margin-right:10px;margin-left:10px;" >취소</button></div>
            </div><hr><?php }?> <!-- /리플수정칸 -->
          
           <!-- 리플작성칸 -->
         
          </div>
        </div>
        <!-- /.card 리플끝 -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->
  <div style="display:none">
    <form id="post_modify_form" name="post_modify_form" method="post" action='./v_community_write.php'>
            <input type=hidden value="<?php echo $no ?>" id="post_no" name="post_no" >
            <input type="hidden" value="<?php echo $rows['contents']?>" id="post_contents" name="post_contents">
            <input type=hidden value="<?php echo $post_['title']?>" id="title" name="title" >
            <input type=hidden value="<?php echo $post_['placesId']?>" id="placesId" name="placesId" >

            <input type=hidden value="<?php echo $rows['youtu_title']?>" id="youtu_title" name="youtu_title" >
            <input type=hidden value="<?php echo $rows['youtu_url']?>" id="youtu_url" name="youtu_url" >
            <input type=hidden value="<?php echo $rows['youtu_id']?>" id="youtu_id" name="youtu_id" >


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
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=db6aed39e36d5db0ad08bfbcde30d1d0&libraries=services"></script>
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>

     var place = $("#place").val();
    

   var infowindow = new kakao.maps.InfoWindow({zIndex:12});

      var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
         mapOption = {
            center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
         };  

      // 지도를 생성합니다    
      var map = new kakao.maps.Map(mapContainer, mapOption); 

      // 장소 검색 객체를 생성합니다
      var ps = new kakao.maps.services.Places(); 

      // 키워드로 장소를 검색합니다
      ps.keywordSearch(place, placesSearchCB); 

 

// 키워드 검색 완료 시 호출되는 콜백함수 입니다
function placesSearchCB (data, status, pagination) {
    if (status === kakao.maps.services.Status.OK) {

        // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
        // LatLngBounds 객체에 좌표를 추가합니다
        var bounds = new kakao.maps.LatLngBounds();

        for (var i=0; i<data.length; i++) {
            displayMarker(data[i]);    
            bounds.extend(new kakao.maps.LatLng(data[i].y, data[i].x));
        }       

        // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
        map.setBounds(bounds);
    } 
}

// 지도에 마커를 표시하는 함수입니다
function displayMarker(place) {
  
    // 마커를 생성하고 지도에 표시합니다
    var marker = new kakao.maps.Marker({
        map: map,
        position: new kakao.maps.LatLng(place.y, place.x) 
    });

    // 마커에 클릭이벤트를 등록합니다
    var iwContent = '<div style="padding:5px;">'+place.place_name+' <br><a href="https://map.kakao.com/link/to/'+place.id+'" style="color:blue" target="_blank">길찾기</a></div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
    iwPosition = new kakao.maps.LatLng(place.y, place.x); //인포윈도우 표시 위치입니다

    // 인포윈도우를 생성합니다
    var infowindow = new kakao.maps.InfoWindow({
        position : iwPosition, 
        content : iwContent 
});
    
        infowindow.open(map, marker);
   
}
 
  function folder(){
    if($(this).val()=='더보기'){
    $(this).parents().removeClass('textover');
    $(this).val('접기');
    }else{
    $(this).parents().attr('class','textover');
    $(this).val('더보기');
    }
  }
   $(document).ready(function(){
    var $line = $("#legv").text();
    $("#leg").html("("+$line.length+" / 최대 200자)");

      var $line = $("#line").val();
      //레인수 표시
      if($line >= 2.5 ){
      $("#line-3").css('color','#000042');
      }else if($line >= 1.5){
        $("#line-2").css('color','#000042');
      }else{
        $("#line-1").css('color','#000042');
      }

      var $line_condition = $("#line_quality").val();
      //레인 상태 표시
      if($line_condition >= 2.5){
      $("#line-condition3").css('color','#000042');
      }else if($line_condition >= 1.5){
        $("#line-condition2").css('color','#000042');
      }else{
        $("#line-condition1").css('color','#000042');
      }

      //평점 표시
      //평점 값
      var star = $("#star").val();
      for(var i=0 ; i<star ;i++){
          $("#"+(i+1)+"-star").attr('class','fas fa-star');
          $("#"+(i+1)+"-star").css('color','#FFD62E');
        }

      });
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
                data.append("key","v_post_remove");
                data.append("post_no",no);
                var xhr = new XMLHttpRequest();
                xhr.open("POST","community_upload.php");
                 xhr.onload = function(e) {
                     if(this.status == 200) {
                         if( e.currentTarget.responseText =="1"){
                          location.replace('./v_community.php');
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

  //페이지 불러올때 like/unlike_ 체크
   $(document).ready(function(){
    var u_contents = $("#u_contents").val();
    var post_num = $("#post_no").val();
    // 카테고리 - 텍스트 
    // contents - like / unlike_
    if(u_contents =="like_"){
      $("#post_like").attr('class','btn btn-outline-danger ');
    }else if(u_contents =="unlike_"){
      $("#post_unlike").attr('class','btn btn-outline-danger ');
    }
  
  //좋아요
    $("#post_like").click(function(e){
    e.preventDefault();
    if(u_contents =="like_"){//이미 좋아요 눌렸던상태 delete
      
       var data = new FormData();//데이터 통신
            data.append("key","v_like_cancel");
            data.append("post_no",post_num);
            data.append("contents","like_");
            data.append("category","video");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                     
                       location.reload();
                     }else{
                       alert("다시시도해주세요");
                       return false;
                     }
                     
                 }
             }
             xhr.send(data);

    }else if(u_contents =="unlike_"){//싫어요 눌렸던상태 좋아요 업데이트
      
      var data = new FormData();//데이터 통신
            data.append("key","v_like_update");
            data.append("post_no",post_num);
            data.append("category","video");
            data.append("now_contents","unlike_");
            data.append("new_contents","like_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                     if( e.currentTarget.responseText =="1"){
                 
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
            data.append("key","v_like_new");
            data.append("post_no",post_num);
            data.append("category","video");
            data.append("contents","like_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                     
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

  //싫어요
   $("#post_unlike").click(function(e){
      e.preventDefault();

   
    if(u_contents =="unlike_"){//이미 싫어요 눌렸던상태 delete
       var data = new FormData();//데이터 통신
            data.append("key","v_like_cancel");
            data.append("post_no",post_num);
            data.append("contents","unlike_");
            data.append("category","video");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                     
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
            data.append("key","v_like_update");
            data.append("post_no",post_num);
            data.append("category","video");
            data.append("now_contents","like_");
            data.append("new_contents","unlike_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                     if( e.currentTarget.responseText =="1"){
                     
                      location.reload();
                     }else{
                       alert("다시시도 해주세요"+e.currentTarget.responseText);
                       return false;
                     }
                     
                 }
             }
        xhr.send(data);

    }else if(u_contents == ""){//아무것도 안눌렸던 상태 
      
      var data = new FormData();//데이터 통신
            data.append("key","v_like_new");
            data.append("category","video");
            data.append("post_no",post_num);
            data.append("contents","unlike_");
            var xhr = new XMLHttpRequest();
            xhr.open("POST","community_upload.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     if( e.currentTarget.responseText =="1"){
                      $("#post_unlike").attr('class','btn btn-outline-danger disabled');
                      loaction.reload();
                     }else{
                       alert("다시 시도해주세요.");                       
                       return false;
                     }
                     
                 }
             }
             xhr.send(data);
    }
    });
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
              data.append("category",category);
              data.append("typ","비디오");
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
     
  //리플 수정

    function reply_modify(no){// 리플 수정
        $("#reply_"+no).css("display","none");
        $("#reply_modify_"+no).css("display","");
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
                data.append("key","v_reply_modify");
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

    function reply_remove(no){//리플 삭제버튼
      
        if(confirm("리플을 삭제하시겠습니까?")){
           var post_no = $("#post_no").val();
           var data = new FormData();
                data.append("key","v_reply_remove");
                data.append("reply_no",no);
                data.append("post_no",post_no);
                var xhr = new XMLHttpRequest();
                xhr.open("POST","community_upload.php");
                 xhr.onload = function(e) {
                     if(this.status == 200) {
                    
                         if( e.currentTarget.responseText =="1"){
                           alert("삭제되었습니다.");
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
            data.append("key","v_reply");//키값
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
