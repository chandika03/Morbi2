<?php
include('dbconn.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /morbi/morbi.php");
    exit();
}

$current_user = (int)$_SESSION['user'];

// Get search parameters from GET request
$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$age = isset($_GET['age']) ? (int)$_GET['age'] : '';
$location = isset($_GET['location']) ? $_GET['location'] : '';

// Build the SQL query
$query = "SELECT * FROM users WHERE user_id != :current_user";

$params = [':current_user' => $current_user];

if ($gender) {
    $query .= " AND user_gender = :gender";
    $params[':gender'] = $gender;
}

if ($age) {
    $query .= " AND user_age BETWEEN :min_age AND :max_age";
    $params[':min_age'] = $age - 1; // One year below
    $params[':max_age'] = $age + 1; // One year above
}

if ($location) {
    $query .= " AND LOWER(user_address) LIKE :location";
    $params[':location'] = '%' . strtolower($location) . '%';
}

// Prepare and execute the query
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
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
            position: absolute;
            left: 10px;
        }

        .navbar {
            width: 90%; 
            display: flex;
            justify-content: flex-start; 
            align-items: center;
            margin: auto;
            padding: 10px;
            position: relative;
        }

        .navbar form {
            margin-left: 10px;
            display: flex;
            align-items: center;
        }

        .navbar a {
            color: #f2f2f2;
            text-align: center;
            padding: 8px 12px; 
            font-size: 16px; 
            text-decoration: none;
            display: block;
            margin-right: 5px;
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

        .card .name-bio-age-address {
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

        .name-bio-age-address .address {
            font-size: 15px;
            font-weight: 500;
            color: black;
        }

        .name-bio-age-address .interest {
            font-size: 10px;
            font-weight: 500;
            color: red;
        }

        .card .button {
            width: 100%;
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .card .button a {
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

        .card .button button:hover {
            background: #e11299; 
        }

        .swiper-slide {
            margin: 0 15px;
        }

        .swiper-container {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            position: relative;
            overflow: hidden; 
        }

        .header input {
            width: 10rem;
            height: 2rem;
            border-radius: 10px;
            border: none;
            border: 1px solid #fff;
            padding-left: 1rem;
        }

        .header i {
            position: relative;
            left: -2rem;
            color: #9a208c;
        }

        .profile {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
        }

        .profile img {
            width: 100%;
            height: 100%;
            background-size: cover;
            border-radius: 50%;
        }

        .profile i {
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
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 8px 0px, rgba(0, 0, 0, 0.19) 0px 6px 20px 0px;
            border-radius: 3%;
            display: none;
            z-index: 1000;
        }

        .drop a {
            text-decoration: none;
            color: #9a208c;
            display: block;
            padding: 0.5rem;
        }

        .drop a:hover {
            background: #9a208c;
            color: white;
        }

        .search-form select,
        .search-form input,
        .search-form button {
            margin-left: 10px;
        }

        .search-form button {
            background: #9a208c; 
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-form button:hover {
            background: #e11299; 
        }
    </style>
</head>
<body>
<header class="header">
    <a href="#" class="logo">MORBI</a>
    <nav class="navbar">
        <a href="morbi.php">Home</a>
        <a href="users_about_us.php">About us</a>
        <form class="search-form" action="search_results.php" method="GET">
            <label for="gender">Looking for:</label>
            <select id="gender" name="gender">
                <option value="">Any</option>
                <option value="male" <?php if ($gender === 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($gender === 'female') echo 'selected'; ?>>Female</option>
                <option value="other" <?php if ($gender === 'other') echo 'selected'; ?>>Other</option>
            </select>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" placeholder="Enter age" min="18" value="<?php echo htmlspecialchars($age); ?>">

            <label for="location">Living in:</label>
            <input type="text" id="location" name="location" placeholder="Enter location" value="<?php echo htmlspecialchars($location); ?>">

            <button type="submit">Search</button>
        </form>
    </nav>
    <div class="profile">
        <!-- Assuming the profile image logic here -->
    </div>
</header>
<section>
    <div class="swiper mySwiper container">
        <div class="swiper-wrapper content">
            <?php foreach ($users as $user): ?>
                <div class="swiper-slide card">
                    <div class="card-content">
                        <div class="media-icons">
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="image">
                            <img src="<?php echo htmlspecialchars($user['user_image']); ?>" alt="User Image" class="card-img"/>
                        </div>
                    </div>
                    <div class="name-bio-age-address">
                        <span class="name"><h2><?php echo htmlspecialchars($user['user_name']); ?></h2></span>
                        <span class="age"><?php echo htmlspecialchars($user['user_age']); ?></span>
                        <span class="address">📍<?php echo htmlspecialchars($user['user_address']); ?></span>
                        <span class="bio"><p><?php echo htmlspecialchars($user['user_details']); ?></p></span>
                        <span class="interest"><p><?php echo htmlspecialchars($user['user_interest']); ?></p></span>
                        <div class="button">
                            <a href="chat/chatmodule.php?toId=<?php echo htmlspecialchars($user['user_id']); ?>"><button>Message💬</button></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="./swiper.js"></script>
</body>
</html>
