<?php
  //search
  session_start();
  // echo $_SESSION['id'];
  
  if(!isset($_SESSION['id'])){
    header("Location: /morbi/admin/adminlogin.php");
    exit();
  }?>
<!DOCTYPE html>
<html>
<head>
  <title>Users Profile</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    body {
      background-color: #ffeaea;
      color: #9a208c;
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      border: 1px solid #9a208c;
    }

    th {
      background-color: #9a208c;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f5c6ec;
    }

    tr:hover {
      background-color: #ffeaea;
    }
  </style>
</head>
<body>
<?php
include '../dbconn.php';

// Fetch user profiles from the database
$query = "SELECT * from users";
$statement = $pdo->query($query);
$profiles = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
  <tr>
    <th>User Name</th>
    <th>Email</th>
    <th>Age</th>
    <th>Details</th>
    <th>Gender</th>
    <th>Address</th>
    <th>Action</th>
  </tr>
  <?php
  foreach ($profiles as $profile): ?>
    <tr>
      <td><?php echo $profile['user_name']; ?></td>
      <td><?php echo $profile['user_email']; ?></td>
      <td><?php echo $profile['user_age']; ?></td>
      <td><?php echo $profile['user_details']; ?></td>
      <td><?php echo $profile['user_gender']; ?></td>
      <td><?php echo $profile['user_address']; ?></td>
      <td><a href="deleteuser.php?id=<?php echo $profile['user_id']; ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  
</table>
<a href="../admin/adminhome.php">Back</a>
</body>
</html>
