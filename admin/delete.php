<?php
include '../dbconn.php';

$user_id = $_GET['id'];

// Delete dependent rows in the `message` table
$query = "DELETE FROM message WHERE toUser = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();

$query = "DELETE FROM message WHERE fromUser = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();

// Delete the user from the `users` table
$query = "DELETE FROM users WHERE user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();

header("Location: admin.php");
?>