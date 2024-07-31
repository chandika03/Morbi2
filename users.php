<?php
include('dbconn.php');
  //search
  session_start();
  
  if(!isset($_SESSION['user'])){
    header("Location: /morbi/morbi.php");
    exit();
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <!-- Link Swiper's CSS -->
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
      
      <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
        
    <style>
      /* === Google Font Import - Poppins === */
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
      
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffeaea;
}


/* nav */
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  padding: 20px 100px;
  background: #9a208c;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 99;
}

.logo {
  font-size: 32px;
  color: #fff;
  text-decoration: none;
  font-weight: 700;
}
.navbar{
  width: 50%;
  display: flex;
  justify-content: space-around;
  margin: auto;
}
.navbar form{
  margin-left: 15rem;
}
.navbar a {
  font-size: 18px;
  color: #fff;
  text-decoration: none;
  font-weight: 500px;
  margin-right: 40px;
}

section {
  position: relative;
  height: 470px;
  width: 1075px;
  display: flex;
  align-items: center;
}

.swiper {
  width: 950px;
}

.card {
  position: relative;
  background: #fff;
  border-radius: 20px;
  height: 450px;
  width: 450px;
  margin: 20px 0;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}

.card::before {
  content: "";
  position: absolute;
  height: 40%;
  width: 100%;
  background: #ffeaea;
  color: black;
  border-radius: 20px 20px 0 0;
}

.card .card-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 30px;
  position: relative;
  
}

section .card .image {
  height: 140px;
  width: 140px;
  border-radius: 50%;
  padding: 3px;
  background: #9a208c; 
  margin-top: 30px;
}

section .card .image img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 3px solid #fff;
}

.card .media-icons {
  position: absolute;
  top: 10px;
  right: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.card .media-icons i {
  color: #9a208c; 
  opacity: 0.6;
  margin-top: 10px;
  transition: all 0.3s ease;
  cursor: pointer;
  margin: 10px;
}

.card .media-icons i:hover {
  opacity: 1;
}

.card .name-bio-age-address{
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
  color: black;
}

.name-bio-age-address .name {
  font-size: 20px;
  font-weight: 600;
}

.name-bio-age-address .bio {
  font-size: 15px;
  font-weight: 500;
}

.name-bio-age-address .age {
  font-size: 15px;
  font-weight: 500;
}

.name-bio-age-address .address{
  font-size: 15px;
  font-weight: 500;
  color:black;

}
.card .button {
  width: 100%;
  display: flex;
  justify-content: space-around;
  margin-top: 20px;
 
  
}
.card .button a{
  text-decoration: none;
}

.card .button button {
  background: #9a208c; 
  outline: none;
  border: none;
  color: #fff;
  padding: 8px 22px;
  border-radius: 20px;
  font-size: 14px;
  transition: all 0.3s ease;
  cursor: pointer;
  
}

.card .button button a{
  text-decoration: none;
}

.button button:hover {
  background: #e11299; 

}

.swiper-slide{
  margin: 0 15px;
}

.swiper-container {
  width: 100%;
  max-width: 1200px;
  margin: 20px auto;
  position: relative;
  overflow: hidden; 

}

/* .swiper-button-next,
.swiper-button-prev {

  opacity: 0.7;
  color: black;
  transition: all 0.3s ease;
 
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
  opacity: 1;
  color: white;
} */

.header input{
  width: 10rem;
  height: 2rem;
  border-radius: 10px;
  border: none;
  border: 1px solid #fff;
  padding-left: 1rem;
}
.header i{
  position: relative;
  
  left: -2rem;
  color: #9a208c;
}

.profile{
  width: 50px;
  height: 50px;
  background: white;
  border-radius: 50%;
}
.profile img{
  width: 100%;
  height: 100%;
  background-size: cover;
  border-radius: 50%;
}
.profile i{
  color: #fff;
  position: relative;
  left: 3.3em;
  top: -1.7rem;
  width: 2rem;
}
.drop {
  text-align: center;
  width: 10rem;
  position: relative;
  border: 1px solid #fff;
  left: -3rem;
  top: -1rem;
  /* margin-top: 0.2rem; */
  background-color: #fff;
  box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;
  border-radius: 3%;
  display: none;
  z-index: 1000;
}

.drop p {
  height: 2rem;
  border-bottom: none; 
  color: #9a208c; 
  padding: 0.5rem 0; 
  font-size: 15px;
  font-weight: 500;
}
.drop p a{
  text-decoration: none;
}

</style>
</head>

<body>
<header class="header">
      <a href="#" class="logo">MORBI</a>
      <nav class="navbar">
        <a href="morbi.php">Home</a>
        <a href="users_about_us.php">About us</a>
        <form role="search" method="POST" action="">
          <input type="search" name= "search" placeholder="Search">
          <i class="fa-solid fa-magnifying-glass"></i>
        </form>
       
      </nav>

  <?php
  $current_user = (int)$_SESSION['user'];

  $convert_user =  (int)$current_user;
    
    $user_id;
    $i = 0;
    $j = 0;
    $searchValue;
  
    @$count = $_GET['count'];
     
    $searchValue = false;
    if(isset($_POST['search'])){
      $searchValue = $_POST['search'];
    }
?>

      <?php 
       $stmt = $pdo->prepare("SELECT user_image FROM users WHERE user_id = :current_user");
       // $stmt = $pdo->prepare("SELECT * FROM users");
       $stmt -> bindParam(":current_user", $current_user);
       $stmt -> execute();
       $image = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="profile">
        <img src="<?php echo $image['user_image']  ?>" alt=""/>
        <i class="fa-solid fa-caret-down drop-icon"></i>
        <div class="drop">
          <p> <a href="details.php">Update</a></p>
          <p> <a href="message_history.php">Message</a></p>
          <p> <a href="logout.php">Log Out</a></p>
        </div>
      </div>
    </header>
    <section>
      
      <div class="swiper mySwiper container">
        <div class="swiper-wrapper content">
       

          <?php
        
if (isset($_POST['search'])){
  
  $name = strtolower($_POST['search']);
  
  // $stmt =$pdo->prepare("SELECT * FROM users where lower(user_name) LIKE :name  OR lower(user_gender) LIKE :name OR  lower(user_age) LIKE :name  OR  lower(user_address) LIKE :name AND user_id != :current_user");
  $stmt =$pdo->prepare("SELECT * FROM users
  WHERE (LOWER(user_name) LIKE :name
        OR LOWER(user_age) LIKE :name
        OR LOWER(user_address) LIKE :name
        OR LOWER(user_gender) LIKE :name)
        AND user_id != :current_user");

  $stmt->bindParam(':name', $name_like);
  $stmt -> bindParam(":current_user", $current_user);
  $name_like = '%' . $name . '%';
  $stmt -> execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $totalUsers = $stmt->rowCount();

  // var_dump($totalUsers);
}
else{
  
  $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id != :current_user");
  $stmt -> bindParam(":current_user", $current_user);
  $stmt -> execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $totalUsers = $stmt->rowCount();

  echo "lala";
}




  for ($userCount = -1; $userCount < $totalUsers; $userCount++) {
    if($userCount == -1){
      continue;
    }
    ?>


        <div class="swiper-slide card">
          <div class="card-content">
          <div class="media-icons">
              <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a> 
              <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
              <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="image">
              <img src="<?php echo $users [$userCount] ['user_image']  ?>" alt="" class="card-img"/>
            </div>
          </div>
          <div class="name-bio-age-address">
            <span class="name"><h2 class="name"><?php echo $users [$userCount] ['user_name']; ?></h2></span>
              <span class="age"><?php echo $users [$userCount] ['user_age'];?></span>
              <span class="address">📍<?php echo $users [$userCount] ['user_address'];?></span>
              <span class="bio"><p><?php echo $users [$userCount] ['user_details']; ?></p></span>
              <div class="button">
                <a href= "chat/chatmodule.php?toId=<?php echo $users [$userCount] ['user_id']; ?>"><button class="button" id="message_btn" >Message💬</button></a>
              </div>
            </div>
          </div>      
        </div>     
      </div>
    </div>
    <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination">
      </div> -->
      <?php } ?>
      
  </section>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <script src="./swiper.js"></script>
</body></html>