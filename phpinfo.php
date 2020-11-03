<script src="bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
$.ajax({

type: "GET",

url: "http://localhost/getpost.php",

async: false,

beforeSend: function(x) {

},

success: function(data){

if(data){

// 데이터를 JSON으로 파싱

  var json = JSON.parse(data);

                // 여러개 일 경우

  if(json.length > 1){

     alert(json.items[0].nickname);

// 하나 일 경우

  }else{

     alert(json.items.title);

  }

}

}

});


</script>

