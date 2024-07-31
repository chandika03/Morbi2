<?php
    // // connecting to database
    //     include('../dbconn.php');
    // // getting user message through ajax
    // $getMesg = mysqli_real_escape_string($conn, $_POST['text']);
    // //checking user query to database query
    // $check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
    // $run_query = mysqli_query($conn, $check_data) or die("Error");
    // // if user query matched to database query we'll show the reply otherwise it go to else statement
    // if(mysqli_num_rows($run_query) > 0){
    //     //fetching replay from the database according to the user query
    //     $fetch_data = mysqli_fetch_assoc($run_query);
    //     //storing replay to a varible which we'll send to ajax
    //     $replay = $fetch_data['replies'];
    //     echo $replay;
    // }else{
    //     echo "Sorry can't be able to understand you!";
    // }
?>

<?php 
    session_start();
    echo $_SESSION['user'];

    if(!isset($_SESSION['user'])){
        header("Location: /login.php");
        exit();
    }
    include('../dbconn.php');
    $toUser = $_GET['toId'];
    $message = $_POST['data'];
    $stmt = $pdo->prepare("UPDATE message SET message=:msg WHERE fromUser=:fromuser AND toUser=:touser");
    $stmt->bindParam(':fromuser', $_SESSION['user']);
    $stmt->bindParam(':touser', $toUser);
    $stmt->bindParam(':msg', $message);
    $stmt->execute();
    header("Location: /morbi/chat/chatmodule.php?toId=$toUser");
?>