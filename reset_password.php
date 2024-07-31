<html>
    <head>
      <style>
        .form-box {
            background-color: #f5c6ec;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .logreg-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .logreg-title h2 {
            color: #9a208c;
        }

        .logreg-title p {
            color: #232946;
        }
        .icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
        }
        .input-box {
            /* position:relative; */
            margin-bottom: 20px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #e11299;
            border-radius: 5px;
            outline: none;
            color: #232946;
        }
        label {
            /* position: absolute; */
            top: 50%;
            /* transform: translateY(-50%); */
            left: 40px;
            color: #232946;
        }
        .btn {
            background-color: #9a208c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #e11299;
        }
      </style>
    </head>
    <body>
<div class="form-box forgot-password">
  <div class="logreg-title">
    <h2>Forgot Password</h2>
    <p>Enter your email to reset your password</p>
  </div>
  <form action="reset_password.php" method="post">
    <div class="input-box">
      <span class="icon"><i class="bx bxs-envelope"></i></span>
      <label>Email</label>
      <input type="email" name="email"  placeholder="example@gmail.com" required />
      
    </div>
    <div class="input-box">
      <span class="icon"><i class="bx bxs-lock-alt"></i></span>
      <label>New Password</label>
      <input type="password" name="new_password" required />
      
    </div>
    <div class="input-box">
      <span class="icon"><i class="bx bxs-lock-alt"></i></span>
      <label>Confirm Password</label>
      <input type="password" name="confirm_password" required />
      
    </div>
    <button type="submit" class="btn" name="reset_password">Reset Password</button>
  </form>
  <a href="morbi.php">
    <button class="btn">⬅Back</button>
</a>
</div>

</body>
</html>
<?php
include('dbconn.php');
session_start();

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the email exists in your database using PDO
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Check if new password and confirm password match
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the user's password in the database using PDO
            $stmt = $pdo->prepare("UPDATE users SET user_password = :password WHERE user_id = :user_id");
            $stmt->bindParam(':password', $hashed_new_password);
            $stmt->bindParam(':user_id', $user['user_id']);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                // Password reset successful
                echo "Password reset successful. You can now log in with your new password.";
            } else {
                echo "Error updating the password.";
            }
        } else {
            echo "New password and confirm password do not match.";
        }
    } else {
        echo "Email not found in the database.";
    }
}
?>
