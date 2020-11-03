<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>퍼니</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="bootstrap/css/shop-homepage.css" rel="stylesheet">

</head>
<style>
#page_num {
	font-size: 14px;
	margin:auto;
	margin-top:30px; 
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
table tr td{
  max-width:350px;
  height:1.2em;
  line-height:1.2em;
  overflow: hidden; 
  text-overflow: ellipsis; 
    word-break: keep-all;
}

</style>
<body>

<?php 
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

$thisPage = 'commu';
include 'navigationbar.php';
include 'mysqldb.php';
$sql = $db->query("select * from community");
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
$cummunity = "select * from community  order by no desc limit $start_num, $list";           
$result = $db->query($cummunity);

?>


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">커뮤니티</h1>
        <div class="list-group">
          <a href="community.php?page=1" class="list-group-item active">일반 커뮤니티</a>
          <a href="v_community.php?page=1" class="list-group-item">영상 커뮤니티</a>
        
        </div>
        <?php if(isset($_SESSION['user_num'])){?>
        <div class="list-group " style="margin-top:20px;">
          <a href="./community_write.php" class="list-group-item bg-dark text-center text-white">글쓰기</a>
        </div>
        <?php } ?>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9" style="margin-top:100px;margin-bottom:100px;">

        
        <div class="row">
         <div class="card card-body" style="min-height:500px;">
          <table  class="unstyledTable table table-hover" >
            <thead>
               <tr>
                  <td style="width:70px"> 번호</td>
                  <td style="width:300px"> 제목</td>
                  <td> 작성자</td>
                  <td> 작성일</td>
                  <td style="width:90px"> 조회수</td>
               </tr>
            </tead>
          
              <tbody>
              
              <?php  while($rows=mysqli_fetch_assoc($result)){if($total%2==0){}else{}
             
                $user_no =$rows['user_no'];
                $query_user = "select * from user where num ='$user_no'"; 
                $user_result = $db->query($query_user);
                $user_rows = mysqli_fetch_assoc($user_result);
             ?>
                
                <tr style="height:1.2em;overflow:hidden;text-overflow:ellipsis;word-break: keep-all;">
                    <td style=""><?php echo $rows['no']?></td>
                    <td style="width:300px;overflow:hidden; white-space:nowrap;text-overflow:ellipsis;word-break: keep-all;">
                      <a style="height:1.2em;" href="community_detail.php?num_=<?php echo $rows['no']?>">
                      <?php echo $rows['title']?>
                      </a></td>
                    <td><?php echo $user_rows['nickname'];?></td>
                    <td><?php echo $rows['day']?></td>
                    <td><?php echo $rows['view']?></td>
                </tr></a>
                <?php } ?>
              </tbody>
           
              </table>
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
         <!-- /card -->
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; sang 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script>
     
   </script>
</body>


</html>
