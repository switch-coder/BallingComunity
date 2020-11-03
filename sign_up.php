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
  <script src="location.js" type="text/javascript"></script>
</head>
<style>

    html{
        position: relative;
        height: 100%;
        margin: 0;
    }
    body {
        height:88%;
        background: #EAEAEA;
        background: linear-gradient(to right, #EAEAEA, #EAEAEA);
    }
    .form-signin {
        width: 100%;
    }
    .card-signin {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    overflow: hidden;
    }

    .card-signin .card-title {
    margin-bottom: 2rem;
    font-weight: 300;
    font-size: 1.5rem;
    }

    .card-signin .card-img-left {
    width: 40%;
    /* Link to your background image using in the property below! */
    background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
    background-size: cover;
    }

    .card-signin .card-body {
    padding: 2rem;
    }
  
  .form-signin .btn {
    font-size: 80%;
    border-radius: 5rem;
    letter-spacing: .1rem;
    font-weight: bold;
    padding: 1rem;
    transition: all 0.2s;
  }
  
  .form-label-group {
    position: relative;
    margin-top : 30px;
    margin-bottom: 1rem;
  }
  
  .form-label-group input {
    height: auto;
    font-size:20px;
    
    border-radius: 2rem;
  }
  
  .form-label-group>input,
  .form-label-group>label {
    padding: var(--input-padding-y) var(--input-padding-x);
  }
  
  .form-label-group>label {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    margin-bottom: 0;
    /* Override default `<label>` margin */
    line-height: 1.5;
    color: #495057;
    border: 1px solid transparent;
    border-radius: .25rem;
    transition: all .1s ease-in-out;
  }
  
</style>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="content">
        <div class="content-inside">
        <?php include 'navigationbar.php';
          include 'navigationbar.php';
           if(isset($_SESSION["userid"])){
             ?><script>alert("잘못된 접근입니다."); history.back(); </script> <?php
           }?>
  

<div class="container"style="width:70%;">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto" >
        <div class="card card-signin flex-row my-5">
        <div class="card-body">
            <h5 class="card-title text-center">회원가입</h5>
            <form class="form-signin" name=sub  action="signup_check.php" method="post">
              <div class="form-label-group">
                <input style="float:left;padding:5px;padding-left:12px;width:70%;" type="text" name="inputid" id="inputid" class="form-control" placeholder="영문 +숫자 4~12자" required autofocus>
                <button type=button style="width:28%;height:43px;padding:3px; 0px; 3px; 0px;" class="btn btn-secondary" id="overlapID">아이디 중복확인</button>
              </div>
              <div class="form-label-group">
                <input style="float:left;padding:5px;padding-left:12px;width:70%" type="text" name="nickname" id="nickname" class="form-control" placeholder="특수문자를 제외한 10자 이하" required>
                <button type="button" id="NicknameOverlapCheck" class ="btn btn-secondary" style="width:28%;height:43px;padding:3px; 0px; 3px; 0px;">닉네임 중복 확인</button>
              </div>
             
              <div class="form-label-group">
                <input style="padding:5px;padding-left:12px;" type="password" name="inputpassword" id="inputpassword" class="form-control" placeholder="영문+숫자 6자리 이상" required>
                </div>
             
              <div class="form-label-group">
              <input style="padding:5px;padding-left:12px;" type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="패스워드 확인" required>
              </div>

              

              <div class="form-label-group">
                <input style="float:left;width:49%;padding:5px;padding-left:12px;" type="eamil" id="inputemail" name="inputemail" class="form-control" placeholder="이메일" required>
                <button style="width:47%;margin-left:20px;height:43px;padding-top:10px;" class="btn btn-secondary" type="button" onclick="submitAction();">인증번호 보내기</button>
              </div>
              <div class="form-label-group">
                <input style="padding:5px;padding-left:12px;margin-bottom:30px;" type="text" id="emailcheck" class="form-control" placeholder="인증번호 확인" required>
              </div>
              <select style="float:left;width:49%;margin-right:10px" class="custom-select" name="sido1" id="sido1"></select>
              <select style="width:49%" class="custom-select" name="gugun1" id="gugun1"></select>
              <hr>
              <input type="hidden" id="key" name="key"><input type="hidden" id="email" name="email">
              <button class="btn btn-lg btn-secondary btn-block text-uppercase"id="signup" type="button" onclick="signupcheck()" >회원가입</button>
              <button class="btn btn-lg btn-danger btn-block text-uppercase" type="button" onclick="cancel()">취소</button>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
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
    function cancel(){
      history.back()
    }

  
   
   
    // var id ="";
    // var nickname =""; 
    var idcheck = false;
    var nicknameCheck = false;
    var emailCheck = false;

    var idRegExp = /^[a-zA-z0-9]{4,12}$/; //아이디 정규식
    var pwRegExp = /^[A-Za-z0-9]{6,12}$/; //비밀번호 정규식 검사
    var checkNumber = password.search(/[0-9]/g);//비밀번호 숫자 검사
    var checkEnglish = password.search(/[a-z]/ig);//비밀번호 영문 검사
    

  //아이디 중복체크
  $("#nickname").change(function(){
      nicknameCheck = false;
  });

  // if (!idRegExp.test(id)) {//아이디 유효성검사
  //             alert("아이디는 영문 대소문자와 숫자 4~12자리로 입력해야합니다!");
  //             $('#inputid').focus();
  //             return false;
  //         }
  

    function signupcheck(){

    var key = document.getElementById("key").value; 
    var emailkey = document.getElementById("emailcheck").value; 
    var sido1 = document.getElementById("sido1").value; //시/도
    var gugun1 = document.getElementById("gugun1").value; //구
    var password_confirm = document.getElementById("password-confirm").value; 
    var password = document.getElementById("inputpassword").value; 

    var id = document.getElementById("inputid").value; 
    var nickname = document.getElementById("nickname").value; 

   
      alert(""+password);
    
    if(emailCheck == false){
      alert("이메일 인증번호를 보내기를 눌러주세요");
      $("#email").focus();
      return false;
    }
    if(idcheck == false){
      alert("아이디중복체크를 해주세요");
      $("#inputid").focus();
      return false;
    }
    if(nicknameCheck == false){
      alert("닉네임중복체크를 해주세요");
      $("#nickname").focus();
      return false;
    }
 
    if(!pwRegExp.test(password)){        //비밀번호 유효성검사    
        alert('비밀번호는 숫자+영문자 조합으로 6자리 이상 사용해야 합니다.');
        $('#inputpassword').val('').focus();
        return false;
    }    
 
    if(checkNumber <0 || checkEnglish <0){
        alert("비밀번호는 숫자와 영문자를 혼용하여야 합니다.");
        $('#inputpassword').val('').focus();
        return false;
    }
    if(/(\w)\1\1\1/.test(password)){
        alert('비밀번호는 같은 문자를 4번 이상 사용하실 수 없습니다.');
        $('#password').val('').focus();
        return false;
    }
        
    if(password.search(id) > -1){
        alert("비밀번호에 아이디가 포함되었습니다.");
        $('#password').val('').focus();
        return false;
    }

    if(password_confirm!=password){
      alert ("비밀번호가 일치하지 않습니다.");
      return false;
    }

    if(key!=emailkey){
      alert("인증번호를 확인해주세요");
      return false;
    }
    if(sido1=="시/도 선택" ){
      alert("주소를 입력해주세요");
      return false;
    }

   
    document.sub.submit();

  }
 
  
    </script>
  <script type="text/javascript">
 
  function submitAction(){
   
        var email = document.getElementById("inputemail").value; 
            // if(!isset(email)){
            //     alert("이메일을 입력해주세요");
            //     return;
            // }
            // alert(""+email);
        var text = "";
        var data = new FormData();
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( var i=0; i < 5; i++ ){
            text += possible.charAt(Math.floor(Math.random() * possible.length));}
            
            data.append("text",text);
            data.append("email",email);
            // alert(email+"/"+text);
            document.getElementById("key").value = text;
            document.getElementById("email").value = email;

            var xhr = new XMLHttpRequest();
            xhr.open("POST","emailcheck.php");
            xhr.onload = function(e) {
                if(this.status == 200) {
                    alert(e.currentTarget.responseText);
                    emailCheck = true;
                }
            }

            xhr.send(data);

  }

    </script>

    <script>
$('document').ready(function() {
 var area0 = ["시/도 선택","서울특별시","인천광역시","대전광역시","광주광역시","대구광역시","울산광역시","부산광역시","경기도","강원도","충청북도","충청남도","전라북도","전라남도","경상북도","경상남도","제주도"];
  var area1 = ["강남구","강동구","강북구","강서구","관악구","광진구","구로구","금천구","노원구","도봉구","동대문구","동작구","마포구","서대문구","서초구","성동구","성북구","송파구","양천구","영등포구","용산구","은평구","종로구","중구","중랑구"];
   var area2 = ["계양구","남구","남동구","동구","부평구","서구","연수구","중구","강화군","옹진군"];
   var area3 = ["대덕구","동구","서구","유성구","중구"];
   var area4 = ["광산구","남구","동구",     "북구","서구"];
   var area5 = ["남구","달서구","동구","북구","서구","수성구","중구","달성군"];
   var area6 = ["남구","동구","북구","중구","울주군"];
   var area7 = ["강서구","금정구","남구","동구","동래구","부산진구","북구","사상구","사하구","서구","수영구","연제구","영도구","중구","해운대구","기장군"];
   var area8 = ["고양시","과천시","광명시","광주시","구리시","군포시","김포시","남양주시","동두천시","부천시","성남시","수원시","시흥시","안산시","안성시","안양시","양주시","오산시","용인시","의왕시","의정부시","이천시","파주시","평택시","포천시","하남시","화성시","가평군","양평군","여주군","연천군"];
   var area9 = ["강릉시","동해시","삼척시","속초시","원주시","춘천시","태백시","고성군","양구군","양양군","영월군","인제군","정선군","철원군","평창군","홍천군","화천군","횡성군"];
   var area10 = ["제천시","청주시","충주시","괴산군","단양군","보은군","영동군","옥천군","음성군","증평군","진천군","청원군"];
   var area11 = ["계룡시","공주시","논산시","보령시","서산시","아산시","천안시","금산군","당진군","부여군","서천군","연기군","예산군","청양군","태안군","홍성군"];
   var area12 = ["군산시","김제시","남원시","익산시","전주시","정읍시","고창군","무주군","부안군","순창군","완주군","임실군","장수군","진안군"];
   var area13 = ["광양시","나주시","목포시","순천시","여수시","강진군","고흥군","곡성군","구례군","담양군","무안군","보성군","신안군","영광군","영암군","완도군","장성군","장흥군","진도군","함평군","해남군","화순군"];
   var area14 = ["경산시","경주시","구미시","김천시","문경시","상주시","안동시","영주시","영천시","포항시","고령군","군위군","봉화군","성주군","영덕군","영양군","예천군","울릉군","울진군","의성군","청도군","청송군","칠곡군"];
   var area15 = ["거제시","김해시","마산시","밀양시","사천시","양산시","진주시","진해시","창원시","통영시","거창군","고성군","남해군","산청군","의령군","창녕군","하동군","함안군","함양군","합천군"];
   var area16 = ["서귀포시","제주시","남제주군","북제주군"];

 

 // 시/도 선택 박스 초기화

 $("select[name^=sido]").each(function() {
  $selsido = $(this);
  $.each(eval(area0), function() {
   $selsido.append("<option value='"+this+"'>"+this+"</option>");
  });
  $selsido.next().append("<option value=''>구/군 선택</option>");
 });

 

 // 시/도 선택시 구/군 설정

 $("select[name^=sido]").change(function() {
  var area = "area"+$("option",$(this)).index($("option:selected",$(this))); // 선택지역의 구군 Array
  var $gugun = $(this).next(); // 선택영역 군구 객체
  $("option",$gugun).remove(); // 구군 초기화

  if(area == "area0")
   $gugun.append("<option value=''>구/군 선택</option>");
  else {
   $.each(eval(area), function() {
    $gugun.append("<option value='"+this+"'>"+this+"</option>");
   });
  }
 });


});

var reg_hanengnum = /^[ㄱ-ㅎ|가-힣|a-z|A-Z|0-9|\*]+$/;// 닉네임 정규식

$("#overlapID").click(function (e){//아이디 중복검사 및 유효성검사
      e.preventDefault();
      var uid = $("#inputid");
      var idValue = uid.val();

    //아이디 유효성검사
      if (!idRegExp.test(idValue)) {
                alert("아이디는 영문 대소문자와 숫자 4~12자리로 입력해야합니다!");
                $('#inputid').focus();
                return false;
      }
  
    // 아이디 중복검사
     var overlapCheck = new FormData();
     overlapCheck.append("key","id");
     overlapCheck.append("id", idValue);
          var xhr = new XMLHttpRequest();
          xhr.open("POST","overLapCheck.php");
           xhr.onload = function(e) {
               if(this.status == 200) {
             
                   if( e.currentTarget.responseText =="1"){
                     alert("이미 사용중인 아이디 입니다.");
                     idcheck = false;
                   }else{
                     alert("사용가능한 아이디 입니다");
                     idcheck = true;
                   }
                   
               }
           }
      xhr.send(overlapCheck);
});

$("#NicknameOverlapCheck").click(function (e){
    e.preventDefault();
    
    var nickname = $("#nickname");
    var nicknameValue = nickname.val();

  //닉네임 유효성검사
    if (!reg_hanengnum.test(nicknameValue)) {

        alert("닉네임은 한글/영문/숫자만 입력 가능합니다.");
        $('#nickname').focus();
        return false;

    }

  // 닉네임 중복검사
     var overlapCheckNickname = new FormData();
     overlapCheckNickname.append("key","nickname");
     overlapCheckNickname.append("nickname", nicknameValue);
          var xhr = new XMLHttpRequest();
          xhr.open("POST","overLapCheck.php");
           xhr.onload = function(e) {
               if(this.status == 200) {
                   if( e.currentTarget.responseText =="1"){
                     alert("이미 사용중인 닉네임 입니다.");
                     nicknameCheck = false;
                   }else{
                     alert("사용가능한 닉네임 입니다");
                     nicknameCheck = true;
                   }
                   
               }
           }
        xhr.send(overlapCheckNickname);

   
    
    
});
      </script>
</body>




</html>
