<?php
    session_start();
    include('../dbconn.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = ('SELECT * FROM admin');
    $stmt = $pdo->prepare($query);
    $stmt -> execute();

    $value = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($value as $item){
       if($email == $item['email'] && $password == $item['password']){
        $_SESSION['id'] = $item['id'];
        header("location: adminhome.php");
       }
       else{
           $value = "Invalid cred!!";
           header("location: adminlogin.php?value=$value");
       }
    }

?>