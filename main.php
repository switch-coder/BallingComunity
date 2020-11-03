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
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>

  <!-- Custom styles for this template -->
  <link href="bootstrap/css/shop-homepage.css" rel="stylesheet">
  <link href="kakao.css" rel="stylesheet">
</head>
<style>

    html{
        position: relative;
        height: 100%;
        margin: 0;
        width:100%;
    }
    body {
        height:88%;
        width:100%;
        background: #EAEAEA;
        background: linear-gradient(to right, #EAEAEA, #EAEAEA);
    }
   

/* 
  .card-signin {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
  }

  .card-signin .card-title {
    margin-bottom: 2rem;
    font-weight: 300;
    font-size: 1.5rem;
  }

  .card-signin .card-body {
    padding: 2rem;
  }

  .form-signin {
    width: 100%;
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
    margin-bottom: 1rem;
  }

  .form-label-group input {
    height: auto;
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
     Override default `<label>` margin 
    line-height: 1.5;
    color: #495057;
    border: 1px solid transparent;
    border-radius: .25rem;
    transition: all .1s ease-in-out;
  }*/

  /* .form-label-group input::-webkit-input-placeholder {
    color: transparent;
  }

  .form-label-group input:-ms-input-placeholder {
    color: transparent;
  }

  .form-label-group input::-ms-input-placeholder {
    color: transparent;
  }

  .form-label-group input::-moz-placeholder {
    color: transparent;
  }

  .form-label-group input::placeholder {
    color: transparent;
  }

  .form-label-group input:not(:placeholder-shown) {
    padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
    padding-bottom: calc(var(--input-padding-y) / 3);
  }

  .form-label-group input:not(:placeholder-shown)~label {
    padding-top: calc(var(--input-padding-y) / 3);
    padding-bottom: calc(var(--input-padding-y) / 3);
    font-size: 12px;
    color: #777;
  } */ 


  /* 카카오css */
  .map_wrap, .map_wrap * {margin:0;padding:0;font-family:'Malgun Gothic','돋움',sans-serif;font-size:12px;}
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
#placesList .item h5, #placesList .item .info {text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
#placesList .item .info{padding:10px 0 10px 55px;}
#placesList .info .gray {color:#8a8a8a;}
#pagination {margin:10px auto;text-align: center;}
#pagination a {display:inline-block;margin-right:10px;}

#placesList .info .tel {color:#009900;}


</style>

<body>

<?php 
$thisPage = 'home';
include 'navigationbar.php';
include 'mysqldb.php';
$id = $_SESSION['userid'];
$i=0;
$query = "select * from user where userID ='$id'";

$result = $db->query($query);
$row=mysqli_fetch_assoc($result);

$cummunity = "select * from v_community order by view DESC";           
$v_result = $db->query($cummunity);
?>
<!-- <div id="floatMenu">
<button type=button class="btn btn-dark" onclick="window.open('localhost:8000','chat','width=730,height=500,location=no,status=no,scrollbars=yes');" >실시간 채팅하기</button>

</div> -->
<input type="hidden" id="address1" value="<?php echo $row["address1"]; ?>">
<input type="hidden" id="address2" value="<?php echo $row["address2"]; ?>">
<div class="content" >
  
      <div class="col-sm-9 mx-auto">
        <div class="card card-signin my-5" style="">
          <div class="card-body">
          
            <h5 class="card-title text-center">인기 동영상</h5>
            <div class="row">
            <?php  while($rows=mysqli_fetch_assoc($v_result)){if($total%2==0){}else{}
                  
                  if($i ==3){
                  break;
                  }
                  $user_no =$rows['user_no'];
                  $query_user = "select * from user where num ='$user_no'"; 
                  $user_result = $db->query($query_user);
                  $user_rows = mysqli_fetch_assoc($user_result);
            ?>
             
                <div class="col-lg-4 col-md-6 mb-4"style="cursor:pointer;"><input class="post_num" type=hidden name="post_num" value="<?php echo $rows['no'] ?>">
                <div class="card h-100 ">
                  <a><img class="card-img-top" src="<?php echo $rows['youtu_url']?>" >
                  <div class="card-body" style="padding:10px 10px 0px 10px;margin:0px">
                      <h4 class="card-title" style="font-size:18px;margin-bottom:0px;height:40px;overflow:auto;">
                      <?php echo $rows['title']?>
                      </h4>
                      <!-- <img src="<?php echo "./userimg/".$user_rows['userImage'] ?>" width=65px height=65px>
                      <span style="margin-left:10px"><?php echo $user_rows['nickname'] ?></span> -->
                      <span class="card-text" style="float:right;text-align:right;margin-top:10px;" >
                      <i class="fas fa-eye"></i> <?php echo $rows['view']?> / <i class="far fa-thumbs-up"></i> <?php echo $rows['like_']?> / <i class="far fa-thumbs-down"></i> <?php echo $rows['unlike_']?>
                      </span>
                  </div>
                  </a>
                </div>
                </div>
             <?php $i ++;  } ?>
             
            </div>
            <a style="float:right" href="./v_community.php?page=1">영상 더보기<i class='fas fa-chevron-right'></i></a>
          </div><!-- /card-body -->
        </div><!-- /card -->
      </div>
      <!-- /col-sm-9 mx-auto -->
      <div class="col-sm-9 mx-auto">
        <div class="card card-signin my-5" style="">
          <div class="card-body">
          
            <h5 class="card-title text-center">인기 볼링장</h5>
            <div class="row">
            <table id="report-table" class="table table-hover">
                     <thead>
                     <tr>
                        <th style="">번호</th>
                        <th style="">가게이름</th>
                        <th style="">지역</th>
                        <th style="">회원들의 추천수</th>
                        <th style="width:150px;">레일 수</th>
                        <th style="width:100px;">레일 상태</th>
                        <th style="width:1px;"> </th>
                        <th style="width:1px;"> </th>                        
                     </tr>
                     </thead>
                  
                     
                     <tbody >
                     <?php  
                     $cummunity = "select * from totalstore order by count DESC";           
                     $result = $db->query($cummunity);                     
                     $s= 0;
                     while($rows=mysqli_fetch_assoc($result)){if($total%2==0){}else{}
                     if($s ==5){
                    break;
                    }
                     $post_no =$rows['post_no'];

                     ?>
                     
                     <tr class="<?php echo $i ?>" style="cursor:pointer;">
                        <td><?php echo $s+1 ?></td>
                        <td class="name" id='name'><?php echo $rows['name'] ?></td>
                        <td><?php echo $rows['address'] ?></td>
                        <td><?php echo $rows['count'] ?></td>
                        <td><?php if($rows['line'] =='3'){ echo '20이상';}else if($rows['line'] =='2'){echo '12~20';}else{echo '12이하';} ?></td>
                        <td  style=text-align:center>
                          <?php  $condition=$rows['line_condition']; if($condition >='2.5'){ echo '좋음';}else if($condition >='1.5'){echo '보통';}else{echo '나쁨';} ?></td>
                        <td class="x" id='x' style=font-size:0px><?php echo $rows['place_x'] ?></td>
                        <td class='y' style=font-size:0px><?php echo $rows['place_y'] ?></td>
                        <input type="hidden" id="no" value="<?php echo $rows['no'] ?>">  
                        <input type="hidden" id="x" value="<?php echo $rows['place_x'] ?>">    
                        <input type="hidden" id="y" value="<?php echo $rows['place_x'] ?>">                
            
                        </tr>
                     <?php $s++;} ?>
                     </tbody>
                     </tr>
                  </table>
                  
                  
              </div>
              <a style="float:right;" href="./recommend.php?page=1">볼링장 추천 더보기<i class='fas fa-chevron-right'></i></a>
            </div><!-- /card-body -->
        </div><!-- /card -->
      </div>
      <!-- /col-sm-9 mx-auto -->


      <div class="col-sm-9 mx-auto">
        <div class="card card-signin my-5" style="">
          <div class="card-body">
            <h5 class="card-title text-center">볼링장의 위치를 검색해주세요</h5>
              <div class="map_wrap">
                <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>

                <div id="menu_wrap" class="bg_white">
                    <div class="option">
                        <div>
                            <form onsubmit="searchPlaces(); return false;">
                                키워드 : <input type="text" value="강남 볼링장" id="keyword" size="15"> 
                                <button type="submit">검색하기</button> 
                            </form>
                        </div>
                      </div>
                          <hr>
                          <ul id="placesList"></ul>
                          <div id="pagination"></div>
                      </div>
                </div>

            <!-- <div class="map_wrap" style="width:70%;"> -->
                <!-- <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>  -->
                <!-- 지도타입 컨트롤 div 입니다 -->
                
                <!-- <div class="custom_typecontrol radius_border">
                    <p id="btnSkyview" class="kakao_btn" onclick="setMapType('myhome')">집주변</p>
                    <p id="btnRoadmap" class="selected_btn" onclick="setMapType('mylocation')">현재위치</p>
                </div> -->
               
                <!-- 지도 확대, 축소 컨트롤 div 입니다 -->
                <!-- <div class="custom_zoomcontrol radius_border"> 
                    <span onclick="zoomIn()"><img class="kakao_img" style="width:15px;height:15px;"src="http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/ico_plus.png" alt="확대"></span>  
                    <span onclick="zoomOut()"><img class="kakao_img" style="width:15px;height:15px;" src="http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/ico_minus.png" alt="축소"></span>
                </div>
                <div class="custom_typecontrol radius_border" style="float:left">
                  <span type="button" id="btnmyhome" class="selected_btn" onclick="setlocation('myhome')" >집주변</span>
                  <span type="button" id="btnmylocation" class="kakao_btn" onclick="setlocation('mylocation')" >현재위치</span>
                </div>
            </div> -->
              <!-- <div  style="width:320px;float:left;padding:0px  ">
                <div class="form-group form-inline" style="width:300px;margin:auto">
                  <input type=text id="search_box" class="form-control" style="width:250px" placeholder="검색어를 입력해주세요" >
                  <button type="button" class="btn btn-dark " style="margin:0px;" onclick="searchPlaces();"><i class="fas fa-search"></i></button>
                </div>
                <div style="height:360px;overflow:auto;overflow-x:hidden;">

                </div>
              </div> -->
            
          </div>
        </div>
      </div>
      <!-- /col-sm-9 mx-auto -->
    </div> <!-- /content -->

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
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=db6aed39e36d5db0ad08bfbcde30d1d0&libraries=services"></script>
 
 <script>
   $(document).ready(function() {

// 기존 css에서 플로팅 배너 위치(top)값을 가져와 저장한다.
var floatPosition = parseInt($("#floatMenu").css('top'));
// 250px 이런식으로 가져오므로 여기서 숫자만 가져온다. parseInt( 값 );

$(window).scroll(function() {
  // 현재 스크롤 위치를 가져온다.
  var scrollTop = $(window).scrollTop();
  var newPosition = scrollTop + floatPosition + "px";

  /* 애니메이션 없이 바로 따라감
   $("#floatMenu").css('top', newPosition);
   */

  $("#floatMenu").stop().animate({
    "top" : newPosition
  }, 500);

}).scroll();

});
    //테이블 로우 클릭시
$("#report-table tbody tr").click(function(){

// 현재 클릭된 (<div>)에서 input에 있는 포스트넘버 가져오기
var tr = $(this);
var td = tr.children('#no');
var no = td.val();
location.href='./recommend_detail.php?num_='+no;

});
 </script>
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
var infowindow = new kakao.maps.InfoWindow({zIndex:1});

// 키워드로 장소를 검색합니다
searchPlaces();

// 키워드 검색을 요청하는 함수입니다
function searchPlaces() {

    var keyword = document.getElementById('keyword').value;

    if (!keyword.replace(/^\s+|\s+$/g, '')) {
        alert('키워드를 입력해주세요!');
        return false;
    }

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
    itemStr = '<span class="markerbg marker_' + (index+1) + '"></span>' +
                '<div class="info">' +
                '   <h5>' + (index+1)+'. ' + places.place_name + '</h5>';

    if (places.road_address_name) {
        itemStr += '    <span>' + places.road_address_name + '</span>' +
                    '   <span class="jibun gray">' +  places.address_name  + '</span>';
    } else {
        itemStr += '    <span>' +  places.address_name  + '</span>'; 
    }
                 
      itemStr += '  <span class="tel">' + places.phone  + '</span>' +
                '</div>';           

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

$("#post-card div").click(function(){

// 현재 클릭된 (<div>)에서 input에 있는 포스트넘버 가져오기
var tr = $(this);
var td = tr.children('.post_num');
var no = td.val();
location.href="v_community_detail.php?num_="+no;			

});

var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 5 // 지도의 확대 레벨 
    }; 

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

//장소검색 객체 생성
var ps = new kakao.maps.services.Places();  


      var address1 ="서울특별시";
      var address2 ="서초구";
      if(document.getElementById('address2').value != ""){
      address2 = document.getElementById('address2').value;
      address1 = document.getElementById('address1').value;
      }
    // 	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    //     mapOption = {
    //         center: new kakao.maps.LatLng(37.541, 126.986), // 지도의 중심좌표
    //         level: 3 // 지도의 확대 레벨
    //     };  

    // // 지도를 생성합니다    
    // var map = new kakao.maps.Map(mapContainer, mapOption); 

    // 주소-좌표 변환 객체를 생성합니다
    var geocoder = new kakao.maps.services.Geocoder();

    // 주소로 좌표를 검색합니다
    geocoder.addressSearch(address1+' '+address2, function(result, status) {

        // 정상적으로 검색이 완료됐으면 
        if (status === kakao.maps.services.Status.OK) {

            var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

            // // 결과값으로 받은 위치를 마커로 표시합니다
            // var marker = new kakao.maps.Marker({
            //     map: map,
            //     position: coords
            // });

            // // 인포윈도우로 장소에 대한 설명을 표시합니다
            // var infowindow = new kakao.maps.InfoWindow({
            //     content: '<div style="width:150px;text-align:center;padding:6px 0;">우리회사</div>'
            // });
            // infowindow.open(map, marker);

            // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
            map.setCenter(coords);
        } 
    });    


function setlocation(loctype){
  var btnmyhome = document.getElementById('btnmyhome');
  var btnmylocation = document.getElementById('btnmylocation'); 
// HTML5의 geolocation으로 사용할 수 있는지 확인합니다 
  if(loctype ==='mylocation'){
    if (navigator.geolocation) {
        
        // GeoLocation을 이용해서 접속 위치를 얻어옵니다
        navigator.geolocation.getCurrentPosition(function(position) {
            
            var lat = position.coords.latitude, // 위도
                lon = position.coords.longitude; // 경도
            
            var locPosition = new kakao.maps.LatLng(lat, lon), // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다
                message = '<div style="padding:5px;">여기에 계신가요?!</div>'; // 인포윈도우에 표시될 내용입니다
                btnmyhome.className = 'kakao_btn';
                btnmylocation.className = 'selected_btn';

            // 마커와 인포윈도우를 표시합니다
            displayMarker(locPosition, message);
                
          });
        
    } else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다
        
        var locPosition = new kakao.maps.LatLng(33.450701, 126.570667),    
            message = 'geolocation을 사용할수 없어요..'
            btnmyhome.className = 'kakao_btn';
            btnmylocation.className = 'selected_btn';
        displayMarker(locPosition, message);
    }
  }else if(loctype ==='myhome'){
        var address1 ="서울특별시";
        var address2 ="서초구";
        if(document.getElementById('address2').value != ""){
        address2 = document.getElementById('address2').value;
        address1 = document.getElementById('address1').value;}
      // 	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
      //     mapOption = {
      //         center: new kakao.maps.LatLng(37.541, 126.986), // 지도의 중심좌표
      //         level: 3 // 지도의 확대 레벨
      //     };  

      // // 지도를 생성합니다    
      // var map = new kakao.maps.Map(mapContainer, mapOption); 

      // 주소-좌표 변환 객체를 생성합니다
      var geocoder = new kakao.maps.services.Geocoder();

      // 주소로 좌표를 검색합니다
      geocoder.addressSearch(address1+' '+address2, function(result, status) {

          // 정상적으로 검색이 완료됐으면 
          if (status === kakao.maps.services.Status.OK) {

              var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

              // // 결과값으로 받은 위치를 마커로 표시합니다
              // var marker = new kakao.maps.Marker({
              //     map: map,
              //     position: coords
              // });

              // // 인포윈도우로 장소에 대한 설명을 표시합니다
              // var infowindow = new kakao.maps.InfoWindow({
              //     content: '<div style="width:150px;text-align:center;padding:6px 0;">우리회사</div>'
              // });
              // infowindow.open(map, marker);

              // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
              btnmyhome.className = 'selected_btn';
              btnmylocation.className = 'kakao_btn';
              map.setCenter(coords);
          } 
         
      }); 
    }
  }

//   skyviewControl.className = 'selected_btn';
//   roadmapControl.className = 'btn1';


// 지도에 마커와 인포윈도우를 표시하는 함수입니다
function displayMarker(locPosition, message) {
    
    // 지도 중심좌표를 접속위치로 변경합니다
    map.setCenter(locPosition);      
}    


// 지도 확대, 축소 컨트롤에서 확대 버튼을 누르면 호출되어 지도를 확대하는 함수입니다
function zoomIn() {
    map.setLevel(map.getLevel() - 1);
}

// 지도 확대, 축소 컨트롤에서 축소 버튼을 누르면 호출되어 지도를 확대하는 함수입니다
function zoomOut() {
    map.setLevel(map.getLevel() + 1);
}
	</script>
</body>

</html>




