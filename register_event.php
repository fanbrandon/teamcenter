<?php
session_start();
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Retrieve event_id from the GET parameters
        $event_id = $_GET['event_id'];
        
        // Retrieve user_id from the session
        $user_id = $_SESSION['user_id'];
        
        // Perform the registration (Assuming you have a 'user_events' table)
        $query = "INSERT INTO user_events (user_id, event_id) VALUES ('$user_id', '$event_id')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "Registration successful!";
        } else {
            echo "Registration failed. Please try again.";
        }
    } else {
        echo "User not logged in.";
    }
} else {
    echo "Invalid request method.";
}
?>