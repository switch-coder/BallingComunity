

<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
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
.dropmenu ul {
  display : none;
  padding : 0;
  position : absolute;
  left: 0;
  top: 100%;
  width : 120px;
}

#on{
  color : #FFFFFF;
  font-size : 20px;
  font-weight : bold;
  margin-right : 17px;
  margin-left :  17px;
  
}
#myon{
  color : #FFFFFF;
  font-size : 20px;
  font-weight : bold;
}
.mypa{
  font-size : 16px;
  font-weight : 570;
  margin :1px 1px 1px 1px;
}
.dropmenu ul li { float: none;}
ul.dropmenu >li {display:inline-block; position:relative;}
ul.dropmenu > li ul.submenu {display:none; position:absolute;} 
ul.dropmenu > li:hover ul.submenu {display:block;} 
ul.dropmenu > li ul.submenu >li{display:inline-block; width:120px; padding:5px 10px; text-align:center;}

</style>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" <?php if($thisPage=='home'){echo "id=on";} ?> href="main.php">300PERFECT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarResponsive">
        <ul class="navbar-nav ml-auto dropmenu" id="navmenu">
        <?php if(isset($_SESSION['userid'])){
          include 'mysqldb.php';
          
              $nickname = $_SESSION['userNickname'];
              $userImage = $_SESSION['userImage'];
              $dir = "/userimg/".$userImage;//이미지저장 주소
          }?>
          <!-- <li class="nav-item " >
            <a class="nav-link" <?php if($thisPage=='home'){echo "id=on";} ?> href="main.php">
              <span class="sr-only">(current)</span></a>
          </li> -->

          <li class="nav-item" >
            <a class="nav-link" <?php if($thisPage=='commu'){echo  "id=on";} ?> href="community.php?page=1">커뮤니티</a>
          </li>

          <li class="nav-item" >
            <a class="nav-link"<?php if($thisPage=='recom'){echo  "id=on";} ?> href="recommend.php?page=1">볼링장 추천</a>
          </li>

          <li class="nav-item" <?php if($thisPage=='mypag'){echo  "id=on";} ?>><?php

            if(!isset($_SESSION['userid'])){
                echo "<a class='nav-link' href='login.php'>로그인</a>";
            
              }else{
               echo "<img src=$dir style='float:left;'";if($thisPage=='mypag'){echo "id=myon width='55' height='55'";  }else{echo "width='40' height='40' ";}echo ">";
               echo "<a class='nav-link'style='float:left'";if($thisPage=='mypag'){echo "id=myon";  }echo ">$nickname</a>";
               echo   "<ul class='submenu navbar-dark bg-dark'>";
               echo     "<li class='nav-item'> <a class='nav-link submenuLink mypa' href='myPage.php'>마이페이지</a> </li>";
               echo     "<li class='nav-item'> <a class='nav-link submenuLink mypa' href='myContents.php?page=1&type=text'>내가올린글</a> </li>";
               echo     "<li class='nav-item'> <a class='nav-link submenuLink mypa' href='report.php?page=1'>신고내역</a> </li>";
               echo     "<li class='nav-item'> <a class='nav-link submenuLink mypa' href='logout.php'>로그아웃</a> </li>";
               echo '</ul>';

            }?>            
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>

$(function(){
  var sBtn = $("ul > li");    //  ul > li 이를 sBtn으로 칭한다. (클릭이벤트는 li에 적용 된다.)
  sBtn.find("a").click(function(){   // sBtn에 속해 있는  a 찾아 클릭 하면.
   sBtn.removeClass("on");     // sBtn 속에 (active) 클래스를 삭제 한다.
   $(this).parent().addClass("on"); // 클릭한 a에 (active)클래스를 넣는다.
  });
 });


          </script>


</body>
</html>