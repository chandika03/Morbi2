<?php
include('dbconn.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$loggeduserid = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $query = "UPDATE users SET latitude = :latitude, longitude = :longitude WHERE user_id = :userid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userid', $loggeduserid);
    $stmt->bindParam(':latitude', $latitude);
    $stmt->bindParam(':longitude', $longitude);
    $stmt->execute();

    echo "Location updated successfully!";
}
?>
