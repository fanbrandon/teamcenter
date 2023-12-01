<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

// Fetch events for the current user from the user_events table
$user_id = $_SESSION['user_id'];
$query = "SELECT events.* FROM events JOIN user_events ON events.event_id = user_events.event_id WHERE user_events.user_id = $user_id";
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
          <a href="user_home.php">Home</a>
          <a href="about.php">About</a>
          <a href="events.php">Events</a>
          <a href="questions.php">Questions</a>
          <a href="profile.php">Profile</a>
        </nav>
        <div class="logout"><a href="logout.php">Log Out</a></div>
      </header>
      <h1>My Events</h1>
      <div class="myEventsContent">
        <?php
          $userEventsQuery = "SELECT events.* FROM events
                              INNER JOIN user_events ON events.event_id = user_events.event_id
                              WHERE user_events.user_id = " . $_SESSION['user_id'];
          $userEventsResult = mysqli_query($con, $userEventsQuery);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($userEventsResult)) {
              echo "<div class='myEventsContent'>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Name:</span></strong> <span style=\"color: white;\">{$row['event_name']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Date:</span></strong> <span style=\"color: white;\">{$row['event_date']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Location:</span></strong> <span style=\"color: white;\">{$row['event_location']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Description:</span></strong> <span style=\"color: white;\">{$row['event_description']}</span></p>";
              echo "<p><strong><span style=\"color: #C5B682;\">Event Tasks:</span></strong> <span style=\"color: white;\">{$row['event_task']}</span></p>";
              echo "<button class='unregister-button' onclick='unregisterFromEvent(" . $row['event_id'] . ")'>Unregister</button>";
              echo "</div><br><br>";
              echo "<div class='line'></div>";
            }
          } else {
            echo "You haven't registered for any events";
          }
        ?>
      </div>
    </div>
  </div>

  <script>
    // JavaScript function to handle event unregistration
    function unregisterFromEvent(eventId) {
      // Make an AJAX request to unregister the user from the event
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          // Handle the response from the server
          alert(this.responseText);
          // Reload the page after unregistering
          location.reload();
        }
      };
      xmlhttp.open("GET", "unregister_event.php?event_id=" + eventId, true);
      xmlhttp.send();
    }
  </script>
</body>
</html>