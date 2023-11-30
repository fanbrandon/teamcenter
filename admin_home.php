<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

// Fetch events and corresponding users from the events and user_events tables
$query = "SELECT events.*, GROUP_CONCAT(users.user_name SEPARATOR ', ') AS registered_users
          FROM events
          LEFT JOIN user_events ON events.event_id = user_events.event_id
          LEFT JOIN users ON user_events.user_id = users.user_id
          GROUP BY events.event_id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styleMain.css" />
  <title>Home</title>
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
      <h1>All Events and Registered Volunteers</h1>
      <div class="myEventsContent">
        <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<div class='myEventsContent'>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Name:</span></strong> <span style=\"color: white;\">{$row['event_name']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Date:</span></strong> <span style=\"color: white;\">{$row['event_date']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Location:</span></strong> <span style=\"color: white;\">{$row['event_location']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Registered Volunteers:</span></strong> <span style=\"color: white;\">{$row['registered_users']}</span></p>";
              // Add any other details you want to display
              echo "</div><br>";
              echo "<div class='line'></div>";
            }
          } else {
            echo "No events available.";
          }
        ?>
      </div>
    </div>
  </div>
</body>
</html>