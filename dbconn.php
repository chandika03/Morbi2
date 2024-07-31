<?php
    $host="localhost";
    $user="root";
    $pass="";
    $db="morbidb";
    $dsn="mysql:host=$host;dbname=$db;";
    $pdo=new PDO($dsn,$user,$pass);
    
    // if($pdo){
    //     echo "hello";
    //     // die(('Connection Failed.'.mysqli_connect_error()));
    // }
    $conn = mysqli_connect($host,$user, $pass, $db);
    if(!$conn){
        die("Connection Failed".mysqli_connect_error());
    }
?>
