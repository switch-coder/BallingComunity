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
  <!-- <script type="text/javascript" src="/editor/ckeditor/ckeditor.js"></script> -->
  <script type="text/javascript" src="./demo/js/HuskyEZCreator.js" charset="utf-8"></script>
  <script type="text/javascript" src="./demo/js/smarteditor.js" charset="utf-8"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
   </style>
  
<body onload="LoadPage();">


<?php 



$thisPage = 'commu';
include 'navigationbar.php';
include 'mysqldb.php';
if(!isset($_SESSION["userid"])){
  ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php
}
$category ='';
$title='';
$contents='';
$post_no='';
$key= 'post_upload';

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
            <?php if(isset($_POST['post_no'])){
              $title = $_POST['post_title'];
              $category = $_POST['post_category'];
              $post_no = $_POST['post_no'];
              $query_post = "select * from community where no ='$no'";           //글번호 받아와서 community 테이블에서 글찾기
              $result = $db->query($query_post);
              $rows =mysqli_fetch_assoc($result);
              $cont = $rows['contents'];     
              $contents = $_POST['post_contents'];
              $key = "post_update";
              echo "<h3 class='card-title'>게시글 수정</h3>";
            }else{ 
            echo '<h3 class="card-title">게시글 작성</h3>';} ?>
            </div>
           
            <input type="hidden" id="key" name="key" value="<?php echo $key?>">
            <input type="hidden" name="post_no" id="post_no" value="<?php echo $post_no?>">
            <div class="form-inline form-group" style="margin-top:40px;" >
              <h4 for="product_name" class="col-sm-2 control-label text-center">제   목</h4>
              <input type="text" value="<?php echo $title?>" class="form-control" id="title" name="title" style="width:83%" required>
            </div>

            <div class="form-inline form-group" style="margin-top:20px;" >
              <h4 for="product_name" class="col-sm-2 control-label text-center">카테고리</h4>
              <select type="text" class="form-control" id="category" name="category" style="width:15%" >
              <option value="<?php echo $category; ?>"><?php if($category==""){echo "카테고리";}else{echo $category;}?></option>
              <option value="자유게시판">자유게시판</option>
              <option value="Q&A">Q&A</option>
              <option value="팁">팁</option></select>
              <br>   
            </div>
             
            <textarea name=smarteditor  id=smarteditor cols=85 rows=15 style="display:block;width:100%;height:400px;" ><?php echo $contents?></textarea>

            <div class="text-center uploadbtn">
            <button type="submit"  class="btn btn-lg btn btn-dark " style="background-color:#3366CC; border-color:#3366CC">
            <?php if($no==""){echo "게시글 수정";}else{echo "게시글 등록";}?></button>
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
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
   
   $("#upload-cancel-btn").click(function(e){
      e.preventDefault();
      history.back();
   });

   var con = "";


</script>
    <script>
    var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
 oAppRef: oEditors,
 elPlaceHolder: "smarteditor",
 sSkinURI: "./demo/SmartEditor2Skin.html",
 
 htParams : {
			// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseToolbar : true,
			// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,
			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true, 
  },
  fOnAppLoad : function(){

//예제 코드

oEditors.getById["smarteditor"].exec("PASTE_HTML", [con]);
  }

});
function pasteHTML(filepath) {
// var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
 var sHTML = '<span style="color:#FF0000;"><img src="'+filepath+'"></span>';
 oEditors.getById["smarteditor"].exec("PASTE_HTML", [sHTML]);

}

function showHTML() {
 var sHTML = oEditors.getById["smarteditor"].getIR();
 alert(sHTML);


}
 
function submitContents(elClickedObj) {
 oEditors.getById["smarteditor"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
 var category = $("#category").val();
 
 // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("smarteditor").value를 이용해서 처리하면 됩니다.

//  showHTML();textaera 보여주기

 if(category ==""){
         alert("카테고리를 선택해주세요");
         return false ;
    }

  if (document.getElementById("smarteditor").value=="<p><br></p>") {
   alert("내용을 입력해 주세요.");
   oEditors.getById["smarteditor"].exec("FOCUS",[]);
   return;
  }

  elclickedObj.submit();//TEXTAREA에 내용이 들어감

}
$("#save").click(function() {
   
   oEditors.getById["smarteditor"].exec("UPDATE_CONTENTS_FIELD", []);
  });
</script>

</body>
<script type="text/javascript">

    </script>
</html>
