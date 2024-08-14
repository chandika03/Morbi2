<?php 
include('dbconn.php');
session_start();

$loggeduserid = $_SESSION['user'];

// Fetch the logged-in user's details
$userkostmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
$userkostmt->bindParam(":user_id", $loggeduserid);
$userkostmt->execute();
$user_info = $userkostmt->fetch(PDO::FETCH_ASSOC);

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $bio = $_POST['bio'];
    $interest = $_POST['interest'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $image = $_POST['image'];

    // Image upload handling
    if (!empty($_FILES['image']['tmp_name'])) {
        $image = $_FILES['image']['tmp_name'];
        $targetDir = "images/";  // Specify the target directory to save the uploaded image
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($image, $targetFile)) {
            $imagePath = $targetFile;
            $query = "UPDATE users SET user_name = :name, user_email = :email, user_age = :age, user_address = :address, user_gender = :gender, user_details = :bio, user_interest = :interest, user_image = :imagePath, latitude = :latitude, longitude = :longitude WHERE user_id = :userid";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userid', $loggeduserid);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':interest', $interest);
            $stmt->bindParam(':imagePath', $imagePath);
            $stmt->bindParam(':latitude', $latitude);
            $stmt->bindParam(':longitude', $longitude);
            $stmt->execute();
        } else {
            echo "Upload failed!!";
        }
    } else {
        $query = "UPDATE users SET user_name = :name, user_email = :email, user_age = :age, user_address = :address, user_gender = :gender, user_details = :bio, user_interest = :interest, latitude = :latitude, longitude = :longitude WHERE user_id = :userid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':userid', $loggeduserid);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':interest', $interest);
        $stmt->bindParam(':latitude', $latitude);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->execute();
    }

    header("Location: users.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update Profile</title>
    <style>
        body {
            background-color: #ffeaea;
            color: #000000;
        }

        .update-profile {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form {
            margin-bottom: 20px;
        }

        .profile {
            text-align: center;
        }

        .profile img {
            border-radius: 50%;
            width: 190px;
            height: 120px;
        }

        .fullname {
            /* Add additional styling here if needed */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #9a208c;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #e11299;
            border-radius: 5px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        textarea {
            height: 80px;
        }

        input[type="submit"] {
            display: block;
            width: 150px;
            margin: 0 auto;
            padding: 10px;
            background-color: #e11299;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
    function updateLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function(error) {
                console.error("Error getting location: ", error);
                alert("Unable to retrieve location. Please enable location services and try again.");
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Prompt the user to share their location when the page loads
    window.onload = function() {
        updateLocation();
    };
    </script>
</head>
<body>
<div class="update-profile">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="inputBox">
                <br /><br /> 
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo $user_info['user_name'] ?>" placeholder="Full Name" readonly /><br />

                <label>Email</label>
                <input type="email" name="email" value="<?php echo $user_info['user_email'] ?>" placeholder="Email" readonly /><br />

                <label>Age</label>
                <input type="text" name="age" value="<?php echo $user_info['user_age'] ?>" placeholder="Age" /><br />

                <label>Address</label>
                <input id="address-input" type="text" name="address" value="<?php echo $user_info['user_address'] ?>" placeholder="Address" /><br />

                <center>
                <label for="gender">Gender:</label><br />
                <input type="radio" id="male" name="gender" value="m" <?php echo ($user_info['user_gender'] === 'male') ? 'checked' : ''; ?> />
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="f" <?php echo ($user_info['user_gender'] === 'female') ? 'checked' : ''; ?> />
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="o" <?php echo ($user_info['user_gender'] === 'other') ? 'checked' : ''; ?> />
                <label for="other">Other</label><br />
                </center>

                <br /><br />
                <label for="imageInput">Select an image:</label>
                <input type="file" id="imageInput" name="image" accept="images/*" /><br><br>

                <label>Bio:</label><br />
                <textarea id="bio" name="bio" rows="4" cols="50" placeholder="Bio"><?php echo $user_info['user_details'] ?></textarea><br />
                <label>Interest:</label><br />
                <textarea id="interest" name="interest" rows="4" cols="50" placeholder="Write atleast 10 interests"><?php echo $user_info['user_interest'] ?></textarea><br />

                <input type="hidden" name="latitude" id="latitude" value="<?php echo $user_info['latitude'] ?>" />
                <input type="hidden" name="longitude" id="longitude" value="<?php echo $user_info['longitude'] ?>" />

                <input type="submit" value="Submit" />
                <button>
                    <a href="users.php">Back</a>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
