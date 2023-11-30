<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

// Fetch all users with user type 'user'
$query = "SELECT users.*, user_info.about_me, user_info.experience, user_info.accommodations FROM users ";
$query .= "LEFT OUTER JOIN user_info ON users.user_id = user_info.user_id ";
$query .= "WHERE users.user_type = 'user'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styleMain.css" />
  <title>Users</title>
</head>
<body>
  <div class="container">
    <div class="content">
      <header>
        <img src="images/saclogo.png" alt="Logo" />
        <nav>
          <a href="admin_home.php">Home</a>
          <a href="admin_about.php">About</a>
          <a href="admin_events.php">Events</a>
          <a href="admin_questions.php">Questions</a>
          <a href="volunteers.php">Volunteers</a> 
        </nav>
        <div class="logout"><a href="logout.php">Log Out</a></div>
      </header>
      <h1>All Volunteers</h1>
      <div class="userList">
        <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<div class='userItem'>";
              echo "<p><strong><span style=\"color: #C5B682;\">Username:</span></strong> <span style=\"color: white;\">{$row['user_name']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">First Name:</span></strong> <span style=\"color: white;\">{$row['firstname']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Last Name:</span></strong> <span style=\"color: white;\">{$row['lastname']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Email:</span></strong> <span style=\"color: white;\">{$row['email']}</span></p>";
              // Add any other details you want to display
              echo "<div id='additionalInfo{$row['user_id']}' style='display: none;'>";
              echo "<p><strong><span style=\"color: #C5B682;\">About Me:</span></strong> ";
              if (!empty($row['about_me'])) {
                echo "<span style=\"color: white;\">{$row['about_me']}</span>";
              } else {
                echo "<span style=\"color: white;\">No information available</span>";
              }
              echo "</p>";

              echo "<p><strong><span style=\"color: #C5B682;\">Experience:</span></strong> ";
              if (!empty($row['experience'])) {
                echo "<span style=\"color: white;\">{$row['experience']}</span>";
              } else {
                echo "<span style=\"color: white;\">No information available</span>";
              }
              echo "</p>";

              echo "<p><strong><span style=\"color: #C5B682;\">Accommodations:</span></strong> ";
              if (!empty($row['accommodations'])) {
                echo "<span style=\"color: white;\">{$row['accommodations']}</span>";
              } else {
                echo "<span style=\"color: white;\">No information available</span>";
              }
              echo "</p>";

              echo "</div>"; // End of additionalInfo div

              // Hide button
              echo "<button class='delete-button' onclick=\"toggleAdditionalInfo('additionalInfo{$row['user_id']}')\">Show Profile</button>";
              echo "</div><br><br>";
              echo "<div class='line'></div>";
            }
          } else {
            echo "No users available.";
          }
        ?>
      </div>
    </div>
  </div>
  <script>
    function toggleAdditionalInfo(elementId) {
      var additionalInfo = document.getElementById(elementId);
      additionalInfo.style.display = (additionalInfo.style.display === 'none') ? 'block' : 'none';
    }
  </script>
</body>
</html>