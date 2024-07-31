<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #fff;
            color: #9a208c;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .login {
            background-color: #ffeaea;
            padding: 45px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .logreg-title {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logreg-title h2 {
            color: #e11299;
            font-size: 24px;
            margin: 0;
            margin-bottom: 12px;

        }
        
        .logreg-title p {
            color: #9a208c;
            font-size: 14px;
            margin: 5px 0 0;
        }
        
        .input-box {
            position: relative;
            margin-bottom: 20px;
        }
        
        .input-box .icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #9a208c;
        }
        
        .input-box input {
            width: 75%;
            padding: 10px 40px 10px 35px;
            border: 1px solid #9a208c;
            border-radius: 5px;
            background-color: #fff;
            color: #9a208c;
            font-size: 16px;
            outline: none;
        }
        
        .input-box label {
            position: absolute;
            top: 50%;
            left: 45px;
            transform: translateY(-50%);
            color: #9a208c;
            pointer-events: none;
            transition: 0.3s;
        }
        
        .input-box input:focus + label,
        .input-box input:valid + label {
            top: 0;
            left: 35px;
            transform: translateY(-50%);
            font-size: 12px;
            font-weight: bold;
            color: #e11299;
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background-color: #9a208c;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .btn:hover {
            background-color: #e11299;
        }

        .back-button {
        margin-top: 28rem;
        margin-bottom:1rem;
        margin-right:4rem;
      }

      .back-button a {
        color: #9a208c;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
      }

      .back-button a:hover {
        color: #e11299;
      }
    </style>
</head>
<body>
    <div class="form-box login">
        <div class="logreg-title">
            <h2>Login as Admin</h2>
            <p>Please login to use the platform</p>
        </div>
        <form action="adminlogindb.php" method="POST" id="myform">
            <div class="input-box">
                <span class="icon"><i class="bx bxs-user"></i></span>
                <input type="text" name="email" required />
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><i class="bx bxs-lock-alt"></i></span>
                <input type="password" name="password" required />
                <label>Password</label>
            </div>
            <button type="submit" class="btn" id="login-btn">Login</button>
        </form>
    </div>
    <div class="back-button">
        <a href="../morbi.php">⬅Back</a>
      </div>
    </div>
</body>
</html>
