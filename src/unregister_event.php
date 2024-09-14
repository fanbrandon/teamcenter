<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $event_id = $_GET['event_id'];
    $user_id = $user_data['user_id'];

    // Check if the user is registered for the event
    if (isUserRegistered($con, $user_id, $event_id)) {
        // Unregister the user from the event
        $query = "DELETE FROM user_events WHERE user_id = '$user_id' AND event_id = '$event_id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "Successfully unregistered from the event.";
        } else {
            echo "Error unregistering from the event.";
        }
    } else {
        echo "You are not registered for this event.";
    }
} else {
    echo "Invalid request method.";
}
?>