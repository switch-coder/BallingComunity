<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>MySql-PHP TEST</title>
</head>
<body>
<?php
echo "MySql TEST<br>";
$db = mysqli_connect("localhost", "root", "sql", "testdb");
if($db){
        echo "connect : success<br>";
        $query = "select * from test";
        $result =  $db ->query($query);
        while($rows = mysqli_fetch_assoc($result)){
                echo $rows['name'];
                echo $rows['age'];
        }
}else{
    echo "disconnect : fail<br>".mysqli_connect_error();}
?>
</body>
</html>


