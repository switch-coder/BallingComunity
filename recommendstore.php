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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>

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
   .modal {
            display: none; /* Hidden by default */
            position: center; /* Stay in place */
            z-index: 10; /* Sit on top */
           
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
   }
  .modal_content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 1300px; /* Could be more or less, depending on screen size */
            z-index:11;                          
  }
  [type="radio"] {
    border: 0;
    height: 1px; margin: -1px;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  /* One radio button per line */
  label {
    display: block;
    cursor: pointer;  /*hand view when on hover*/
    
   
  }
  
  /* the basic, unchecked style */
  [type="radio"] + span:before {
    content: '';
    display: inline-block;
    width: 17px;
    height: 17px;
    vertical-align: -0.25em;
    border-radius: 1em;           /*hard border*/
    border: 3px solid #FFFFFF;
    box-shadow: 0 0 0 2px #696969;   /*light shadow*/
    margin-top:40px;
    margin-right:15px;
    transition: 0.5s ease all;    /*animation here*/
  }
  
  /* the checked style using the :checked pseudo class */
  [type="radio"]:checked + span:before {
    background: #2983A1;
    box-shadow: 0 0 0 2px #2983A1;
    
  }
   </style>
  
<!-- 카카오css -->
   <style>
   .map_wrap a, .map_wrap a:hover, .map_wrap a:active{color:#000;text-decoration: none;}
   .map_wrap {position:relative;width:100%;height:500px;}
   #menu_wrap {position:absolute;top:0;left:0;bottom:0;width:250px;margin:10px 0 30px 10px;padding:5px;overflow-y:auto;background:rgba(255, 255, 255, 0.7);z-index: 1;font-size:12px;border-radius: 10px;}
   .bg_white {background:#fff;}
   #menu_wrap hr {display: block; height: 1px;border: 0; border-top: 2px solid #5F5F5F;margin:3px 0;}
   #menu_wrap .option{text-align: center;}
   #menu_wrap .option p {margin:10px 0;}  
   #menu_wrap .option button {margin-left:5px;}
   #placesList li {list-style: none;}
   #placesList .item {position:relative;border-bottom:1px solid #888;overflow: hidden;cursor: pointer;min-height: 65px;}
   #placesList .item span {display: block;margin-top:4px;}
   #placesList .item h5, #placesList .item .info {;overflow: hidden;white-space: nowrap;}
   #placesList .item .info{padding:10px 0 10px 5px;}
   #placesList .info .gray {color:#8a8a8a;}
   #placesList .item .markerbg {float:left;position:absolute;width:36px; height:37px;margin:10px 0 0 10px;background:url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png) no-repeat;}
   #placesList .info .tel {color:#009900;}
   #pagination {margin:10px auto;text-align: center;}
#pagination a {display:inline-block;margin-right:10px;}
#pagination .on {font-weight: bold; cursor: default;color:#777;}

</style>



<body onload="LoadPage();">


<?php 

$thisPage = 'recom';
include 'navigationbar.php';
include 'mysqldb.php';
if(!isset($_SESSION["userid"])){
  ?><script>alert("로그인이 필요합니다.");location.replace('./login.php'); </script> <?php
}
$category ='';
$title='';
$contents='';
$post_no='';
$key= 'upload';//글쓰기 키값

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
          
     
          <form id="EditorForm" name="EditorForm" method="post" onsubmit="return submitContents(this)" action="recommendUpload.php">
             <div class="wrheader">
            <?php if(isset($_POST['post_no'])){     //수정인지 그냥 글쓰기 인지 체크
              $title = $_POST['post_title'];        // 게시글 제목
              $youtu_title = $_POST['youtu_title']; //영상제목
              $youtu_url = $_POST['youtu_url'];     //영상이미지
              $post_no = $_POST['post_no'];         //글번호
              $query_post = "select * from v_community where no ='$no'";           //글번호 받아와서 community 테이블에서 글찾기
              $result = $db->query($query_post);
              $rows =mysqli_fetch_assoc($result);
              $cont = $rows['contents'];     
              $contents = $_POST['post_contents'];
              $key = "v_post_update";               //키값 수정 
              echo "<h3 class='card-title'>게시글 수정</h3>";
            }else{ 
            echo '<h3 class="card-title">볼리장 추천 하기</h3>';} ?>
            </div>
            <input type="hidden" id="youtubeId" name="youtubeId" value="">
            <div class="form-inline form-group" style="margin-top:40px;" >
               <h4 for="product_name" class="col-sm-2 control-label text-center">볼링장 검색</h4>
               
               <input type=text id="search_box" class="form-control" style="min-width:500px;width:74%;" placeholder="검색하고 싶은 볼링장을 입력해주세요!!" />
               <button id="newpage" type="button" class=" btn btn-dark " style="width:100px" ><i class="fas fa-search"></i></button>
          
            </div>
             <div style="padding-top:10px;">
             <h4 for="product_name" class="col-sm-2 control-label text-center">볼링장 정보</h4>
             <div style="margin:10px 30px 30px 30px;padding:30px 30px 30px 30px;border:1px solid #c2c2c2;display:flex;">
             <div style="justify-content:left;display:inline-block;border-right:1px solid #c2c2c2;margin-right:20px" >
                <div class="form-inline form-group" style="width:470px;">
                  <h5 class="col-sm-3 control-label text-center" style="width:120px"> 가게명    </h5> <span id="name">볼링장을 검색해주세요</span>
                </div>
                <div class="form-inline form-group" style="width:470px;margin-top:40px">
                <h5 class="col-sm-3 control-label text-center" style="width:120px"> 주 소  </h5> <span id="address"></span>
                </div>
                <div class="form-inline form-group" style="width:470px;margin-top:40px">
                <h5 class="col-sm-3 control-label text-center" style="width:120px"> 전화번호  </h5> <span id="tel"></span>
                </div>
              </div>


              <div style="justify-content:right;">
                <div class="form-inline " style="width:500px">
                  <h5 class="col-sm-4 control-label text-center" style="margin-right:50px">가격<span style="font-size:15px">(주말 기준)</span>  </h5> 
                  <span ><input type="text"  id="price" name="price" style="text-align:right" maxlength="7" placeholder="100만원 미만 입력가능"> 원</span>
                </div>


               <div class="form-inline form-group" style="width:500px">
              <h5 class="col-sm-4 control-label text-center" style="margin-right:10px;margin-top:40px">레인수  </h5> 
                    <span id="line" style="">
                    
                            <label for="line-one" style="width:90px;float:left;">
                            <input type="radio" value="1" name="line" id="line-one" checked> <span>12 이하</span>
                            </label>
                            
                            <label for="line-two" style="width:90px;float:left;">
                            <input type="radio" value="2" name="line" id="line-two"> <span >12~20</span>
                            </label>
                            
                            <label for="line-three" style="width:90px;float:left;">
                            <input type="radio" value="3"  name="line" id="line-three" > <span >20 이상</span>
                            </label>
                      </span>
               </div>
               <div class="form-inline form-group" style="width:500px;">
              <h5 class="col-sm-4 control-label text-center" style="margin-right:10px;margin-top:40px">레인상태  </h5> 
                    <span id="line_quality">
                            <label for="quality-one" style="width:90px;float:left;">
                            <input type="radio" value="3" name="line_quality" id="quality-one" checked> <span>좋음</span>
                            </label>
                            
                            <label for="quality-two" style="width:90px;float:left;">
                            <input type="radio" value="2" name="line_quality" id="quality-two"> <span >보통</span>
                            </label>
                            
                            <label for="quality-three" style="width:90px;float:left;">
                            <input type="radio" value="1"  name="line_quality" id="quality-three" > <span >나쁨</span>
                            </label>
                    </span>
               </div>
              </div>
              
             </div>
             </div>
                <input id='title' name='title' type="hidden" value="<?php echo $_POST['youtu_id'] ?>" required> 
                <input id='addressValue' name='addressValue' type="hidden" value="<?php echo $_POST['youtu_title'] ?>" required> 
                <input id='telValue' name='telValue' type="hidden" value="<?php echo $_POST['youtu_url'] ?>" required>
                <input id='placesId' name='placesId' type="hidden" value="<?php echo $_POST['youtu_id'] ?>" required> 
                <input id='placesx' name='placesx' type="hidden" value="<?php echo $_POST['youtu_id'] ?>" required> 
                <input id='placesy' name='placesy' type="hidden" value="<?php echo $_POST['youtu_id'] ?>" required> 


            <input type="hidden" id="key" name="key" value="<?php echo $key?>">
            <input type="hidden" name="post_no" id="post_no" value="<?php echo $post_no?>">
           
            <!-- <div style="text-align:right;margin-top:0px" id=counter>(0 / 최대 50자)</div> -->

            <div class="form-inline form-group" style="margin-top:20px;" >
               <h4 for="product_name" class="col-sm-2 control-label text-center">나의 평가</h4>
                
               <div style="margin:10px 30px 10px 30px;display:flex;width:100%">
               <textarea name=smarteditor  id=smarteditor cols=85 rows=15 style="display:block;width:100%;height:200px;padding:20px 20px 20px 20px;" placeholder="나의 평가를 입력해주세요!" required><?php echo $contents?></textarea>
               </div>
            </div>
            <div class="form-inline form-group" style="margin-bottom:40px">
                  <h4 for="product_name" class="col-sm-2 control-label text-center">총 점</h4>
                  <button type=button id="1-star" class="btn btn-outline-secondary" onclick="rate(1)" style="border:none"><i class="far fa-star"></i></button>
                  <button type=button id="2-star" class="btn btn-outline-secondary" onclick="rate(2)" style="border:none"><i class="far fa-star"></i></button>
                  <button type=button id="3-star" class="btn btn-outline-secondary" onclick="rate(3)" style="border:none"><i class="far fa-star"></i></button>
                  <button type=button id="4-star" class="btn btn-outline-secondary" onclick="rate(4)" style="border:none"><i class="far fa-star"></i></button>
                  <button type=button id="5-star" class="btn btn-outline-secondary" onclick="rate(5)" style="border:none"><i class="far fa-star"></i></button>
                  
                </div>
                <input type=hidden id="star" name="star">
            <div class="text-center uploadbtn">
            <button id="sub" type="submit"  class="btn btn-lg btn btn-dark " style="background-color:#3366CC; border-color:#3366CC">
            <?php if(isset($_POST['post_no'])){echo "영상 게시글 수정";}else{echo "영상 게시글 등록";}?></button>
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
      <p class="m-0 text-center text-white">Copyright &copy; sang Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>
  <!-- madal 모달창 -->
       <!-- <div class="card-body"> -->
       <div id="myModal" class="modal" >
      
      <!-- Modal content -->
      <div class="modal_content" >
              <div style="float:right">
                <button type="button" id="modal-close" class='btn btn-outline-dark' style='border:none;padding:0px 7px 0px 7px;margin:0px;font-size:20px'>
                <i class="fas fa-times"></i>
                </button>
              </div>

               <p style="text-align: center;"><span style="font-size: 14pt;"><b><span style="font-size: 24pt;">볼링장 찾기</span></b></span></p>

               <div class="map_wrap">
                <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>

                <div id="menu_wrap" class="bg_white">
                    <div class="option">
                        <div>
                            
                                <span>키워드 : <input type="text" value="" id="keyword" size="12">  </span>
                                <span><button type="button" onclick="searchPlaces();">검색하기</button>  </span>
                            
                        </div>
                      </div>
                          <hr>
                          <p style="paddin:0px 0px 0px 0px" id="placesList"></p>
                          <div id="pagination"></div>
                      </div>
                </div>
               

               <hr style="margin: 30px 0px 10px 0px;background-color:#C2C2C2"/>
            <!-- <div style="cursor:pointer;background-color:#DDDDDD;text-align:left;padding-bottom: 10px;padding-top: 10px;" onClick="close_pop();"> -->
            <div style="text-align:center">
            <span id=test></span>
            <button type=button class="btn" id="modal_pic" style="text-align:center;background-color:#fff;border:none;width:70px" >선택</button>
            </div>
            
               
            
      </div>
   </div>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=db6aed39e36d5db0ad08bfbcde30d1d0&libraries=services"></script>

  <script>
// 마커를 담을 배열입니다


var markers = [];

var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = {
        center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };  

// 지도를 생성합니다    
var map = new kakao.maps.Map(mapContainer, mapOption); 

// 장소 검색 객체를 생성합니다
var ps = new kakao.maps.services.Places();  

// 검색 결과 목록이나 마커를 클릭했을 때 장소명을 표출할 인포윈도우를 생성합니다
var infowindow = new kakao.maps.InfoWindow({zIndex:12});

// 키워드로 장소를 검색합니다
searchPlaces();


// 키워드 검색을 요청하는 함수입니다
function searchPlaces() {

    var keyword = document.getElementById('keyword').value;

   

    // 장소검색 객체를 통해 키워드로 장소검색을 요청합니다
    ps.keywordSearch( keyword, placesSearchCB); 
}

// 장소검색이 완료됐을 때 호출되는 콜백함수 입니다
function placesSearchCB(data, status, pagination) {
    if (status === kakao.maps.services.Status.OK) {

        // 정상적으로 검색이 완료됐으면
        // 검색 목록과 마커를 표출합니다
        displayPlaces(data);

        // 페이지 번호를 표출합니다
        displayPagination(pagination);

    } else if (status === kakao.maps.services.Status.ZERO_RESULT) {

        alert('검색 결과가 존재하지 않습니다.');
        return;

    } else if (status === kakao.maps.services.Status.ERROR) {

        alert('검색 결과 중 오류가 발생했습니다.');
        return;

    }
}

// 검색 결과 목록과 마커를 표출하는 함수입니다
function displayPlaces(places) {

    var listEl = document.getElementById('placesList'), 
    menuEl = document.getElementById('menu_wrap'),
    fragment = document.createDocumentFragment(), 
    bounds = new kakao.maps.LatLngBounds(), 
    listStr = '';
    
    // 검색 결과 목록에 추가된 항목들을 제거합니다
    removeAllChildNods(listEl);

    // 지도에 표시되고 있는 마커를 제거합니다
    removeMarker();
    
    for ( var i=0; i<places.length; i++ ) {

        // 마커를 생성하고 지도에 표시합니다
        var placePosition = new kakao.maps.LatLng(places[i].y, places[i].x),
            marker = addMarker(placePosition, i), 
            itemEl = getListItem(i, places[i]); // 검색 결과 항목 Element를 생성합니다

        // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
        // LatLngBounds 객체에 좌표를 추가합니다
        bounds.extend(placePosition);

        // 마커와 검색결과 항목에 mouseover 했을때
        // 해당 장소에 인포윈도우에 장소명을 표시합니다
        // mouseout 했을 때는 인포윈도우를 닫습니다
        (function(marker, title) {
            kakao.maps.event.addListener(marker, 'mouseover', function() {
                displayInfowindow(marker, title);
            });

            kakao.maps.event.addListener(marker, 'mouseout', function() {
                infowindow.close();
            });

            itemEl.onmouseover =  function () {
                displayInfowindow(marker, title);
            };

            itemEl.onmouseout =  function () {
                infowindow.close();
            };
        })(marker, places[i].place_name);

        fragment.appendChild(itemEl);
    }

    // 검색결과 항목들을 검색결과 목록 Elemnet에 추가합니다
    listEl.appendChild(fragment);
    menuEl.scrollTop = 0;

    // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
    map.setBounds(bounds);
}

// 검색결과 항목을 Element로 반환하는 함수입니다
function getListItem(index, places) {
    
    var el = document.createElement('li'),
    itemStr = '<label for="radio-'+(index+1)+'" style="margin-left:10px;">'+
                  '<input type="radio" value="'+(index+1)+'"onclick="clickable()" name="quality" id="radio-'+(index+1)+'"><span> '+
                '<div class="info" style="float:right"><input type="hidden" id="placesId'+(index+1)+'" value="'+places.id+ '">' +
                '<input type="hidden" id="placesx'+(index+1)+'" value="'+places.x+ '">' +
                '<input type="hidden" id="placesy'+(index+1)+'" value="'+places.y+ '">' +
                '</span><h6  id="name'+(index+1)+'">'+(index+1)+'.'+places.place_name + '</h6>';

    if (places.road_address_name) {
        itemStr += '    <span id="address'+(index+1)+'">' + places.road_address_name + '</span>' +
                    '   <span class="jibun gray">' +  places.address_name  + '</span>';
    } else {
        itemStr += '    <span  id="address'+(index+1)+'">' +  places.address_name  + '</span>'; 
    }
                 
      itemStr += '  <span class="tel"  id="tel'+(index+1)+'">' + places.phone  + '</span>' +
                '<span class="url"  id="url'+(index+1)+'"><a href="'+ places.place_url  +'" target="_blank">상세보기</a></span>' +
                '</div></span></label>';           

    el.innerHTML = itemStr;
    el.className = 'item';

    return el;
}

// 마커를 생성하고 지도 위에 마커를 표시하는 함수입니다
function addMarker(position, idx, title) {
    var imageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
        imageSize = new kakao.maps.Size(36, 37),  // 마커 이미지의 크기
        imgOptions =  {
            spriteSize : new kakao.maps.Size(36, 691), // 스프라이트 이미지의 크기
            spriteOrigin : new kakao.maps.Point(0, (idx*46)+10), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
            offset: new kakao.maps.Point(13, 37) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
        },
        markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions),
            marker = new kakao.maps.Marker({
            position: position, // 마커의 위치
            image: markerImage 
        });

    marker.setMap(map); // 지도 위에 마커를 표출합니다
    markers.push(marker);  // 배열에 생성된 마커를 추가합니다

    return marker;
}

// 지도 위에 표시되고 있는 마커를 모두 제거합니다
function removeMarker() {
    for ( var i = 0; i < markers.length; i++ ) {
        markers[i].setMap(null);
    }   
    markers = [];
}

// 검색결과 목록 하단에 페이지번호를 표시는 함수입니다
function displayPagination(pagination) {
    var paginationEl = document.getElementById('pagination'),
        fragment = document.createDocumentFragment(),
        i; 

    // 기존에 추가된 페이지번호를 삭제합니다
    while (paginationEl.hasChildNodes()) {
        paginationEl.removeChild (paginationEl.lastChild);
    }

    for (i=1; i<=pagination.last; i++) {
        var el = document.createElement('a');
        el.href = "#";
        el.innerHTML = i;
        el.addEventListener('click', function(){
         $("#modal_pic").attr('disabled',true);
        });
      

        if (i===pagination.current) {
            el.className = 'on';
        } else {
            el.onclick = (function(i) {
                return function() {
                    pagination.gotoPage(i);
                }
            })(i);
        }

        fragment.appendChild(el);
    }
    paginationEl.appendChild(fragment);
}

// 검색결과 목록 또는 마커를 클릭했을 때 호출되는 함수입니다
// 인포윈도우에 장소명을 표시합니다
function displayInfowindow(marker, title) {
    var content = '<div style="padding:5px;z-index:1;">' + title + '</div>';

    infowindow.setContent(content);
    infowindow.open(map, marker);
}

 // 검색결과 목록의 자식 Element를 제거하는 함수입니다
function removeAllChildNods(el) {   
    while (el.hasChildNodes()) {
        el.removeChild (el.lastChild);
    }
}
  </script>
  <script>

    
      //영상게시글 수정할때 영상 변경불가
      $(document).ready(function(){
          $("#modal_pic").attr('disabled',true);

      //볼링장 가격
      // 키를 누르거나 떼었을때 이벤트 발생
      $("#price").bind('keyup keydown',function(){

        inputNumberFormat(this);
      });
       
      });

      //입력한 문자열 전달
      function inputNumberFormat(obj) {
          obj.value = comma(uncomma(obj.value));
      }
        
      //콤마찍기
      function comma(str) {
          str = String(str);
          return str.replace(/(\d)(?=(?:\d{3})+(?!\d)){2,9}/g, '$1,');
      }

      //콤마풀기
      function uncomma(str) {
          str = String(str);
          return str.replace(/[^\d]+/g, '');
      }

      //숫자만 리턴(저장할때)
      //alert(cf_getNumberOnly('1,2./3g')); -> 123 return
      function cf_getNumberOnly (str) {
          var len      = str.length;
          var sReturn  = "";

          for (var i=0; i<len; i++){
              if ( (str.charAt(i) >= "0") && (str.charAt(i) <= "9") ){
                  sReturn += str.charAt(i);
              }
          }
          return sReturn;
      }

     
    // if($("#key").val()=='v_post_update'){

    //     $("#search_box").attr('disabled',true);
    //     $("#search_box").attr('placeholder','유튜브영상은 수정할 수 없습니다');
    //     $("#newpage").attr('disabled',true);
    //   }


      //다이얼로그 창에서 라디오체크시 선택버튼 활성화 
      function clickable(){
        $("#modal_pic").attr('disabled',false);
          }

      //다이얼로그 창에서 다음/이전 선택시 선택버튼 비활성화 
      function unclick(){
        $("#modal_pic").attr('disabled',true);
      }
      

      //취소 버튼
      $("#upload-cancel-btn").click(function(e){
      e.preventDefault();
      history.back();
      });

  </script>

<script>
//볼링장 찾기
$("#newpage").click(function(e){
   e.preventDefault();
   var keyword = document.getElementById('search_box').value;

//키워드 검사 
if (!keyword.replace(/^\s+|\s+$/g, '')) {
   alert('키워드를 입력해주세요!');
   return false;
}
   $('#keyword').val(keyword);
   $("#myModal").show();

   // 모달창띄우고 안해주면 지도가 나오지 않음

   map.relayout();
   //키워드 받은 값으로 장소 검색
   searchPlaces();  
   
});


     
     
   

  //볼링장 추천 등록 버튼
    function submitContents(el){

      // 볼리장 선택 / 가격 입력 / 나의 평가 / 총점 선택 확인  
      var name = $("#name").text();
      var address = $("#address").text();
      var tel = $("#tel").text();
      var price = $("#price").val();
      var star = $("#star").val();
      var smarteditor = $("#smarteditor").val();
      var line = $('input[name="line"]:checked').val();
      var line_condition = $("input[name='line_quality']:checked").val();
     
      if(name == ""){
         alert("볼링장을 선택해주세요");  
         return false;
      }else if(price ==""){
        alert("가격을 입력해주세요")
        return false;
      }else if(star == ""){
         alert("평점을 선택해주세요");  
         return false;
      }else if(smarteditor == ""){
         alert("나의 평가를 입력해주세요");  
         return false;
      }
      $("#title").val(name);
      $("#addressValue").val(address);
      $("#telValue").val(tel);
      cf_getNumberOnly($("#price"));
      
  }


    $(document).ready(function(){
    
      //모달창 닫기
      $("#modal-close").click(function(e){
                  $('#myModal').hide();
                  });

      //모달창에서 볼링장 선택버튼
      $("#modal_pic").click(function(e){

         e.preventDefault();
         //모달 창에서 값 받아서 가게명, 주소, 전화번호 값 넣어주기
         $id =  $('input[name="quality"]:checked').val();
        var placesId = $("#placesId"+$id).val();
        var placesx = $("#placesx"+$id).val();
        var placesy = $("#placesy"+$id).val();
        
        var title = $("#name"+$id).text();
        var titleValue = title.split('.');
        var address = $("#address"+$id).text();
        var tel = $("#tel"+$id).text();
        var a = $("#url"+$id).children();
        var url = a.attr('href');
        $("#name").html(titleValue[1]);
        $("#address").text(address);
        $("#tel").text(tel);
        $("#placesId").val(placesId);
        $("#placesx").val(placesx);
        $("#placesy").val(placesy);
        $('#myModal').hide();

        
      });

    
  });
   
     //총평점
     function rate(no){// 누른별 값 만큼 속성 노란색으로 바꾸기
      
        for(var i=0 ; i<no ;i++){
          $("#"+(i+1)+"-star").attr('class','btn btn-outline-warning ');
          $("#"+(i+1)+"-star").children().attr('class','fas fa-star');
        }
      //5-누른별 값 만큼 속성 회색으로 바꾸기
      var unstar = (5-no);
      for(var i=0 ; i<unstar ;i++){
          $("#"+(5-i)+"-star").attr('class','btn btn-outline-secondary ');
          $("#"+(5-i)+"-star").children().attr('class','far fa-star');
        }
        //누른값 입력
        $("#star").val(no);
      }
</script>

</body>
<script type="text/javascript">

    </script>
</html>
