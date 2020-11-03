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

<body onload="LoadPage();">

 <?php include 'navigationbar.php'; ?>

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

      <div class="col-lg-12">

        <div class="card mt-4">
          
          <div class="card-body">
          <form id="EditorForm" name="EditorForm" onsubmit="return FormSubmit(this);">
            <h3 class="card-title">상품등록</h3>
            <div class="form-inline form-group" style="margin-top:40px;" >
              <h4 for="product_name" class="col-sm-2 control-label text-center">상품명</h4>
              <input type="text" class="form-control" id="product_name" name="product_name" style="width:83%">
            </div>
            <div class="form-inline form-group" style="margin-top:20px;" >
             
              <h6 for="product_name" class="col-sm-2 control-label text-center">카테고리</h6>
              <select type="text" class="form-control" id="product_category" name="product_category" style="width:15%">
              <option value="">카테고리</option>
              <option value="가구">가구</option>
              <option value="가전제품">가전제품</option>
              <option value="인테리어소품">인테리어소품</option></select>
              
              <br>   
              <h6 for="product_name" class="col-sm-2 control-label text-center">가격</h6>
              <input type="text" class="form-control" id="product_category" name="product_category" style="width:15%"> </input>
              <span style="margin-left:10px">원</span>
              
            </div>
             
            <textarea name=smarteditor  id=smarteditor cols=85 rows=15 style="display:block;width:100%;height:400px;" ></textarea>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            4.0 stars
            </form>
          </div>
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Product Reviews
          </div>
          <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
            <small class="text-muted">Posted by Anonymous on 3/1/17</small>
            <a href="#" class="btn btn-success">Leave a Review</a>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

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

  <script >
                  //네이버 스마트에디터
    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "smarteditor",
     sSkinURI: "/demo/SmartEditor2Skin.html",
     
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
     
    // function submitContents(elClickedObj) {
    //  oEditors.getById["smarteditor"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
      
     
    //  // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("smarteditor").value를 이용해서 처리하면 됩니다.
    
    //  try {
    
    
    //   if (document.getElementById("smarteditor").value=="<p><br></p>") {
    //    alert("내용을 입력해 주세요.");
    //    oEditors.getById["smarteditor"].exec("FOCUS",[]);
    //    return;
    //   }
    
    //   elclickedObj.submit();//TEXTAREA에 내용이 들어감
    //  } catch(e) {}
    // }
    $("#save").click(function() {
       
    oEditors.getById["smarteditor"].exec("UPDATE_CONTENTS_FIELD", []);
      });
    </script>

</body>
<script type="text/javascript">
//         //<![CDATA[
//         function LoadPage() {
//             CKEDITOR.replace('contents');
//         }

//         function FormSubmit(f) {
//             CKEDITOR.instances.contents.updateElement();
//             if(f.contents.value == "") {
//                 alert("내용을 입력해 주세요.");
//                 return false;
//             }
//             alert(f.contents.value);
            
//             // 전송은 하지 않습니다.
//             return false;
//         }
//         //]]>

//         CKEDITOR.on('dialogDefinition', function (ev) {

// var dialogName = ev.data.name;

// var dialog = ev.data.definition.dialog;

// var dialogDefinition = ev.data.definition;

// if (dialogName == 'image') {

//     dialog.on('show', function (obj) {

//         this.selectPage('Upload'); //업로드텝으로 시작

//     });

//     dialogDefinition.removeContents('advanced'); // 자세히탭 제거

//     dialogDefinition.removeContents('Link'); // 링크탭 제거

// }

// });
    </script>
</html>
