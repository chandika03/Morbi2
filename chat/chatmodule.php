<?php 
  session_start();
  // echo $_SESSION['user'];
  if(!isset($_SESSION['user'])){
    header("Location: /login.php");
    exit();
  }
  include('../dbconn.php');
  $toUser = $_GET['toId'];
  $fromUser = $_SESSION['user'];

  $stmt1 = $pdo->query("SELECT * FROM message WHERE fromUser=$fromUser AND toUser=$toUser");
  $info=$stmt1->fetchAll(PDO::FETCH_ASSOC);
  if(empty($info)){
    $stmt = $pdo->prepare("INSERT INTO message (fromUser, toUser) VALUE (:fromuser,:touser)");
    $stmt->bindParam(':fromuser', $fromUser);
    $stmt->bindParam(':touser', $toUser);
    $stmt->execute();
  }

  $stmt2=$pdo->prepare("SELECT * FROM message WHERE fromUser =:toUser AND toUser = :fromUser");
  $stmt2->bindParam(':toUser', $toUser);
  $stmt2->bindParam(':fromUser', $fromUser);
  $stmt2->execute();
  $reply_info=$stmt2->fetchAll(PDO::FETCH_ASSOC);

  $stmt3 = $pdo->prepare("SELECT * FROM users WHERE user_id = :toUser");
  $stmt3->bindParam(':toUser', $toUser);
  $stmt3->execute();
  $toUser_image=$stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <!-- <link rel="stylesheet" href="user.css" /> -->
  <link rel="stylesheet" href="chat.css" />
  <script src="chat.js" defer></script>

</head>
<body>
  <div class="chat-container">
    <div class="sidebar">
      <div class="profile">
        <div class="image-content">
          <span class="overlay"></span>
          <div class="card-image">
            <!-- <img src="Screenshot 2023-05-06 094235.png" alt="Profile Image" /> -->
            <img src="../<?php echo $toUser_image[0]['user_image'] ?>" />
          </div>
        </div>
            <h3><?php echo $toUser_image[0]['user_name'] ?></h3>
            <!-- should redirect to this page and get the to id so that picture of the chatting person can be retrieved -->
            <p><?php echo $toUser_image[0]['user_details'] ?></p>
      </div>
          <ul class="sidebar-menu">
            <li class="active">Chats</li>
          </ul>
          
            <div class="report">
            <button>
            <a href="../report/report.php?userId=<?php echo $toUser ?>">Report the user</a>
        </button>
            </div>
          
        <div class="back">
        <button >
            <a href="../users.php">⬅ Go Back</a>
        </button>
        </div>
        
</footer>
    </div>
        <div class="chat">
          <div class="chat-header">
            <h2>Messages</h2>
          </div>
          <div class="form">
                <div class="inbox">
                    <div class="reply">
                      <?php 
                        if(empty($reply_info)){
                          // echo "";
                        }
                        else{
                          foreach($reply_info as $reply){
                            ?>
                            <!-- echo <?php echo $reply_info[0]['message'];?> -->
                         <?php }
                         }
                      ?>
                    </div>
                </div>
            </div>
            <!-- <div class="chat-messages"> </div> -->
            <!-- <div class="chat-messages"> -->
  <!-- <?php
  // foreach ($reply_info as $reply) {
  //   echo '<div class="message">' . $reply['message'] .'</div>';
  // }
  // ?>

</div> -->
<!-- <div class="chat-messages">
    <?php 
    // foreach ($reply_info as $reply) { ?>
      <p class="message">
        <h1>nff b fbbgb</h1>
        <?php 
        // echo $reply['message']?>
    </p>
    <?php 
  // } ?>
  </div> -->
  <div class="chat-messages">
    <?php foreach ($reply_info as $reply) { ?>
        <?php if ($reply['fromUser'] == $fromUser) { ?>
            <p class="message sent-message">
                <?php echo $reply['message'] ?>
            </p>
        <?php } else { ?>
            <p class="message received-message">
                <?php echo $reply['message'] ?>
            </p>
        <?php } ?>
    <?php } ?>
</div>


            <div class="chat-input">
                <div class="input-data">
                  <form action='message.php?toId=<?php echo $toUser;?>' method="post">
                    <input id="data" name="data" type="text" placeholder="Type something here.." required>
                    <button id="send-button">Send</button>
                  </form>
                </div>
            </div>
          </div>
        </div>
      
        
  </div>
    <script>

  document.addEventListener('DOMContentLoaded', () => {
    const chatMessages = document.querySelector('.chat-messages');

    function fetchMessages() {
      fetch(`get_messages.php?fromUser=<?php echo $fromUser; ?>&toUser=<?php echo $toUser; ?>`)
        .then(response => response.text())
        .then(result => {
          chatMessages.innerHTML = result;
          chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => {
          console.error('Error fetching messages:', error);
        });
    }

    function sendMessage(message) {
      fetch(`send_message.php?fromUser=<?php echo $fromUser; ?>&toUser=<?php echo $toUser; ?>`, {
        method: 'POST',
        body: JSON.stringify({ message: message }),
        headers: {
          'Content-Type': 'application/json',
        },
      })
        .then(fetchMessages)
        .catch(error => {
          console.error('Error sending message:', error);
        });
    }

    const sendButton = document.getElementById('send-button');
    const dataInput = document.getElementById('data');

    sendButton.addEventListener('click', () => {
      const message = dataInput.value.trim();
      if (message !== '') {
        sendMessage(message);
        dataInput.value = '';
      }
    });

    // Initial loading of messages
    fetchMessages();
  });

     setTimeout(function() {
  location.reload(); // Reload the page
}, 5000); // 10000 milliseconds = 5 seconds

document.querySelectorAll('.delete-button').forEach(deleteButton => {
      deleteButton.addEventListener('click', (e) => {
        e.preventDefault();
        const deleteForm = e.target.closest('.delete-form');
        if (deleteForm) {
          // Submit the form to delete the message
          deleteForm.submit();
        }
      });
    });
        // $(document).ready(function(){
        //     $("#send-btn").on("click", function(){
        //         $value = $("#data").val();
        //         $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
        //         $(".form").append($msg);
        //         $("#data").val('');
                
        //         // start ajax code
        //         $.ajax({
        //             url: 'message.php',
        //             type: 'POST',
        //             data: 'text='+$value,
        //             success: function(result){
        //                 $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
        //                 $(".form").append($replay);
        //                 // when chat goes down the scroll bar automatically comes to the bottom
        //                 $(".form").scrollTop($(".form")[0].scrollHeight);
        //             }
        //         });
        //     });
        // });
  
    </script>
    
</body>
</html>