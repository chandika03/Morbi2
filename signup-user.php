<?php
    include('dbconn.php');
    $invalid = $_GET['invalid'];
    echo $invalid; ?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <title>Signup</title>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0 text-center">Sign Up</h1>
                    </div>
                    <div class="card-body">
                        <form action="signupdb.php" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input class="form-control" type="name" name="name" id="name" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group">
                              <label for="email">Email:</label>
                              <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email" required>
                            </div>
                            </div>
                            <div class="form-group">
                              <label for="password">Password:</label>
                              <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group">
                              <label for="cpassword">Confirm Password:</label>
                              <input class="form-control" type="password" name="cpassword" id="cpassword" placeholder="Enter your password" required>
                            </div>
                            
                            <!-- <div class="form-group">
                              <label for="email">Age:</label>
                              <input class="form-control" type="age" name="age" id="age" placeholder="Enter your age" required>
                            </div>
                            <div>
                              <label for="gender">Gender:</label></br>
                              <input type="radio" name="gender" id="male" value="male">Male</br>
                              <input type="radio" name="gender" id="female" value="female">Female</br>
                            </div> -->
                            <div class="text-center">
                              <button class="btn btn-primary btn-lg my-3" type="submit">Signup</button>
                            </div>
                            <P><?php 
                            
                            echo $invalid."hello"; ?></p>
                        </form>
                        <p class="mb-0 text-center">Already have an account?<a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>