<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /morbi/users.php");
    exit();
}

try {
    include('../dbconn.php');
    
    // Process the report request
    if (isset($_POST['userId']) && isset($_POST['reason'])) {
        $userId = $_POST['userId'];
        $reason = $_POST['reason'];
        $reportedby = $_SESSION['user'];

        // Store the reported user and report type in the database
        $sql = "INSERT INTO report (userid, reason, byuser) VALUES (:userId, :reason, :byuser)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':byuser', $reportedby);
        $stmt->execute();

        echo "User reported successfully";
        header("Location: ../users.php");

    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>



