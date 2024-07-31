<?php
// Include the necessary files and establish a database connection
session_start();
include('../dbconn.php');

// $toUser = $_GET['toId'];
// $fromUser = $_SESSION['user'];

// // Retrieve chat messages from the database
// $stmt = $pdo->prepare("SELECT * FROM message WHERE (fromUser = :fromUser AND toUser = :toUser) OR (fromUser = :toUser AND toUser = :fromUser) ORDER BY timestamp ASC");
// $stmt->bindParam(':fromUser', $fromUser);
// $stmt->bindParam(':toUser', $toUser);
// $stmt->execute();
// $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // Prepare the chat messages HTML
// $html = '';
// foreach ($messages as $message) {
//     $sender = $message['fromUser'] == $fromUser ? 'sent' : 'received';
//     $html .= '<div class="message ' . $sender . '">' . $message['message'] . '</div>';
// }

// // Return the chat messages HTML
// echo $html;
// Include necessary files and establish database connection

$fromUser = $_GET['fromUser'];
$toUser = $_GET['toUser'];

$stmt = $pdo->prepare("SELECT * FROM message WHERE (fromUser = :fromUser AND toUser = :toUser) OR (fromUser = :toUser AND toUser = :fromUser) ORDER BY timestamp ASC");
$stmt->bindParam(':fromUser', $fromUser);
$stmt->bindParam(':toUser', $toUser);
$stmt->execute();

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($messages as $message) {
  echo '<div class="message">' . htmlspecialchars($message['message']) . '</div>';
}

?>