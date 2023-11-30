<?php
session_start();
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Assuming you have a table named 'events' with a column 'event_id'
    $event_id = $_GET['event_id'];

    // Perform the deletion
    $delete_user_events_query = "DELETE FROM user_events WHERE event_id = $event_id";
$result_user_events = mysqli_query($con, $delete_user_events_query);

if ($result_user_events) {
    // Now, proceed with deleting the event
    $delete_event_query = "DELETE FROM events WHERE event_id = $event_id";
    $result_event = mysqli_query($con, $delete_event_query);

    if ($result_event) {
        echo "Event deleted successfully!";
    } else {
        echo "Error deleting event: " . mysqli_error($con);
    }
} else {
    echo "Error deleting associated records: " . mysqli_error($con);
}
}
?>