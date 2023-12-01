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
                <a href="admin_home.php">Home</a>
                <a href="admin_about.php">About</a>
                <a href="events.php">Events</a>
                <a href="admin_questions.php">Questions</a>
                <a href="volunteers.php">Volunteers</a>
            </nav>
            <div class="logout"><a href="logout.php">Log Out</a></div>
        </header>
      <h1>Available Events</h1>
      <button class="add-event-button" onclick="openAddEventForm()">Add Event</button>

        <!-- Modal for adding events -->
        <div id="addEventModal" class="modal" style="display:none">
        <div class="modal-content">
            <span class="close" onclick="closeAddEventForm()">&times;</span>
            <h1>Add Event</h1>
            <form id="addEventForm" onsubmit="submitEventForm(event)">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required>

                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date" required>

                <label for="event_location">Event Location:</label>
                <input type="text" id="event_location" name="event_location" required>

                <label for="event_description">Event Description:</label>
                <textarea id="event_description" name="event_description" required></textarea>

                <label for="event_task">Event Tasks:</label>
                <textarea id="event_task" name="event_task" required></textarea>

                <input type="submit" value="Add Event">
            </form>
        </div>
        </div>
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
                echo "<button class='delete-button' onclick='deleteEvent(" . $row['event_id'] . ")'>Delete Event</button>";
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


<script>
    
    function deleteEvent(eventId) {
        var confirmDelete = confirm("Are you sure you want to delete this event?");
        if (confirmDelete) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    location.reload();
                }
            };
            xmlhttp.open("GET", "delete_event.php?event_id=" + eventId, true);
            xmlhttp.send();
        }
    }

    var isAddEventFormVisible = false;

    function openAddEventForm() {
        var addEventModal = document.getElementById('addEventModal');
        isAddEventFormVisible = !isAddEventFormVisible;

        if (isAddEventFormVisible) {
            addEventModal.style.display = 'block';
        } else {
            addEventModal.style.display = 'none';
                }
        }

    function closeAddEventForm() {
        var addEventModal = document.getElementById('addEventModal');
        addEventModal.style.display = 'none';
        isAddEventFormVisible = false;
        }

    function submitEventForm(event) {
    event.preventDefault();

    // Get form data
    var formData = {
        event_name: document.getElementById('event_name').value,
        event_date: document.getElementById('event_date').value,
        event_location: document.getElementById('event_location').value,
        event_description: document.getElementById('event_description').value,
        event_task:document.getElementById('event_task').value
    };

    // Send AJAX request
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                alert(response.message);

                if (response.success) {
                    closeAddEventForm();
                    location.reload(); // Reload the page after adding the event
                }
            } else {
                alert("Error: " + this.status);
            }
        }
    };
    xmlhttp.open("POST", "save_event.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xmlhttp.send(JSON.stringify(formData));
}
</script>

</body>
</html>