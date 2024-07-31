<?php
    session_start();
    include('dbconn.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = ('SELECT user_id, user_email, user_password FROM users');
    $stmt = $pdo->prepare($query);
    $stmt -> execute();

    $value = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $org_username = $value[0]['username'];
    // $org_password = $value[0]['password'];
    foreach($value as $item){
        if($email == $item['user_email'] && password_verify($password, $item['user_password'])){
            $_SESSION['user'] = $item['user_id'];
            // echo $_SESSION['user']; //checked to see if session is set or not
            header("Location: /morbi/users.php");
        }
    }
    if(empty($_SESSION['user'])){//user not found
        $invalid = "Invalid credentials!";
        header("Location: /morbi/morbi.php?invalid= $invalid");
    }
?>