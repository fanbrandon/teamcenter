<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

// Query to retrieve all events
$query = "SELECT * FROM events";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleMain.css" />
    <title>Events</title>
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
      <h1>Available Events</h1>
      <div class="myEventsContent" id="eventContainer"> 
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<p><strong><span style=\"color: #C5B682;\">Event Name:</span></strong> <span style=\"color: white;\">{$row['event_name']}</span></p>";
                echo "<p><strong><span style=\"color: #C5B682;\">Event Date:</span></strong> <span style=\"color: white;\">{$row['event_date']}</span></p>";
                echo "<p><strong><span style=\"color: #C5B682;\">Event Location:</span></strong> <span style=\"color: white;\">{$row['event_location']}</span></p>";
                echo "<p><strong><span style=\"color: #C5B682;\">Event Description:</span></strong> <span style=\"color: white;\">{$row['event_description']}</span></p>";
                echo "<p><strong><span style=\"color: #C5B682;\">Event Tasks:</span></strong> <span style=\"color: white;\">{$row['event_task']}</span></p>";
                // Use the user_id from the session to check if the user is registered for the event
                $isRegistered = isUserRegistered($con, $_SESSION['user_id'], $row['event_id']);
                if (!$isRegistered) {
                    echo "<button class='register-button' onclick='registerForEvent(" . $row['event_id'] . ")'>Register</button>";
                } else {
                    echo "<span class='registered-text'>Registered</span>";
                }
                echo "</div><br><br>";
                echo "<div class='line'></div>";
            }
        } else {
            echo "No events available.";
        }
        ?>
    </div>
    </div>
</div>


<script>
        function registerForEvent(eventId) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    location.reload();
                    // reload page
                }
            };
            xmlhttp.open("GET", "register_event.php?event_id=" + eventId, true);
            xmlhttp.send();
        }
    </script>

</body>
</html>