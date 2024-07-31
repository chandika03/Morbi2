<?php
    include('dbconn.php');
    session_start();

    @$invalid = $_POST['invalid'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="morbi.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>MORBI</title>

    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
      /* body {
        font-family: Arial, sans-serif;
        background-color: #ffeaea;
        margin: 0;
        padding: 0;
      } */

      .circle {
        display: inline-block;
        width: 144px;
        height: 159px;
        border-radius: 50%;
        background-color: #f9b5d0;
        text-align: center;
        line-height: 120px;
        margin: 20px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
      }

      .circle a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
      }

      .circle:hover {
        background-color: #9a208c;
      }

      .div_container {
        margin-top: 50px;
      }

      .div_container h2 {
        color: #9a208c;
        text-align: center;
      }

      .about-us {
        background-color: #f5c6ec;
        margin-top: 5rem;
        margin-bottom: 5rem;
        padding: 2rem;
      }

      .about-us h3 {
        text-align: center;
        color: #e11299;
      }

      .about-us p {
        text-align: justify;
        color: #9a208c;
      }

      .about-us .btn-md {
        background-color: #e11299;
        border: none;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        margin-top: 20px;
        display: inline-block;
        font-weight: bold;
      }

      .about-us .btn-md a {
        color: #fff;
        text-decoration: none;
      }
   
      .has-text-align-center {
        text-align: center;
      }

      h1,
      h2,
      h3 {
        font-stretch: normal;
        font-style: normal;
        font-weight: 500;
        margin: 0 0 1.5em;
      }

      .wp-block-column.is-vertically-aligned-center {
        align-self: center;
      }

      .wp-block-group.is-style-max-width .wp-block-group__inner-container {
        max-width: 980px;
      }
      .wp-block-group .wp-block-group__inner-container {
        margin: 0 auto;
        max-width: 1280px;
        padding: 0 20px;
      }

      .is-layout-flex {
        display: flex;
      }

      p {
        display: block;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
      }
      .wp-block-column {
        flex-basis: 100%;
        padding: 0;
        width: 100%;
      }

      .wp-block-heading {
        color: #e11299;
      }
      .wp-block-button.is-style-knightrider,
      .wp-block-button.is-style-premium {
        background-color: #f5c6ec;
        background-image: url(/wplp/wp-content/themes/psg-homepage-theme/assets/img/bg/eharmony/premium.svg);
        background-position: 50%;
        background-size: 101% auto;
        color: #fff;
      }

      .wp-block-button .wp-block-button__link {
        background-color: transparent;
        color: inherit;
        display: block;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1.4px;
        line-height: 1;
        padding: 16px 16px 14px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
      }

      .wp-block-image .aligncenter,
      .wp-block-image.aligncenter {
        margin-left: auto;
        margin-right: auto;
        text-align: center;
      }
      .wp-block-image:not(.is-style-rounded) img {
        height: auto;
      }

      .container {
        max-width: 1170px;
        margin: auto;
      }
      .row {
        display: flex;
        flex-wrap: wrap;
      }
      ul {
        list-style: none;
      }
      .footer {
        background-color: #f9b5d0;
        padding: 30px 0;
      }
      .footer-col {
        width: 50%;
        padding: 0 15px;
      }
      .footer-col h4 {
        font-size: 20px;
        color: #e11299;
        text-transform: capitalize;
        margin-bottom: 35px;
        font-weight: 500;
        position: relative;
      }
      .footer-col h4::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: -10px;
        background-color: #9a208c;
        height: 2px;
        box-sizing: border-box;
        width: 50px;
      }
      .footer-col ul li:not(:last-child) {
        margin-bottom: 10px;
      }
      .footer-col ul li a {
        font-size: 16px;
        text-transform: capitalize;
        color: #ffffff;
        text-decoration: none;
        font-weight: 300;
        color: #fff;
        display: block;
        transition: all 0.3s ease;
      }

      .footer-col .social-links a {
        display: inline-block;
        height: 40px;
        width: 40px;
        background-color: rgba(255, 255, 255, 0.2);
        margin: 0 10px 10px 0;
        text-align: center;
        line-height: 40px;
        border-radius: 50%;
        color: #ffffff;
        transition: all 0.5s ease;
      }
      .footer-col .social-links a:hover {
        color: #24262b;
        background-color: #ffffff;
      }
    </style>
  </head>
  <body>
    <!-- <div class="container my-5">
      <?php if($invalid != null){?>
      <div class="alert alert-danger mb-3" role="alert">
        <?php echo $invalid ?>
      </div>
      <?php }?>
    </div> -->

    <header class="header">
      <a href="#" class="logo">MORBI</a>

      <nav class="navbar">
        <a href="#">Home</a>
        <a href="#aboutus">About us</a>
        <button class="btnLogin-popup">Login</button>
      </nav>
    </header>

    <section class="section">
      <div class="wrapper">
        <span class="icon">
          <i class="icon-close bx bx-x"></i>
        </span>

        <div class="logreg-box">
          <!-- Login popup -->
          <div class="form-box login">
            <div class="logreg-title">
              <h2>Login</h2>
              <p>Please login to use the platform</p>
            </div>
            <form action="logindb.php" method="post" id="myform">
              <div class="input-box">
                <span class="icon"><i class="bx bxs-user"></i> </span>
                <input type="text" name="email" required />
                <label>Email</label>
              </div>

              <div class="input-box">
                <span class="icon"><i class="bx bxs-lock-alt"></i> </span>
                <input type="password" name="password" required />
                <label>Password</label>
              </div>
              


              <button type="submit" class="btn" id="login-btn">Login</button>

              <div class="logreg-link">
              <a href="reset_password.php" style="color:white;">Forget Password</a>
                <p>Don't have an account?</p>
                <a href="#" class="register-link">Sign Up</a>
              </div>  
            </form>
              <a href="admin/adminlogin.php"><button type="submit" class="btn">Login as Admin</button></a>
          </div>

          <!-- Sign In form -->
          <div class="form-box signin">
            <div class="logreg-title">
              <h2>Sign In Form</h2>
              <p>Please provide the following to verify your identity</p>
            </div>
            <form action="signupdb.php" method="post" id="myform">
              <div class="input-box">
                <span class="icon"><i class="bx bxs-user"></i> </span>
                <input type="text" name="name" id="name" required />
                <div class="error-message" id="name-error"></div>
                <label>Full Name</label>
              </div>

              <div class="input-box">
                <!-- <span class="icon"><i class="bx bxs-envelope"></i> </span> -->
                <input type="email" name="email" id="email" required />
                <div class="error-message" id="email-error"></div>
                <label>Email Address</label>
              </div>

              <div class="input-box">
                <!-- <span class="icon"><i class="bx bxs-lock-alt"></i> </span> -->
                <input type="password" name="password" id="password" required />
                <div class="error-message" id="password-error"></div>
                <label>Password</label>
              </div>

              <div class="input-box">
                <!-- <span class="icon"><i class="bx bxs-lock-alt"></i> </span> -->
                <input
                  type="password"
                  name="cpassword"
                  id="confirm-password"
                  required
                />
                <div class="error-message" id="confirm-password-error"></div>
                <label>Confirm Password</label>
              </div>

              <button type="submit" class="btn" id="login-btn">Sign In</button>
              <div class="logreg-link">
                <p>
                  Already have an account?<a href="#" class="login-link"
                    >Login</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- About us -->
    <div class="about-us" id="aboutus">
      <div
        class="container d-flex justify-content-between align-items-center"
        style="margin-top: 5rem; margin-bottom: 5rem"
      >
        <!-- <div class="image-container" style="width: 45%">
          <img
            src="Screenshot 2023-05-06 094235.png"
            alt="Error"
            class="img-fluid"
          />
        </div> -->
        <center>
          <div class="text-container" style="width: 50%">
            <h3 class="text-center">About MORBI</h3>
            <p style="text-align: justify">
              <b><i>MORBI</i></b> is an online dating platform that is primarily
              designed for connecting individuals looking for connections or
              matrimonial alliances. It is an part of Global matrimony. Register
              with us for FREE to find a partner of your choice. Take advantage
              of our user friendly search features to find a bride or groom.
              Join us and begin your happy jouney today...

              <br />
            </p>
            <div class="text-center">
              <button class="btn-md">
                <a href="./templates/more.html">Learn More</a>
              </button>
            </div>
          </div>
        </center>
      </div>
    </div>
    <!-- Quality singles -->

    <div class="wp-block-group__inner-container">
      <h2
        class="wp-block-heading has-text-align-center"
        id="quality-singles-just-like-you"
      >
        Quality Singles, Just Like You
      </h2>

      <div
        class="wp-block-columns md mobile-reverse-order are-vertically-aligned-center is-style-gap-30 is-layout-flex"
      >
        <div
          class="wp-block-column is-vertically-aligned-center is-layout-flow mx-5"
        >
          <p>
            Like you, they are tired of dating games. You can have complete<br />
            confidence that all of your compatible matches are looking for
            the<br />
            same thing you are. Love that lasts.
          </p>

          <div
            style="height: 20px"
            aria-hidden="true"
            class="wp-block-spacer"
          ></div>
          <div class="wp-block-buttons is-layout-flex">
            <div class="wp-block-button is-style-premium">
              <a
                class="wp-block-button__link wp-element-button join-btn"
                href="#"
                >Join now</a
              >
            </div>
          </div>
        </div>

        <div
          class="wp-block-column is-vertically-aligned-center is-layout-flow"
        >
          <figure class="wp-block-image aligncenter size-full">
            <img
              decoding="async"
              loading="lazy"
              width="412"
              height="252"
              src="./userimages/single.jpg"
              alt=""
              class="wp-image-59"
              sizes="(max-width: 412px) 100vw, 412px"
            />
          </figure>
        </div>
      </div>
    </div>
    <script src="./script.js"></script>
    <script src="validate.js"></script>
    <!-- <script>alert("Incorrect username or password.");</script> -->
    
  </body>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="footer-col">
          <h4>company</h4>
          <ul>
            <li><a href="./templates/more.html">about us</a></li>
            <li><a href="privacy.html">privacy policy</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>follow us</h4>
          <div class="social-links">
            <a href="https://www.facebook.com" target="_blank">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com" target="_blank">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  
</html>