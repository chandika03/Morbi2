<?php
    include('dbconn.php');
    session_start();
    // $gender = $_POST['gender'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    // $age = $_POST['age'];
    $cpassword = $_POST["cpassword"];
    $converted_password = password_hash($password, PASSWORD_DEFAULT);
    if($password == $cpassword){
        //put user's data into table
        $query = ('INSERT INTO users(user_password, user_name, user_email) VALUES (:password, :name, :email)');
        $stmt = $pdo->prepare($query);
        // $stmt -> bindParam(':gender',$gender);
        $stmt -> bindParam(':password',$converted_password);
        $stmt -> bindParam(':name',$name);
        $stmt -> bindParam(':email',$email);
        // $stmt -> bindParam(':age',$age);
        $stmt -> execute();

        //get user id for session setting
        $stmt2= $pdo->prepare("SELECT * FROM users WHERE user_email=:em");
        $stmt2 -> bindParam(':em',$email);
        $stmt2->execute();
        $user = $stmt2->fetchAll();
        foreach($user as $user_info){
            $_SESSION['user']= $user_info['user_id'];
            echo $_SESSION['user'];
            header("Location: /morbi/users.php");
        }
    }
    else{
        $invalid = "Password didn't Match";
        header("Location: /morbi/morbi.php?invalid= $invalid");
    }   
?>