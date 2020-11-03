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

</head>
<style>
   div.comicGreen {
  font-family: "Comic Sans MS", sans-serif;
  width: 100%;
  height: 400px;
  text-align: left;
}
.divTable.comicGreen .divTableCell, .divTable.comicGreen .divTableHead {
  padding: 20px 5px 20px;
  border-bottom:1px solid #C2C2C2;
  min-width:100px;
  display:inline-block;
  vertical-align: bottom;
}
.divTable.comicGreen .divTableBody .divTableCell {
  font-size: 15px;
  
  color: #383D39;
}
.comicGreen .tableFootStyle {
  font-size: 21px;
}
/* DivTable.com */
.divTable{ display: table; }
.divTableRow { display: table-row; ;}
.divTableHeading { display: table-header-group;}
.divTableCell, .divTableHead { display: table-cell;}
.divTableHeading { display: table-header-group;}
.divTableFoot { display: table-footer-group;}
.divTableBody { display: table-row-group;}
.divTableCell1{ width:190px;}
.divTableCell2 {width:300px;}
.change-area{ margin-bottom:10px;
   display:flex;
   align-items: center; }
.change-area-font{font-size:14px;}
.remove-id{text-align:right;}
.my-4{
   margin-bottom:50%;
}
</style>
<body>

 
<?php 
$thisPage = 'mypag';
include 'navigationbar.php';
include 'mysqldb.php';
if(!isset($_SESSION["userid"])){
  ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php
}
?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      

      <div class="col-lg-9"style="margin-top:30px;height:600px;">

        

        <div class="card card-outline-secondary my-4"   >
          <div class="card-header">
            회원탈퇴
         </div>
          <div class="card-body">
            <div class= "divTableCell">
                  <div class="change-area" style="width:500px">
                  <label style ="width:150px">비밀번호</label>
                  <input type="password" class="email-change change-area" style="height:31px;width:200px;float:right" id="password" placeholder="비밀번호 입력">
                 
                  </div>
                  <div class="change-area" style="width:500px">
                  <label style ="width:150px">비밀번호 확인</label>
                  <input type="password" class="email-change change-area" style="height:31px;width:200px;float:right" id="password-confirm" placeholder="비밀번호 확인">
                  <input type="hidden" id="key" name="key">
                  </div>
                  <li >탈퇴하시면 기존 게시글,댓글 등의 데이터는 삭제되지 않습니다.</li>
                  <li>탈퇴후 동일한 아이디로 회원가입이 불가합니다.</li></div>
                  <div class="remove-id"> 
                  <button type=button id="remove-id-cancel-btn" class="btn  btn-secondary chagne-area" >취소</button>
                  <button type=button id="remove-id-btn" class="btn btn-dark active" >탈퇴하기</button>
                  </div>
               </div>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark" >
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
   $("#remove-id-cancel-btn").click(function(e){//취소버튼
      e.preventDefault();
      location.href="myPage.php"
   });
   $("$remove-id-cancel-btn").click(function(e){
      e.preventDefault();
      var password = $("#password").val();
      var passwordConfirm  = $("#password-comfirm").val();

      if(password != passwordconfirm){
         alret("비밀번호와 재입력 비밀번호가 일치하지 않습니다.");
         return false;
      }

        
       var data = new FormData();
            
            data.append("password",password);
            var xhr = new XMLHttpRequest();
            xhr.open("POST","updateMyInfo.php");
             xhr.onload = function(e) {
                 if(this.status == 200) {
                
                     alret( e.currentTarget.responseText)
                       
                    
                 }
             }
             xhr.send(data);

      if(confirm('탈퇴하시겠습니까?')){
         
      }
   });

   </script>
</body>

</html>
