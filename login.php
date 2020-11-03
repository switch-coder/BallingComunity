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
        if(isset($_SESSION["userid"])){
          ?><script>alert("잘못된 접근입니다."); history.back(); </script> <?php
        }?>
  

<div class="container"style="width:40%;">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto" >
        <div class="card card-signin flex-row my-5">
        <div class="card-body">
            <h5 class="card-title text-center">로 그 인</h5>
            <form class="form-signin" id=sub action="login_check.php" method="post">
              <div class="form-label-group">
                <input style="padding:5px;padding-left:12px;" type="text" id="inputUserame" name="inputUserame" class="form-control" placeholder="아이디" required autofocus>
                
              </div>

              <div class="form-label-group">
                <input style="padding:5px;padding-left:12px;" type="password" id="inputpassword" name="inputpassword" class="form-control" placeholder="패스워드" required>
              </div>
              
              <button style="margin-top:33px" class="btn btn-lg btn-info btn-block text-uppercase" type="submit" onclick="sub()">로그인</button>
              <button class="btn btn-lg btn-info btn-block text-uppercase" type="button" onclick="location.href='recovery_id.php'">아이디찾기 / 비밀번호찾기</button>
              <button class="btn btn-lg btn-secondary btn-block text-uppercase" type="button" onclick="location.href='sign_up.php'">회원가입</button>
              
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
    function sub(){
      document.sub.submit();
    }
    </script>
</body>

</html>
