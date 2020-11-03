<?php 



try{
   include 'mysqldb.php';

   $query_post = "select * from user"; //글번호 받아와서 종합추천 테이블에서 글찾기
   $result = $db->query($query_post);


        

   $resultStart = '{"items":'; // 데이터의 기본값을 items로 설정.

      $resultData = '';            // mysql로 넘겨 받는 문자열 변수

      $resultEnd = '}';         // 마무리 문자열 변수



     // 결과 값이 여러 개 일 경우 대괄호 추가!

      if(mysql_num_rows ( $result ) > 1)

      {

         $resultStart .= '[ ';

         $resultEnd = ' ]}';

      }

 while($rows = mysql_fetch_assoc($result)) {

    $resultData .= '{ ';

    foreach($rows as $key => $value)

             {	$resultData .= '"'.$key.'":"'.$value.'",'; }

               // 컬럼 값 마지막 부분에 콤마 제거

             $resultData = substr($resultData,0, -1);

        $resultData .= '},';

     }

      // 데이터 값 마지막 부분에 콤마 제거

 $resultData = substr($resultData,0, -1);

      mysql_close($connection);

      

      echo $resultStart.$resultData.$resultEnd;  // 결과값 전달



}

catch(Exception $e)

{

    echo $e->getMessage();

    // Note: Log the error or something

}



?>