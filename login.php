<?php
    include('dbconn.php');

    @$invalid = $_POST['invalid'];
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
    }
    $query = "SELECT *FROM signup WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt -> bindParam(':email',$email);
    // $stmt -> bindParam(':password',$password);    
    $stmt->execute();

     // Fetch the user record
     $user = $stmt->fetch(PDO::FETCH_ASSOC);

     if ($user && password_verify($password, $user['password'])) {
         // Successful login
         // Redirect or perform other actions
         header("Location: /morbi/users.php");
         exit();
     } else {
         // Invalid credentials
         $invalid = "Invalid credentials!";
         echo '<script>window.onload = function() { alert("Invalid credentials!"); }</script>'; // Display alert message using JavaScript in a popup window
         echo '<script>alert("Incorrect username or password.");</script>'
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <title>Login</title>
</head>
<body>
    <div class="container my-5">
    <?php if($invalid != null){?>
    <div class="alert alert-danger mb-3" role="alert"><?php echo $invalid ?></div>
    <?php }?>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0 text-center">Log In</h1>
                    </div>
                    <div class="card-body">
                        <form action="logindb.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input class="form-control" type="text" name="email" id="email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                            </div>
                            <!-- <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div> -->
                    
                            <div class="text-center">
                                <button class="btn btn-primary btn-lg my-3" type="submit">Login</button>
                            </div>
                        </form>
                        <p class="mb-0 text-center">Create an account?<a href="signup-user.php">signup</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
        setTimeout(function() {
            // window.location.href = "/SL/phonebook/login.php"; // hide success message
            document.querySelector(".alert").style.display = "none";
      }, 5000);
    </script> -->
    <script>
        setTimeout(function() {
            var alertMessage = document.querySelector(".alert");
            if (alertMessage) {
                alertMessage.style.display = "none";
            }
        }, 5000);
    </script>
</body>
</html>
