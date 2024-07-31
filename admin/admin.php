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
  <title>Reported User Profiles</title>
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
$query = "SELECT users_reported.user_name AS reported_user_name, users_reporting.user_name AS reporting_user_name, report.reason, report.userid 
          FROM report 
          JOIN users AS users_reported ON report.userid = users_reported.user_id 
          JOIN users AS users_reporting ON report.byuser = users_reporting.user_id";
$statement = $pdo->query($query);
$reportedProfiles = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
  <tr>
    <th>Reported User</th>
    <th>Reported By</th>
    <th>Reason</th>
    <th>Action</th>
  </tr>
  <?php
  foreach ($reportedProfiles as $reportedProfile): ?>
    <tr>
      <td><?php echo $reportedProfile['reported_user_name']; ?></td>
      <td><?php echo $reportedProfile['reporting_user_name']; ?></td>
      <td><?php echo $reportedProfile['reason']; ?></td>
      <td><a href="delete.php?id=<?php echo $reportedProfile['userid']; ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  
</table>
<a href="../admin/adminhome.php">Back</a>

</body>
</html>
