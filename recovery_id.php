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
    <div class="content">
        <div class="content-inside">

        <?php include 'navigationbar.php';
         include 'navigationbar.php';
        if(isset($_SESSION["userid"])){
          ?><script>alert("잘못된 접근입니다."); history.back(); </script> <?php
        }?>
       

<div class="container"style="width:60%;">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto" >
        <div class="card card-signin flex-row my-5">
        <div class="card-body">
            <h5 class="card-title text-center">아이디 찾기</h5>
            
              <div class="form-label-group ">
                <input style="float:left;padding:5px;padding-left:12px;width:40%;margin-right:10px" type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder=" 이메일을 입력해주세요" required autofocus>
                <span style="float:left;">@</span>
                <input style="float:left;padding:5px;padding-left:12px;width:30%;margin-left:10px;margin-bottom:30px;" type="text" id="selboxDirect" name="selboxDirect" disabled value="네이버"/>
                <select style="float:left;padding:5px;padding-left:12px;width:20%;margin-left:10px;margin-bottom:30px;" type="text" id="selboxEmail" name="selboxEmail" class="form-control" placeholder="" required autofocus>
                <option value="direct">직접입력</option>
                <option value="naver.com" selected>네이버</option>
                <option value="nate.com">네이트</option>
                <option value="gmail.com">구글</option>
                <option value="daum.com">다음</option>
                <option value="yahoo.com">야후</option>
                
                </select>
               
              </div>
        
              <button style="margin-top:100px" class="btn btn-lg btn-info btn-block text-uppercase" id="recovery_id" onclick="recovery_id()">아이디 찾기</button>
              

              <hr>
              <h5 class="card-title text-center" style="margin-top:50px;">비밀번호 찾기</h5>
            <form class="form-signin" id=sub action="login_check.php" method="post">
              <div class="form-label-group ">
                <input style="float:left;padding:5px;padding-left:12px;margin-bottom:20px;width:100%;margin-right:10px" type="text" id="inputUserame" name="inputUserame" class="form-control" placeholder=" 아이디" required autofocus>
                <input style="float:left;padding:5px;padding-left:12px;width:40%;margin-right:10px" type="text" id="inputEmail_password" name="inputEmail_password" class="form-control" placeholder=" 이메일을 입력해주세요" required autofocus>
                <span style="float:left;">@</span>
                <input style="float:left;padding:5px;padding-left:12px;width:30%;margin-left:10px;margin-bottom:30px;" type="text" id="selboxDirect1" name="selboxDirect1" disabled value="네이버"/>
                <select style="float:left;padding:5px;padding-left:12px;width:20%;margin-left:10px;margin-bottom:30px;" type="text" id="selboxEmail1" name="selboxEmail1" class="form-control" placeholder="" required autofocus>
                <option value="direct">직접입력</option>
                <option value="naver.com" selected>네이버</option>
                <option value="nate.com">네이트</option>
                <option value="gmail.com">구글</option>
                <option value="daum.com">다음</option>
                <option value="yahoo.com">야후</option>
                </select>
              </div>
              <button style="margin-top:100px" class="btn btn-lg btn-info btn-block text-uppercase"type="button" id="discovery_password" onclick="recovery_password()">비밀번호 찾기</button>
              <button style="margin-top:20px;font-size:large;" class="btn btn-lg btn-link btn-block text-uppercase" id="login_btn" href="login.php">로그인</button>

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
  
    $('#selboxEmail').change(function(){ 
        $("#selboxEmail option:selected").each(function () { 
            if($(this).val()=='direct'){ 
                //직접입력일 경우 
                $("#selboxDirect").val(''); //값 초기화 
                $("#selboxDirect").attr("disabled",false); //활성화 
                
            }else{ 
                //직접입력이 아닐경우 
                $("#selboxDirect").val($(this).text()); //선택값 입력 
                $("#selboxDirect").attr("disabled",true); //비활성화 
            } 
        }); 
    });
    </script>
    <script>
    function recovery_id(){//아이디 찾기
     
      // alert (" / "+email1);

      var email2 ="";//이메일 사이트
      // 이메일 직접입력 여부
      if(document.getElementById("selboxEmail").value =='direct'){//직접입력일때
        email2 = document.getElementById("selboxDirect").value;
      }else{//이메일 선택일때
        email2 = document.getElementById("selboxEmail").value;
      }
      var email1 = document.getElementById("inputEmail").value; 
     
      var email = email1+'@'+email2;

      // alert ("/"+email);

      var data = new FormData();
      data.append("category","ID");//아이디 찾기 카테고리 
      data.append("email", email);


      var xhr = new XMLHttpRequest();
            xhr.open("POST","./recovery_check.php");
            xhr.onload = function(e) {
                if(this.status == 200) {
                    alert(e.currentTarget.responseText);  //업로드 전송 콜백값
                }
            }
 
            xhr.send(data);
           
 
    }  

    function recovery_password(){

      var email2 ="";//이메일 사이트
      // 이메일 직접입력 여부
      if(document.getElementById("selboxEmail1").value =='direct'){//직접입력일때
        email2 = document.getElementById("selboxDirect1").value;
      }else{//이메일 선택일때
        email2 = document.getElementById("selboxEmail1").value;
      }
      var email1 = document.getElementById("inputEmail_password").value; 
     
      var email = email1+'@'+email2;
      var userID = document.getElementById("inputUserame").value; 
      // alert ("/"+email);

      var data = new FormData();
      data.append("category","Password");//아이디 찾기 카테고리 
      data.append("email", email);
      data.append("userID",userID);

      var xhr = new XMLHttpRequest();
            xhr.open("POST","./recovery_check.php");
            xhr.onload = function(e) {
                if(this.status == 200) {
                    alert(e.currentTarget.responseText);  //업로드 전송 콜백값
                }
            }
 
            xhr.send(data);

    }

   



  
    </script>
</body>

</html>
