<?php


$db = mysqli_connect("localhost", "root", "sql", "testdb");

if(!$db){
    die('mysql connect error : '.mysqli_connect_error());
}

?>