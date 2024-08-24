<?php
include('dbconn.php');
include('utils/time.php');
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: /morbi/morbi.php");
  exit();
}

$user_id = $_SESSION['user'];

// $query = "SELECT * FROM message WHERE fromuser = :userid";
//   $query = "SELECT m.message, m.toUser, m.timestamp, u_from.user_image AS from_user_image, u_to.user_image AS to_user_image
//           FROM message m
//           JOIN users u_from ON m.fromUser = u_from.user_id
//           JOIN users u_to ON m.toUser = u_to.user_id
//           WHERE u_from.user_id = :userid OR u_to.user_id = :userid";

// $stmt = $pdo->prepare($query);
// $stmt->bindParam(':userid', $user_id);
// $stmt->execute();
// $value = $stmt->fetchAll(PDO::FETCH_ASSOC);


// $query = "SELECT m.message,m.toUser,u_to.user_name AS receiver_name, u_to.user_image AS receiver_image, m.timestamp FROM message m JOIN users u_to ON m.toUser = u_to.user_id";
$query = "SELECT m.message, m.toUser, m.fromUser, u_to.user_name AS receiver_name, u_to.user_image AS receiver_image, m.timestamp, u_from.user_name AS sender_name, u_from.user_image AS sender_image
  FROM (
      SELECT toUser, MAX(timestamp) AS latest_timestamp
      FROM message
      GROUP BY toUser
  ) latest_msg
  JOIN message m ON latest_msg.toUser = m.toUser AND latest_msg.latest_timestamp = m.timestamp
  JOIN users u_to ON m.toUser = u_to.user_id
  JOIN users u_from ON m.fromUser = u_from.user_id
   WHERE m.toUser = :user_to_id OR m.fromUser = :user_from_id;)";

$statement = $pdo->prepare($query);
$statement->bindParam(":user_to_id", $user_id);
$statement->bindParam(":user_from_id", $user_id);

$statement->execute();
$messages = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat History</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ffeaea;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .main-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      max-width: 850px;
      width: 100%;
      margin-top: auto;
      margin-bottom: auto;
    }

    .chat-container {
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 100%;
    }

    .chat-heading {
      font-size: 32px;
      color: #9a208c;
      margin-bottom: 20px;
    }

    .chat-table {
      border-collapse: collapse;
      width: 90%;
      background-color: #fff;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
      transition: background-color 0.2s ease;
    }

    .chat-table th,
    .chat-table td {
      padding: 10px 20px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .chat-table th {
      background-color: #9a208c;
      color: white;
    }

    .user-avatar {
      width: 85px;
      height: 85px;
      border-radius: 50%;
      overflow: hidden;
    }

    /* .user-avatar::before {
      content: attr(data-avatar);
    }

    .user-avatar::before {
      margin-right: 10px;
      background-color: #9a208c;
      color: white;
      border-radius: 50%;
      padding: 5px;
      display: inline-block;
    } */

    .chat-table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .chat-table tbody tr:hover {
      background-color: #f0f0f0;
    }

    .back-button {
      margin-top: 20px;
      margin-left: 80%;
      margin-bottom: 23px;
    }

    .back-link {
      color: #9a208c;
      font-size: 18px;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .back-link:hover {
      color: #e11299;
    }

    .img-class {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>
</head>

<body>
  <div class="main-wrapper">
    <div class="chat-container">
      <h1 class="chat-heading">Welcome to Chat History</h1>
      <table class="chat-table">
        <thead>
          <tr>
            <th colspan="2" style="text-align: center;padding-top: 1rem;padding-bottom:1rem;">Sender</th>
            <th style="text-align: center;padding-top: 1rem;padding-bottom:1rem;">Message</th>
            <th style="text-align: center;padding-top: 1rem;padding-bottom:1rem;">Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($messages as $message) {
            ?>
            <a href="#">
              <tr>
                <td colspan="2">
                  <div style="display: flex;align-items: center;justify-content:start;gap: 2rem;width:100%;">
                    <div class="user-avatar">
                      <img class="img-class" src="<?php if ($message["toUser"] == $user_id) {
                        echo $message["sender_image"];
                      } else {

                        echo $message['receiver_image'];
                      }

                      ?>" alt="" />
                    </div>
                    <a href="<?php
                    if ($message['toUser'] == $user_id) {
                      echo "chat/chatmodule.php?toId=" . $message['fromUser'];
                    } else {
                      echo "chat/chatmodule.php?toId=" . $message['toUser'];
                    } ?>">
                      <?php if ($message["toUser"] == $user_id) {
                        echo $message["sender_name"];

                      } else {
                        echo $message["receiver_name"];
                      } ?>
                    </a>
                  </div>

                </td>
                <!-- <td>
                  <a href="<?php
                  if ($message['toUser'] == $user_id) {
                    echo "chat/chatmodule.php?toId=" . $message['fromUser'];
                  } else {
                    echo "chat/chatmodule.php?toId=" . $message['toUser'];
                  } ?>">
                    <?php if ($message["toUser"] == $user_id) {
                      echo $message["sender_name"];

                    } else {
                      echo $message["receiver_name"];
                    } ?>
                  </a>
                </td> -->
                <td style="text-align: center;"><?php echo $message['message'] ?></td>
                <td style="font-size: 14px;text-align: center;"><?php echo parseTime($message['timestamp']) ?></td>
                <!-- <a href="chat/chatmodule.php?toId=<?php echo $message['toUser']; ?>">
              <button class="button" id="message_btn">Message💬</button>      
            </a> -->
              </tr>
            </a>
          <?php } ?>
        </tbody>
      </table>
      <div class="back-button">
        <a href="users.php" class="back-link">← Back</a>
      </div>
    </div>
  </div>

</body>

</html>