<?php
    include("../dbconn.php");

    $id = $_GET['id'];

   
    $query = "DELETE FROM users WHERE user_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    header("Location: adminusers.php");

?>