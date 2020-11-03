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
table.unstyledTable {
  width: 95%;
  margin:auto; 
  margin-top:40px;
}
table.unstyledTable td, table.unstyledTable th {
  border: 1px solid #AAAAAA;
  padding: 6px 10px;
  max-width:450px;
}
table.unstyledTable tbody td {
  font-size: 14px; 
  max-width:450px;
  white-space:nowrap;
  text-overflow: ellipsis;
  overflow:hidden;
}
table.unstyledTable thead {
  max-width:450px;
  background: #DDDDDD;
}
table.unstyledTable thead th {
  font-size: 15px;
  font-weight: bold;
  text-align: center;
  max-width:450px;
}
.col-lg-3{
  position:fixed;
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
            width: 700px; /* Could be more or less, depending on screen size */
            z-index:11;                          
}
div.unstyledTable {
  width: 100%;
}
.divTable.unstyledTable .divTableCell, .divTable.unstyledTable .divTableHead {
  border: 0px solid #AAAAAA;
  padding: 7px 7px;
}
.divTable.unstyledTable .divTableBody .divTableCell {
  font-size: 14px;
}


/* DivTable.com 다이얼로그(모달창)내부 테이블*/
.divTable{ display: table; }
.divTableRow { display: table-row; }
.divTableHeading { display: table-header-group;}
.divTableCell, .divTableHead { display: table-cell;}
.divTableHeading { display: table-header-group;}
.divTableFoot { display: table-footer-group;}
.divTableBody { display: table-row-group;}
.divTableCell span{
   font-size:17px;
}
#page_num {
	font-size: 14px;
	margin:auto;
}
#page_num ul li {
	float: left;
	margin-left: 10px; 
	text-align: center;
  list-style:none;
  
}
#page_num ul li a {
  color:black;
}
.fo_re {
	font-weight: bold;
	color:blue;
}
</style>
<body>


<?php 
$thisPage = 'mypag';
include 'navigationbar.php';
include 'mysqldb.php';
if(isset($_GET['page'])){
  if(is_numeric($_GET['page'])){
    if(is_int((int)$_GET['page'])){
      if($_GET['page'] <1){
          $page= 1;
      }else{
          $page =  $_GET['page'];
      }
    }else{
      ?><script>alert("잘못된 접근입니다.");location.replace('?page=1'); </script> <?php
    }
  }else{
    ?><script>alert("잘못된 접근입니다.");location.replace('?page=1'); </script> <?php
  }
}else{
  ?><script>alert("잘못된 접근입니다.");location.replace('?page=1'); </script> <?php
}

if(!isset($_SESSION["userid"])){
  ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php
}


  $user_no = $_SESSION['user_num'];
  //report 데이터베이스에서 가져오기
  $sql = $db->query("select * from report WHERE writer_no ='$user_no'");
  $row_num = mysqli_num_rows($sql);//총 게시글수

  $list = 5;      // 현재페이지에 보여질 게시글 수
  $block_ct = 5;  // 블록당 보여줄 페이지 게수

  $block_num = ceil($page/$block_ct); //현재 몇페이지 인지 구하기
  $block_start = (($block_num -1 ) * $block_ct+1); //블럭 시작번호
  $block_end = $block_start + $block_ct -1; //블럭 마지막 번호
  $total_page = ceil($row_num /$list); //페이징할 페이지 수 구하기
  if($block_end > $total_page) $block_end = $total_page; // 만약 블록의 마지막 번호가 페이수보다 많다면 마지막번호는 페이지수
  if($page > $total_page){
    echo "<script>alert('잘못된 접근입니다.'); location.href='?page=1';</script>";
  }
  $start_num = ($page-1) * $list;
  $query = "SELECT * FROM report WHERE writer_no ='$user_no'";
  $result = $db->query($query);
 
 
  ?>

  <!-- Page Content -->
  <div class="container" style="max-width:1400px;width:100%;padding-top:80px;margin-bottom:135px">

    <div class="row" style="width:100%">
      <!-- 서브 메뉴바 -->
      <div class="col-lg-3" style="max-width:250px">
       <?php include 'myPage_sidebar.php'; ?>
      
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-10" style="max-width:1100px;">
        <!-- /.card -->

        
        <div class="card card-outline-secondary my-4" style="min-height:500px;">
        
          <div class="card-header" style="font-size:large;font-weight:700;outline-style:hidden;outline-width:0px;">
            신고내역
          </div>
          <?php
          if(mysqli_num_rows($result)==0){  ?>
          <div  style="display:flex;align-items:center;justify-content:center;font-size:40px;font-weight:1000;height:400px;">
          <p>신고내용이 없습니다 :)</p>
          </div>
          <?php }else{?>
          <table id="report-table" class="unstyledTable table-hover">
            <thead>
            <tr>
               <th style="">커뮤니티</th>
               <th style="">신고당한 글</th>
               <th style="">신고 내용</th>
               <th style="width:150px;">신고 날짜</th>
               <th style="width:100px;">결과</th>
               
            </tr>
            </thead>
          
             
            <tbody>
            <?php  
            
            while($rows=mysqli_fetch_assoc($result)){if($total%2==0){}else{}
             
             $post_no =$rows['post_no'];

             ?>
             
            <tr style="cursor:pointer;">
               <td><?php echo $rows['typ'] ?></td>
               <td><?php echo $rows['post_title'] ?></td>
               <td><?php echo $rows['contents'] ?></td>
               <td><?php echo $rows['day'] ?></td>
               <td style=text-align:center><?php echo $rows['checked'] ?></td>
             
               <input type="hidden" id="post_title_" value="<?php echo $rows['post_title'] ?>">             
               </tr>
            <?php }?>
            </tbody>
            </tr>
         </table>
          <?php }?>
          <div id="page_num">
            <ul>
            <?php 
            //처음으로가기 버튼
            if($page <=1){
              echo "<li class='fo_re'>처음</li>";//처음이라는 글자에 빨간색 표시
            }else{
              echo "<li><a href='?page=1'>처음</a></li>";//아니면 1페이지로 갈수 있게 링크
            }

            //이전 버튼
            if($page <= 1){// 페이지 1이거나 작다면 빈값 아무것도 안보임

            }else{
              $pre = $page-1;//이전페이지 갈 수있게 페이지 수 맞추기
              echo "<li><a href='?page=$pre'>이전</a></li>";// 이전글자 만들고 링크에 전페이지 넘버 넣기
            }

            //블럭 글자 만들기 ex> 1 2 3 4 5 
            for($i = $block_start; $i<=$block_end; $i++){
              if($page ==$i){
                echo "<li class='fo_re'>[$i]</li>";//현재 페이지에 해당하는 번호에 굵은 글씨
              }else{
                echo "<li><a href='?page=$i'>[$i]</a></li>"; //아닌글에 링크와 그냥 보통 글씨
              }
            }

            //다음 버튼 만들기
            if($page >= $total_page){//현재 페이지가 블럭 마지막 수와 같거나 크면 빈값
            }else{
              $next = $page +1;
              echo "<li><a href='?page=$next'>다음</a></li>";
            }

            //마지막으로 가기 버튼
            if($page >= $total_page){
              echo "<li class='fo_re'>마지막</li>";//현재페이지가 마지막일 경우
            }else{
              echo "<li><a href='?page=$total_page'>마지막</a></li>";// 현재페이지가 마지막이 아닐 경우
            }
            ?>
         </div>
          
        </div>
        <!-- /.card -->
      </div>
      <!-- /col-lg-9 -->

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
               <p style="text-align: center;"><span style="font-size: 14pt;"><b><span style="font-size: 24pt;">상세 내용</span></b></span></p>

               <div class="divTable unstyledTable">
                  <div class="divTableBody">
                     <div class="divTableRow">
                        <div class="divTableCell" style="width:300px;"><span >신고당한 글</sapn></div>
                        <div class="divTableCell" style="width:900px;"><span id="title"></sapn></div>
                     </div>
                     <div class="divTableRow">
                        <div class="divTableCell"><span >신고 내용</sapn></div>
                        <div class="divTableCell"><span id="contents"></sapn></div>
                     </div>
                     <div class="divTableRow">
                        <div class="divTableCell"><span >신고 날짜</sapn></div>
                        <div class="divTableCell"><span id="day"></sapn></div>
                     </div>
                     <div class="divTableRow">
                        <div class="divTableCell"><span >결과</sapn></div>
                        <div class="divTableCell"><span id="result"></sapn></div>
                     </div>
                  </div>
               </div>
               <!-- <input type=hidden id="post_no" ><input type=hidden id="typ" >
              <div><button type=button class="btn btn-dark" id="goCommunity" >해당글 보기</div> -->
               <hr style="margin: 30px 0px 10px 0px;background-color:#C2C2C2"/>
            <!-- <div style="cursor:pointer;background-color:#DDDDDD;text-align:left;padding-bottom: 10px;padding-top: 10px;" onClick="close_pop();"> -->
            <div style="text-align:center">
            <button type=button class="btn" id="modal-close" style="text-align:center;background-color:#fff;border:none;width:70px" >확인</button>
            </div>
            <!-- <div class="report-1" style="float:right;margin-bottom:10px;">
            <button type=button class="btn btn-link" id="modal-next-1"  style="border:none;width:70px;margin-right:10px;" disabled>다음 <i class="fas fa-angle-right"></i></button>
            </div>

            <div class="report-2" style="margin-bottom:10px;display:none;float:right;">
            <button type=button class="btn" id="modal-previous-1"style="background-color:#fff;border:none;width:70px;"><i class="fas fa-angle-left"></i> 이전</button>
            <button type=button class="btn btn-link" id="modal-next-2"  style="border:none;width:70px;margin-right:10px;" disabled>신고</button>
            </div> -->
               
            
      </div>
   </div>
  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<script>
$(document).ready(function(){
   $('#list-3').addClass('active');

   

      
});

//테이블 로우 클릭시
$("#report-table tbody tr").click(function(){
      var tdArr = new Array();	// 배열 선언
		
		// 현재 클릭된 Row(<tr>)
		var tr = $(this);
		var td = tr.children();
			
		// 반복문을 이용해서 배열에 값을 담아 사용할 수 도 있다.
      // 클릭된 tr 데이터 배열에 값을 담는다
		td.each(function(i){
		tdArr.push(td.eq(i).text());
		});
			
		// td.eq(index)를 통해 값을 가져올 수도 있다.
      // 배열에 저장된 값들 넣어주기
		var post_title = td.eq(1).text();
		var contents = td.eq(2).text();
		var day = td.eq(3).text();
		var result = td.eq(4).text();
   
      //다이얼로그(모달창)에 데이터 넣어주기
      $("#title").text(post_title);
      $("#contents").text(contents);
      $("#day").text(day);
      $("#result").text(result);

      //다이얼로그(모달창) 띄우기
      $("#myModal").show();
      
   });
  //  $("#goCommunity").click(function(e){
  //    e.preventDefault;

  //  })

   $("#modal-close").click(function(e){
        $('#myModal').hide();
      });
</script>
</body>

</html>
