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
div.email{
  height:100px;
}
.divTable.comicGreen .divTableCell, .divTable.comicGreen .divTableHead {
  padding: 20px 5px 20px;
  border-bottom:1px solid #C2C2C2;
  min-width:100px;
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
.divTableCell3 {vertical-align:bottom;}
.change-area{ margin-bottom:10px;width:100% }
.change-area-font{font-size:14px;}
.remove-id{text-align:right;}
.remove{font-size:13px; color: #C2C2C2;}


</style>
<body>
<?php 
$thisPage = 'mypag';
include 'navigationbar.php';
include 'mysqldb.php';
if(!isset($_SESSION["userid"])){
  ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php
}

  $userImage = $_SESSION['userImage'];
  $userID = $_SESSION['userid'];
  $dir = "/userimg/".$userImage;//이미지저장 주소
  
  
  //회원정보 데이터베이스에서 가져오기
  $query = "SELECT * FROM user WHERE userID ='$userID'";
  $result = $db->query($query);
  $email ='';
  $password = '';
  $nickname='';
  if(mysqli_num_rows($result)==1){
    $row=mysqli_fetch_assoc($result);
   $nickname = $row['nickname'];
   $password = $row['password'];
   $email = $row['email'];
   $address = $row['address'];
   $charactersLength = strlen($password);
   $passwordhide="";
   for($i = 0; $i<$charactersLength; $i++){
      $passwordhide .='*';
     }
    }
  ?>

  <!-- Page Content -->
  <div class="container" style="max-width:1200px;width:100%;padding-top:80px">

    <div class="row" style="width:100%">
      <!-- 서브 메뉴바 -->
      <div class="col-lg-3" style="max-width:250px;">
      <?php include 'myPage_sidebar.php'; ?>
        
      
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9" style="max-width:900px;">
        <!-- /.card -->

        
        <div class="card card-outline-secondary my-4">
        
          <div class="card-header" style="font-size:large;font-weight:700;outline-style:hidden;outline-width:0px;">
            기본 회원정보
          </div>
          <div class="card-body">

            <div class="divTable comicGreen">
            <div class="divTableBody">
            <div class="divTableRow">
            <!-- 사진변경 -->
              <div class="divTableCell divTableCell1" style="vertical-align:top;">사진</div>
              <div class="divTableCell divTableCell2"> 
                 <img src=<?php echo $dir?> id="img" width=150px; height=150px; style="margin-bottom:10px">
                <div  id=image-change-area style="display:none">
                <button type=button id="choice-image-btn" onclick="fileUploadAction();" class="btn btn-outline-secondary" >사진선택</button>
                <!-- <a href="javascript:" onclick="fileUploadAction();" class="btn btn-outline-secondary">업로드</a> -->
                <button type=button id="change-default-Image" class="btn btn-outline-secondary" >기본이미지</button>
                <input type=hidden id="default_key" >
                <form><input type=file id=input-img style="display:none"><input type=reset id=input-reset style="display:none"></form></div> </div>
              <div class="divTableCell divTableCell3" >
              <div id=image-area-btn>
              <button type=button id=image-change-btn class="btn btn-outline-dark">사진 변경</button></div>
              <div id="image-change-area-btn" style="display:none">
              <input type=hidden id=user-img value=<?php echo $dir?>>
              <button type=button id="image-change-cancel-btn" class="btn  btn-secondary chagne-area" >취소</button>
              <button type=button id="image-change-check-btn" class="btn btn-dark active chagne-area" >변경하기</button></div></div></div>
              
             <!-- /div tableRow -->
            <!-- 아이디 -->
              <div class="divTableRow">
                <div class="divTableCell divTableCell1">아이디</div>
                <div class="divTableCell"><?php echo $userID?></div>
                <div class="divTableCell "></div></div>
                <!-- /div tableRow -->
            <!-- 비밀번호 변경 -->
             <div class="divTableRow">
              <div class="divTableCell divTableCell1">비밀번호</div>
              <div class="divTableCell" id="password-area"><?php echo $passwordhide?></div>
              <div class="divTableCell" id="password-area-btn" ><button type=button id="pw-change-btn"  class="btn btn-outline-dark" style="min-width:130px;text-align:center; padding:3px 0px 3px 0px">비밀번호 변경</button></div>
                <div  class="divTableCell " id="password-change-area" style="display:none;"> 
                      <div class="change-area">
                        <lable for="password" class="change-area">현재비밀번호</lable>
                        <input class="change-area" type="password" id="password">
                        <span id="password-invalid" class="validate danger" style="display:none"></span>
                        <span id="password-valid" class="validate " style="display:none"></span></div>
                      <div class="change-area">
                        <lable for="password" class="change-area">신규비밀번호</lable>
                        <input class="change-area" type="password" id="newPassword">
                        <span id="password-invalid" class="validate danger" style="display:none"></span>
                        <span id="password-valid" class="validate " style="display:none"></span></div>
                        <div class="password-change-area">
                        <lable for="password" class="change-area">신규비밀번호 확인</lable>
                        <input class="change-area" type="password" id="confirmPassword">
                        <span id="password-invalid" class="validate danger" style="display:none"></span>
                        <span id="password-valid" class="validate " style="display:none"></span></div>
                      <div>
                        <button type=button id="password-change-cancel-btn" class="btn  btn-secondary" >취소</button>
                        <button type=button id="password-change-check-btn" class="btn btn-dark active" >변경하기</button></div>
                      </div>
                      <!-- /div password-chagne-area -->
                      <div class="divTableCell" id="password-change-area2" style="display:none;"></div></div>
                        <!-- /div tableRow -->

            <!--닉네임 변경  -->
             <div class="divTableRow ">
              <div class="divTableCell divTableCell1">닉네임</div>
              <div class="divTableCell" id="nickname-area"><?php echo $nickname?></div>
              <div class="divTableCell" id="nickname-area-btn"><button type=button id="nickname-change-btn" onclick="nicknameChange()" class="btn btn-outline-dark" style="min-width:130px;text-align:center; padding:3px 0px 3px 0px">닉네임 변경</button></div>
              <div class="divTableCell" id="nickname-change-area" style="display:none;">
                <div class="change-area">
                <input class="nickname-change change-area" id="nickname" placeholder="닉네임 입력">
                </div>
                <div>
                <button type=button id="nickname-change-cancel-btn" class="btn  btn-secondary chagne-area" >취소</button>
                <button type=button id="nickname-change-check-btn" class="btn btn-dark active chagne-area" >변경하기</button></div></div>
              <div class="divTableCell" id="nickname-change-area2" style="display:none;"></div></div>
              <!-- /div tableRow -->

            <!-- 이메일 변경 -->
             <div class="divTableRow" id="email-area">
              <div class="divTableCell divTableCell1">이메일</div>
              <div class="divTableCell" id="email-area-email"><?php echo $email?></div>
              <div class="divTableCell">
              <button type=button id="email-area-btn" class="btn btn-outline-dark"  style="min-width:130px;text-align:center; padding:3px 0px 3px 0px">이메일 변경</button></div>
              </div> <!-- /divtableRow  -->
              </div><!-- /divtablebody  -->
              </div> <!-- /divtable -->
             <div class="divTable comicGreen email" id="email-change-area" style="display:none;">
              <div class="divTableBody">
              <div class="divTableRow">
              <div class="divTableCell divTableCell1">이메일</div>
              <div class="divTableCell">
                <div class="change-area change-area-font" >
                  <li >메일주소를 입력후 인증하기 버튼을 누르시면 입력하신 이메일로 인증번호가 전송됩니다.</li>
                  <li>인증번호를 입력하시면 인증완료됩니다.</li></div>
                  <div class="change-area" style="width:300px">
                  <input class="email-change change-area" style="height:31px;width:200px;float:left" id="inputEmail" placeholder="이메일 입력">
                  <button type=button style="width:100px" class="btn btn-dark btn-sm " id="send-emailkey">인증</button>
                  </div>
                  <div>
                  <input class="email-change change-area" style="height:31px; width:300px;" id="emailkey" placeholder="인증번호 입력">
                  <input type="hidden" id="key" name="key">
                  </div>
                  <div>
                  <button type=button id="email-change-cancel-btn" class="btn  btn-secondary chagne-area" >취소</button>
                  <button type=button id="email-change-check-btn" class="btn btn-dark active" >변경하기</button>
                  <button type=button id=reinput-email class="btn btn-dark active" style="display:none">이메일 재입력</button>
                  </div>
                </div> <!-- /divtalbeCell  -->
               </div> <!-- /divtableRow  -->
              </div><!-- /divtablebody  -->
            </div> <!-- /divtable -->
            <br/>
            <!-- <div class="remove-id">
            <hr style="border-bottom:1px #C2C2C2">
            <li class="remove">회원탈퇴를 원하시면 회원탈퇴 버튼을 눌러주세요
            <button type=button id=remove-id class="btn btn-outline-secondary"  style="margin-top:-2px;margin-left:5px;border-color:#C2C2C2;font-color:#C2C2C2;width:90px; padding:3px 0px 3px 0px">회원탈퇴</button></li></div> -->




          
           
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

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<script>
 $( document ).ready( function() {
        $('#list-1').addClass('active');
      } );
    var idRegExp =/^[a-zA-z0-9]{4,12}$/; //아이디 유효성 검사


//프로필이미지 변경
  $("#change-default-Image").click(function(e){//기본이미지로 변경
    e.preventDefault();
    var dir = "./userimg/defaultUserImage.jpg";
    $("#default_key").val("default");
    $("#input-reset").trigger('click');
    $("#img").attr('src',dir);
    
  });
  $(document).ready(function(){
      $("#input-img").on("change", handleImgFileSelect);
    });
  $("#image-change-btn").click(function (e){
        e.preventDefault();
        $("#image-area").css("display","none");
        $("#image-area-btn").css("display","none");
        $("#image-change-area").css("display","");
        $("#image-change-area-btn").css("display","");
    });
  $("#image-change-cancel-btn").click(function (e){
        e.preventDefault();
        var uImage =  $("#user-img").val();
        $("#image-area").css("display","");
        $("#image-area-btn").css("display","");
        $("#image-change-area").css("display","none");
        $("#image-change-area-btn").css("display","none");
        $("#input-reset").trigger('click');
        $("#img").attr('src',uImage);
    });
 

  function fileUploadAction(){
        console.log("fileUploadAction");
        $("#input-img").trigger('click');

  }
  var sel_file;
  function handleImgFileSelect(e){
  
   var files = e.target.files;
   var filesArr = Array.prototype.slice.call(files);

   filesArr.forEach(function(f) {
     if(!f.type.match("image.*")){
       alert("이미지 확장자만 가능합니다.");
       return;
     }
     sel_file= f;

     var reader = new FileReader();
         reader.onload = function(e) {
          $("#default_key").val("");
          $("#img").attr('src',e.target.result);
     }
     reader.readAsDataURL(f);
   });
  }

  $("#image-change-check-btn").click(function (e){
        e.preventDefault();
       var key= $("#default_key").val();
    // alert(""+key);
    if(sel_file==""){
      alert("이미지파일을 선택해주세요");
      return;
    }
    // alert("전송");
    var data = new FormData();
      data.append("default_key",key)
      data.append("key","image");
      data.append("image_",sel_file);
      var xhr = new XMLHttpRequest();
      xhr.open("POST","updateMyInfo.php");
       xhr.onload = function(e) {
           if(this.status == 200) {
            alert( e.currentTarget.responseText);
            location.replace('./myPage.php');
            // $("#image-area").css("display","");
            // $("#image-area-btn").css("display","");
            // $("#image-change-area").css("display","none");
            // $("#image-change-area-btn").css("display","none");
            // $("#input-reset").trigger('click');               
           }
       }
       xhr.send(data);
       
  });
//패스워드 변경
    $("#pw-change-btn").click(function (e){
        e.preventDefault();
        $("#password-area").css("display","none");
        $("#password-area-btn").css("display","none");
        $("#password-change-area").css("display","");
        $("#password-change-area2").css("display","");
    });

    $("#password-change-cancel-btn").click(function (e){
        e.preventDefault();
        $("#password-area").css("display","");
        $("#password-area-btn").css("display","");
        $("#password-change-area").css("display","none");
        $("#password-change-area2").css("display","none");
        
    });


  $("#password-change-check-btn").click(function (e){
    e.preventDefault();
    var password = $('#password');
    var nowPassword = '<?php echo $password?>'   ;  //$("#nowPassword");
    var newPassword = $('#newPassword');
    var confirmPassword = $('#confirmPassword');

    var newPasswordValue = newPassword.val();
    var pwRegExp =/^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,25}$/; //비밀번호 유효성 검사
    var checkNumber = newPasswordValue.search(/[0-9]/g);//비밀번호 숫자 검사
    var checkEnglish = newPasswordValue.search(/[a-z]/ig);//비밀번호 영문 검사
    
    if(password.val() != nowPassword){
      alert("현재비밀번호가 일치하지 않습니다.");
      $("#password").val('').focus();
      return false;
    }
   
    
 
    if(checkNumber <0 || checkEnglish <0){
        alert("숫자와 영문자를 혼용하여야 합니다.");
        $('#newPassword').val('').focus();
        return false;
    }
    if(/(\w)\1\1\1/.test(newPassword.val())){
        alert('같은 문자를 4번 이상 사용하실 수 없습니다.');
        $('#newPassword').val('').focus();
        return false;
    }
    if(!pwRegExp.test(newPassword.val())){        //비밀번호 유효성검사    
            alert('숫자+영문자+특수문자 조합으로 8자리 이상 사용해야 합니다.');
            $('#newPassword').val('').focus();
            return false;
        }   
        
    // if(newPassword.search(id) > -1){
    //     alert("비밀번호에 아이디가 포함되었습니다.");
    //     $('#newPassword').val('').focus();
    //     return false;
    // }
    if(newPassword.val() != confirmPassword.val()){
      alert("신규 비밀번호와 재입력 비밀번호가 일치하지 않습니다.");
        $('#confirmPassword').val('').focus();
        return false;
    }
    if(newPassword.val() == nowPassword){
      alert("신규 비밀번호와 현재 비밀번호가 일치합니다.");
        $('#newPassword').val('').focus();
        return false;
    }
   
    var data = new FormData();
      data.append("key","Password");
      data.append("password",newPasswordValue);
      var xhr = new XMLHttpRequest();
      xhr.open("POST","updateMyInfo.php");
       xhr.onload = function(e) {
           if(this.status == 200) {
               alert(e.currentTarget.responseText);
               
           }
       }
       xhr.send(data);

       $("#password-area").css("display","");
       $("#password-area-btn").css("display","");
       $("#password-change-area").css("display","none");
       $("#password-change-area2").css("display","none");
       $("#key").val("");
       $("#password-area").empty();
       var passwordlength = '';
       for(var i=0; i<newPassword.val().length; i++){
         passwordlength += '*';
         
       }
       $("#password-area").append(passwordlength);
    
});
//닉네임 변경
  $("#nickname-change-btn").click(function (e){
      e.preventDefault();
      $("#nickname-area").css("display","none");
      $("#nickname-area-btn").css("display","none");
      $("#nickname-change-area").css("display","");
      $("#nickname-change-area2").css("display","");
  });

  $("#nickname-change-cancel-btn").click(function (e){
      e.preventDefault();
      $("#nickname-area").css("display","");
      $("#nickname-area-btn").css("display","");
      $("#nickname-change-area").css("display","none");
      $("#nickname-change-area2").css("display","none");
  });


  $("#nickname-change-check-btn").click(function (e){
    e.preventDefault();
    var reg_hanengnum =/^[ㄱ-ㅎ|가-힣|a-z|A-Z|0-9|\*]+$/;// 닉네임 정규식
    var nickname= $("#nickname");
    var nicknameValue = nickname.val();
    if (!reg_hanengnum.test(nicknameValue)) {//닉네임 유효성검사
      alert("닉네임은 한글/영문/숫자만 입력 가능합니다.");
      $('#nickname').val('').focus();
      return false;
    }
    
    var data = new FormData();
      data.append("key","nickname");
      data.append("nickname",nicknameValue);
      var xhr = new XMLHttpRequest();
      xhr.open("POST","updateMyInfo.php");
       xhr.onload = function(e) {
           if(this.status == 200) {
          
               if( e.currentTarget.responseText =="1"){
                 alert("이미 사용중인 닉네임 입니다.");
                 return false;
               }else{
                 alert("닉네임이 변경되었습니다.");
                 window.location.reload();
                 
                 return true;
               }
               
           }
       }
       xhr.send(data);
      
     
      
  });
    
  

//이메일 변경
  $("#email-area-btn").click(function (e){
      e.preventDefault();
      $("#email-area").css("display","none");
      $("#email-change-area").css("display","");
  });
  $("#email-change-cancel-btn").click(function (e){
      e.preventDefault();
      $("#email-area").css("display","");
      $("#email-change-area").css("display","none");
  });

  $("#reinput-email").click(function (e){//이메일 인증번호 전송후 이메일 다시입력시
      e.preventDefault();
      $("#inputEmail").attr("disabled",false);
      $("#reinput-email").css("display","none");
      $("#key").val("");
      $("#inputEmail").val("");
  });
  $("#send-emailkey").click(function(e){

    e.preventDefault();
    var inputEmail = $("#inputEmail");
    var emailValue = inputEmail.val();

    if(!isValidEmail(emailValue)){//이메일 유효성검사
      alert('이메일 주소가 올바르지 않습니다.');
      return false;
    }else{
      if(confirm('인증 메일을 발송하시겠습니까?')){//이메일 인증번호 전송후
        submitAction(emailValue);
        $("#inputEmail").attr("disabled",true);
        $("#reinput-email").css("display","");

      }
    }
  });
  function submitAction(emailValue){//해당 이메일로 인증번호전송
   
   var email = emailValue;
       // if(!isset(email)){
       //     alert("이메일을 입력해주세요");
       //     return;
       // }
       alert(""+email);
   var text = "";
   var data = new FormData();
   var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

   for( var i=0; i < 5; i++ ){
       text += possible.charAt(Math.floor(Math.random() * possible.length));}
       
       data.append("text",text);
       data.append("email",email);
       // alert(email+"/"+text);
       document.getElementById("key").value = text;//생성한 인증번호 키 히든에 저장

       var xhr = new XMLHttpRequest();
       xhr.open("POST","emailcheck.php");
       xhr.onload = function(e) {
           if(this.status == 200) {
               alert(e.currentTarget.responseText);
           }
       }

       xhr.send(data);

   }

  $("#email-change-check-btn").click(function (e){//이메일 변경버튼
    e.preventDefault();
    var emailKey=$("#key").val();
    var inputemailKey=  $("#emailkey").val();
    if(emailKey != inputemailKey){
      alret("인증번호가 일치하지 않습니다. 인증번호를 확인해주세요.");
      return false;
    }else{
      var inputemail = $("#inputEmail").val();

      var data = new FormData();
      data.append("key","email");
      data.append("email",inputemail);
      var xhr = new XMLHttpRequest();
      xhr.open("POST","updateMyInfo.php");
       xhr.onload = function(e) {
           if(this.status == 200) {
               alert(e.currentTarget.responseText);
               
           }
       }

       xhr.send(data);
       $("#email-area").css("display","");
       $("#email-change-area").css("display","none");
       $("#key").val("");
       $("#email-area-email").empty();
       $("#email-area-email").append(inputemail);

    }
  });
   
  function isValidEmail(email) {//이메일 유효성검사
                var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return emailRegex.test(email);
            }







//회원탈퇴
 $("#remove-id").click(function(e){
   e.preventDefault();
  location.href="removeId.php";
 });
</script>
</body>

</html>
