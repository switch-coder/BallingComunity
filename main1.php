<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>지도에 사용자 컨트롤 올리기</title>

    <!-- Bootstrap core CSS -->
  <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="bootstrap/css/shop-homepage.css" rel="stylesheet">
    <style>
html, body {width:100%;height:100%;margin:0;padding:0;} 
.map_wrap {position:relative;overflow:hidden;width:100%;height:350px;}
.radius_border{border:1px solid #919191;border-radius:5px;}     



.custom_typecontrol #kakao_btn:hover {display:block;display:inline-block;width:65px;height:30px;float:left;text-align:center;line-height:30px;cursor:pointer;background:#f5f5f5;background:linear-gradient(#f5f5f5,#e3e3e3);}
.custom_typecontrol #kakao_btn:active {background:#e6e6e6;background:linear-gradient(#e6e6e6, #fff);}    
.custom_typecontrol #selected_kakao_btn {color:#fff;background:#425470;background:linear-gradient(#425470, #5b6d8a);}
.custom_typecontrol .selected_kakao_btn:hover {color:#fff;}   

.custom_zoomcontrol .kakao_span #kakao_img {width:5px;!important;height:5px;!important;padding:12px 0;border:none;}             
.custom_zoomcontrol .kakao_span:first-child{border-bottom:1px solid #bfbfbf;}            
</style>
</head>
<body>
<div class="map_wrap">
    <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div> 
    <!-- 지도타입 컨트롤 div 입니다 -->
    <div class="custom_typecontrol radius_border" style="position:absolute;top:10px;right:10px;overflow:hidden;width:130px;height:30px;margin:0;padding:0;z-index:1;font-size:12px;font-family:'Malgun Gothic', '맑은 고딕', sans-serif;">
        <span id="btnRoadmap" class="selected_kakao_btn" onclick="setMapType('roadmap')">지도</span>
        <span id="btnSkyview"style="display:block;width:65px;height:30px;float:left;text-align:center;line-height:30px;cursor:pointer; background:#fff;background:linear-gradient(#fff,  #e6e6e6);" class="kakao_btn" onclick="setMapType('skyview')">스카이뷰</span>
    </div>
    <!-- 지도 확대, 축소 컨트롤 div 입니다 -->
    <div class="custom_zoomcontrol radius_border" style="position:absolute;top:50px;right:10px;width:36px;height:80px;overflow:hidden;z-index:1;background-color:#f5f5f5;"> 
        <span class="kakao_span" style="display:block;width:36px;height:40px;text-align:center;cursor:pointer;padding-top:5px;padding-right:3px;" onclick="zoomIn()"><img  class="kakao_img" src="http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/ico_plus.png" alt="확대"></span>  
        <span class="kakao_span" style="display:block;width:36px;height:40px;text-align:center;cursor:pointer;padding-top:5px;padding-right:3px;" onclick="zoomOut()"><img class="kakao_img" src="http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/ico_minus.png" alt="축소"></span>
    </div>
</div>
<script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=db6aed39e36d5db0ad08bfbcde30d1d0&libraries=services"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };  

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
    
// 지도타입 컨트롤의 지도 또는 스카이뷰 버튼을 클릭하면 호출되어 지도타입을 바꾸는 함수입니다
function setMapType(maptype) { 
    var roadmapControl = document.getElementById('btnRoadmap');
    var skyviewControl = document.getElementById('btnSkyview'); 
    if (maptype === 'roadmap') {
        map.setMapTypeId(kakao.maps.MapTypeId.ROADMAP);    
        roadmapControl.className = 'selected_kakao_btn';
        skyviewControl.className = 'kakao_btn';
    } else {
        map.setMapTypeId(kakao.maps.MapTypeId.HYBRID);    
        skyviewControl.className = 'selected_kakao_btn';
        roadmapControl.className = 'kakao_btn';
    }
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