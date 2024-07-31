<?php
// Include necessary files and establish database connection

session_start();
include('../dbconn.php');

$fromUser = $_GET['fromUser'];
$toUser = $_GET['toUser'];

$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'];

$stmt = $pdo->prepare("INSERT INTO message (fromUser, toUser, message) VALUES (:fromUser, :toUser, :message)");
$stmt->bindParam(':fromUser', $fromUser);
$stmt->bindParam(':toUser', $toUser);
$stmt->bindParam(':message', $message);
$stmt->execute();
?>
