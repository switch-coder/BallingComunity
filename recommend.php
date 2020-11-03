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

  <!-- 아이콘 -->
  <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
  <!-- Custom styles for this template -->
  <link href="bootstrap/css/shop-homepage.css" rel="stylesheet">

</head>
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
  
   #pagination {margin:10px auto;text-align: center;}
#pagination a {display:inline-block;margin-right:10px;}
#pagination .on {font-weight: bold; cursor: default;color:#777;}
#page_num {
	font-size: 14px;
  margin:auto;

  
}
#page_num ul li {
	float: left;
	margin-left: 10px; 
	text-align: center;
  list-style:none;
  
}
#page_num ul li a {
  color:black;
}
.fo_re {
	font-weight: bold;
	color:blue;
}

</style>
<body>

<?php 
if(isset($_GET['page'])){
  if( $_GET['page'] <1){
    $page = 1;
  }else{
    $page = $_GET['page'];
  }

}else{
 $page = 1;
}
$thisPage = 'recom';
include 'navigationbar.php';
include 'mysqldb.php';
$sql = $db->query("select * from totalstore");
$row_num = mysqli_num_rows($sql);//총 게시글수

$list = 5;      // 현재페이지에 보여질 게시글 수
$block_ct = 5;  // 블록당 보여줄 페이지 게수

$block_num = ceil($page/$block_ct); //현재 몇페이지 인지 구하기
$block_start = (($block_num -1 ) * $block_ct+1); //블럭 시작번호
$block_end = $block_start + $block_ct -1; //블럭 마지막 번호
$total_page = ceil($row_num /$list); //페이징할 페이지 수 구하기
if($block_end > $total_page) $block_end = $total_page; // 만약 블록의 마지막 번호가 페이수보다 많다면 마지막번호는 페이지수
if($page > $total_page){
  echo "<script>alert('잘못된 접근입니다.'); location.href='?page=1';</script>";
}
$start_num = ($page-1) * $list;
$cummunity = "select * from totalstore order by count DESC limit $start_num, $list";           
$result = $db->query($cummunity);


?>


  <!-- Page Content -->
  <div class="container" style="max-width:1400px;width:100%;padding-top:80px;margin-bottom:135px">

    <div class="row">

      <div class="col-lg-3" style="min-width:100px;max-width:230px;">

        <h1 class="my-4" style="margin-bottom:2px;">볼링장</h1>
        <h1 class="my-4">추천</h1>
        <?php if(isset($_SESSION['user_num'])){?>
        <div class="list-group " style="margin-top:20px;">
          <a href="./recommendstore.php" class="list-group-item bg-dark text-center text-white">볼링장 추천해보기</a>
        </div>
        <?php } ?>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-10"  style="max-width:1200px;">

          
      <div>
        <hr style="background-color:#c8c8c8"/>
      <p style="font-size:20px;font-weight:800"> 볼링장을 추천하고 회원들이 추천한 볼링장을 볼 수 있습니다. </p>
      <hr style="background-color:#c8c8c8"/>  
    </div>
            <div class="map_wrap">
                <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>

                <!-- <div id="menu_wrap" class="bg_white">
                    <div class="option">
                        <div>
                            
                                <span>키워드 : <input type="text" value="" id="keyword" size="12">  </span>
                                <span><button type="button" onclick="searchPlaces();">검색하기</button>  </span>
                            
                        </div>
                      </div>
                          <hr>
                          <p style="paddin:0px 0px 0px 0px" id="placesList"></p>
                          <div id="pagination"></div>
                      </div> -->
                </div>
        
                <div class="card card-outline-secondary my-4" style="min-height:300px;">
        
      
                  <table id="report-table" class="table table-hover">
                     <thead>
                     <tr>
                        <th style="">번호</th>
                        <th style="">가게이름</th>
                        <th style="">지역</th>
                        <th style="">평점</th>
                        <th style="width:150px;">레일 수</th>
                        <th style="width:100px;">레일 상태</th>
                        <th style="width:1px;"> </th>
                        <th style="width:1px;"> </th>                        
                     </tr>
                     </thead>
                  
                     
                     <tbody id="placesList">
                     <?php  
                     $i= 0;
                     while($rows=mysqli_fetch_assoc($result)){if($total%2==0){}else{}
                     
                     $post_no =$rows['post_no'];

                     ?>
                     
                     <tr class="<?php echo $i ?>" style="cursor:pointer;">
                        <td><?php echo $i+1 ?></td>
                        <td class="name" id='name'><?php echo $rows['name'] ?></td>
                        <td><?php echo $rows['address'] ?></td>
                        <td><?php  $grade = ($rows['grade']/$rows['count']); echo round($grade);?></td>
                        <td style="display:none"><?php echo $rows['count'] ?></td>
                        <td><?php if($rows['line'] =='3'){ echo '20이상';}else if($rows['line'] =='2'){echo '12~20';}else{echo '12이하';} ?></td>
                        <td  style=text-align:center>
                          <?php  $condition=$rows['line_condition']; if($condition >='2.5'){ echo '좋음';}else if($condition >='1.5'){echo '보통';}else{echo '나쁨';} ?></td>
                        <td class="x" id='x' style=font-size:0px><?php echo $rows['place_x'] ?></td>
                        <td class='y' style=font-size:0px><?php echo $rows['place_y'] ?></td>
                        <input type="hidden" id="no" value="<?php echo $rows['no'] ?>">  
                        <input type="hidden" id="x" value="<?php echo $rows['place_x'] ?>">    
                        <input type="hidden" id="y" value="<?php echo $rows['place_x'] ?>">                
            
                        </tr>
                     <?php $i++;} ?>
                     </tbody>
                     </tr>
                  </table>
        <input type="hidden" id="ro_no" value="<?php echo $i?>">
      
        <div id="page_num">
            <ul>
            <?php 
            //처음으로가기 버튼
            if($page <=1){
              echo "<li class='fo_re'>처음</li>";//처음이라는 글자에 빨간색 표시
            }else{
              echo "<li><a href='?page=1'>처음</a></li>";//아니면 1페이지로 갈수 있게 링크
            }

            //이전 버튼
            if($page <= 1){// 페이지 1이거나 작다면 빈값 아무것도 안보임

            }else{
              $pre = $page-1;//이전페이지 갈 수있게 페이지 수 맞추기
              echo "<li><a href='?page=$pre'>이전</a></li>";// 이전글자 만들고 링크에 전페이지 넘버 넣기
            }

            //블럭 글자 만들기 ex> 1 2 3 4 5 
            for($i = $block_start; $i<=$block_end; $i++){
              if($page ==$i){
                echo "<li class='fo_re'>[$i]</li>";//현재 페이지에 해당하는 번호에 굵은 글씨
              }else{
                echo "<li><a href='?page=$i'>[$i]</a></li>"; //아닌글에 링크와 그냥 보통 글씨
              }
            }

            //다음 버튼 만들기
            if($page >= $total_page){//현재 페이지가 블럭 마지막 수와 같거나 크면 빈값
            }else{
              $next = $page +1;
              echo "<li><a href='?page=$next'>다음</a></li>";
            }

            //마지막으로 가기 버튼
            if($page >= $total_page){
              echo "<li class='fo_re'>마지막</li>";//현재페이지가 마지막일 경우
            }else{
              echo "<li><a href='?page=$total_page'>마지막</a></li>";// 현재페이지가 마지막이 아닐 경우
            }
            ?>
         </div>
      </div>
       

         <!-- /card -->
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=db6aed39e36d5db0ad08bfbcde30d1d0&libraries=services"></script>
   <script>
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

//검색 결과 목록이나 마커를 클릭했을 때 장소명을 표출할 인포윈도우를 생성합니다
var infowindow = new kakao.maps.InfoWindow({zIndex:1});
var index = $("#ro_no").val();

var positions = [];
mark(index);


function mark(index){

    var bounds = new kakao.maps.LatLngBounds();
  
    for(var i=0; i<index;i++){
    var tr = $("#report-table tbody tr."+i);
    var x = tr.children('.x').text();
    var y = tr.children('.y').text();
    var name = tr.children('.name').text();
    
    var placePosition = new kakao.maps.LatLng(y, x),
        marker = addMarker(placePosition, i);
         
        
        bounds.extend(placePosition);
        
        (function(marker, name) {
                kakao.maps.event.addListener(marker, 'mouseover', function() {
                    displayInfowindow(marker, name);
                });

                kakao.maps.event.addListener(marker, 'mouseout', function() {
                    infowindow.close();
                });

            })(marker,name);

            
            map.setBounds(bounds);
            
          
        }
       
    }
 
 


    function addMarker(position, idx,name) {
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
// 검색결과 목록 또는 마커를 클릭했을 때 호출되는 함수입니다
// 인포윈도우에 장소명을 표시합니다
function displayInfowindow(marker, title) {
    var content = '<div style="padding:5px;z-index:1;">' + title + '</div>';

    infowindow.setContent(content);
    infowindow.open(map, marker);
}
   </script>
</body>


</html>
