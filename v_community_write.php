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

  <!-- Custom styles for this template -->
  <link href="bootstrap/css/shop-homepage.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>

</head>
<style>
   .center{
      text-align:center;
   }
   .uploadbtn{
     
      margin-top: 20px;
   }
   .wrheader{
      margin : 50px 0px 10px 0px;
      border-bottom:3px solid #000066;
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
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 800px; /* Could be more or less, depending on screen size */
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
   </style>
  
<body onload="LoadPage();">


<?php 
$thisPage = 'commu';
include 'navigationbar.php';
include 'mysqldb.php';
$category ='';
$title='';
$contents='';
$post_no='';
$key= 'v_post_upload';//글쓰기 키값
if(!isset($_SESSION["userid"])){
  ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php
}
?>
  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- <div class="col-lg-3">
        <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
          <a href="#" class="list-group-item active">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
        </div>
      </div> -->
      <!-- /.col-lg-3 -->

      <div class="col-lg-12" style="margin-bottom:50px;">

        <!-- <div class="card mt-4"> -->
          
          <!-- <div class="card-body"> -->
          
          <form id="EditorForm" name="EditorForm" method="post" onsubmit="return submitContents(this)" action="community_upload.php">
             <div class="wrheader">
            <?php if(isset($_POST['post_no'])){     //수정인지 그냥 글쓰기 인지 체크
              $title = $_POST['post_title'];        // 게시글 제목
              $youtu_title = $_POST['youtu_title']; //영상제목
              $youtu_url = $_POST['youtu_url'];     //영상이미지
              $post_no = $_POST['post_no'];         //글번호
              $query_post = "select * from v_community where no ='$no'";           //글번호 받아와서 community 테이블에서 글찾기
              $result = $db->query($query_post);
              $rows =mysqli_fetch_assoc($result);
              $cont = $rows['contents'];     
              $contents = $_POST['post_contents'];
              $key = "v_post_update";               //키값 수정 
              echo "<h3 class='card-title'>게시글 수정</h3>";
            }else{ 
            echo '<h3 class="card-title">영상 게시글 작성</h3>';} ?>
            </div>
            <input type="hidden" id="youtubeId" name="youtubeId" value="">
            <div class="form-inline form-group" style="margin-top:40px;" >
               <h4 for="product_name" class="col-sm-2 control-label text-center">유튜브 검색</h4>
               
               <input type=text id="search_box" class="form-control" style="min-width:500px;width:74%;" placeholder="유튜브에 검색할 텍스트를 입력해주세요 유튜브 영상이 검색됩니다 :)" />
               <button id="newpage" type="button" class=" btn btn-dark " style="width:100px" onclick="fnGetList();"><i class="fas fa-search"></i></button>
          
            </div>

            <div class="form-inline form-group" style="margin-top:20px;" >
               <h4 for="product_name" class="col-sm-2 control-label text-center">유튜브 동영상</h4>
                <img id='youtube_img' width=400px; height=250px;  src='<?php if(isset($_POST['post_no'])){echo "$youtu_url";}else{echo './v_community.png';} ?>' > 
                <div  id="youtube_title" style="width:40%;height:250px;float:right;padding:3px 15px 10px 10px">
                <?php if(isset($_POST['post_no'])){ echo $youtu_title;}else{ echo '위에서 유튜브 영상을 검색해주세요';} ?></div>
                
            </div>
                <input id='youtu_id' name='youtu_id' type="hidden" value="<?php echo $_POST['youtu_id'] ?>" required> 
                <input id='youtu_title' name='youtu_title' type="hidden" value="<?php echo $_POST['youtu_title'] ?>" required> 
                <input id='youtu_url' name='youtu_url' type="hidden" value="<?php echo $_POST['youtu_url'] ?>" required>


            <input type="hidden" id="key" name="key" value="<?php echo $key?>">
            <input type="hidden" name="post_no" id="post_no" value="<?php echo $post_no?>">
            <div class="form-inline form-group" style="margin-top:20px;margin-bottom:0px" >
              <h4 for="product_name" class="col-sm-2 control-label text-center">제   목</h4>
              <input type="text" value="<?php echo $title?>" class="form-control" id="title" name="title" style="width:83%" placeholder="제목을 입력해주세요 (최소 5자)" required>
             
            </div>
            <div style="text-align:right;margin-top:0px" id=counter>(0 / 최대 50자)</div>

            <div class="form-inline form-group" style="margin-top:20px;" >
               <h4 for="product_name" class="col-sm-2 control-label text-center">내   용</h4>
               <textarea name=smarteditor  id=smarteditor cols=85 rows=15 style="display:block;width:83%;height:200px;" required><?php echo $contents?></textarea>
            </div>
            <div class="text-center uploadbtn">
            <button id="sub" type="submit"  class="btn btn-lg btn btn-dark " style="background-color:#3366CC; border-color:#3366CC">
            <?php if(isset($_POST['post_no'])){echo "영상 게시글 수정";}else{echo "영상 게시글 등록";}?></button>
            <button type="button" id="upload-cancel-btn" class="btn btn-lg btn btn-dark " >취소</button>
            </div>
         
           </form>
          <!-- </div> -->

        <!-- </div> -->
        <!-- /.card -->
       <!-- </div> -->
       

      </div>
      <!-- /.col-lg-12 -->

    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; sang Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>
  <!-- madal 모달창 -->
  <div id="myModal" class="modal" >
      
      <!-- Modal content -->
      <div class="modal_content" >
              <div style="float:right">
                <button type="button" id="modal-close" class='btn btn-outline-dark' style='border:none;padding:0px 7px 0px 7px;margin:0px;font-size:20px'>
                <i class="fas fa-times"></i>
                </button>
              </div>

               <p style="text-align: center;"><span style="font-size: 14pt;"><b><span style="font-size: 24pt;">상세 내용</span></b></span></p>
              
               <div style="overflow:auto;overflow-x:hidden;height:500px"id="get_view"></div>
               <div id="nav_view" style="margin-top:5px;width:758px;text-align:right;"></div>

               <hr style="margin: 30px 0px 10px 0px;background-color:#C2C2C2"/>
            <!-- <div style="cursor:pointer;background-color:#DDDDDD;text-align:left;padding-bottom: 10px;padding-top: 10px;" onClick="close_pop();"> -->
            <div style="text-align:center">
            <span id=test></span>
            <button type=button class="btn" id="modal_pic" style="text-align:center;background-color:#fff;border:none;width:70px" >선택</button>
            </div>
            
               
            
      </div>
   </div>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>

      //영상게시글 수정할때 영상 변경불가
      $(document).ready(function(){
          $("#modal_pic").attr('disabled',true);
         

       
      });
    if($("#key").val()=='v_post_update'){
        $("#search_box").attr('disabled',true);
        $("#search_box").attr('placeholder','유튜브영상은 수정할 수 없습니다');
        $("#newpage").attr('disabled',true);
      }
      //다이얼로그 창에서 라디오체크시 선택버튼 활성화 
      function clickable(){
        $("#modal_pic").attr('disabled',false);
          }
      //다이얼로그 창에서 다음/이전 선택시 선택버튼 비활성화 
      function unclick(){
        $("#modal_pic").attr('disabled',true);
      }
      

      //취소 버튼
      $("#upload-cancel-btn").click(function(e){
      e.preventDefault();
      history.back();
   });

  </script>
<script>


//영상 올리기 버튼
 function submitContents(el){

      // 게시글 / 제목 / 내용 / 유튜브영상아이디 / 제목 / 이미지 값 넣기     
      var title = $("#title").val();
      var contents = $("#smarteditor").val();
      var youtuid = $("#youtu_id").val();
      var yoututitle = $("#youtu_title").val();
      var youtuurl = $("#youtu_url").val();
     
      if(title == ""){
         alert("제목을 입력해주세요");  
         return false;
      }else if(title.length <5){
        alert("제목은 5자 이상 입력해야 합니다.")
        return false;
      }else if(contents == ""){
         alert("내용을 입력해주세요");  
         return false;
      }else if(youtuurl == ""){
         alert("영상을 선택해주세요");  
         return false;
      }else if(youtuid == ""){
        alert("영상을 선택해주세요");  
        return false;
        
      }
    
     
     
   }

    //유튜브api 검색
function fnGetList(sGetToken){
			var $getval = $("#search_box").val();//검색어 가져오기
			if($getval==""){
				alert("검색어를 입력하세요.");
				$("#search_box").focus();
				return;
			}
			$("#get_view").empty();//이전 값들 비워주기
			$("#nav_view").empty();//이전 값들 비워주기


      //유튜브 api url + 본인 키값
			var sTargetUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&order=relevance"
								+ "&q="+ encodeURIComponent($getval) +"&key=AIzaSyCXWxnu_c0IF-koLZm_wE5M6b5TKRIsGVc";
			if(sGetToken){
				sTargetUrl += "&pageToken="+sGetToken;
			}
			$.ajax({
				type: "POST",
				url: sTargetUrl,
				dataType: "jsonp",
				success: function(jdata) {// json 통신으로 받는다
					console.log(jdata);
               $("#myModal").show();
					$(jdata.items).each(function(i){

						//console.log(this.snippet.channelId);
            //겟뷰에 this.snippet.thumbnails.high.url(썸네일이미지 url) 값받아서 넣고 this.snippet.title(타이틀 값) 받아서 넣는다
						$("#get_view").append("<label style='margin-left:10px;width:700px;' for='"+this.id.videoId+"'><input type='radio' onclick='clickable()' name='quality' id='"+this.id.videoId+"'  value='"+this.id.videoId+"' >"
                  +"<span><img src='"+this.snippet.thumbnails.high.url+"' width=150px height=120px><div style='float:right;width:500px;height:120px;'>"+this.snippet.title+"</div></span></label><hr/>"
                  +"<input type='hidden' id='"+this.id.videoId+"title' value='"+this.snippet.title+"'><input type='hidden' id='"+this.id.videoId+"img' value='"+this.snippet.thumbnails.high.url+"'>");
					}).promise().done(function(){

						if(jdata.prevPageToken){//이전페이지 토큰(jdata.prevPageToken)
							$("#nav_view").append("<span style='float:left;font-size:15px'><a onclick='unclick()' class='btn' href='javascript:fnGetList(\""+jdata.prevPageToken+"\");'><i class='fas fa-chevron-left'></i>이전</a></span>");
						}
						if(jdata.nextPageToken){//다음페이지 토큰(jdata.prevPageToken)
							$("#nav_view").append("<span '><a style='font-size:15px' onclick='unclick()' class='btn' href='javascript:fnGetList(\""+jdata.nextPageToken+"\");'>다음<i class='fas fa-chevron-right'></i></a></span>");
						}
					});
				},
				error:function(xhr, textStatus) {
					console.log(xhr.responseText);
					alert("지금은 시스템 사정으로 인하여 요청하신 작업이 이루어지지 않았습니다.\n잠시후 다시 이용하세요.[2]");
					return;
				}
			});
		}

    $(document).ready(function(){
    
    
      $("#modal-close").click(function(e){
                  $('#myModal').hide();
                  });

      $("#modal_pic").click(function(e){

         e.preventDefault();
        var $id =''; 
         $id =  $('input[name="quality"]:checked').val();

        var title = $("#"+$id+"title").val();
        var img = $("#"+$id+"img").val();
        
        $("#youtube_img").attr('src',img);
        $("#youtube_title").text(title);
        $("#youtu_url").val(img);
        $("#youtu_title").val(title);
        $("#youtu_id").val($id);
        $('#myModal').hide();

        
      });

    

   $("#title").keyup(function (e){
      var content = $(this).val();
      $("#counter").html("("+content.length+" / 최대 50자)");

      if(content.length >50){
        alert("최대 50자까지 입력 가능합니다.");
        $(this).val(content.substring(0,50));
        $('#counter').html("(50 / 최대 50)");
      }
    });
  
   
  
    
  });
   
</script>


</body>
<script type="text/javascript">

    </script>
</html>
