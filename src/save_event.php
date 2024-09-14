<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $event_name = mysqli_real_escape_string($con, $data['event_name']);
    $event_date = mysqli_real_escape_string($con, $data['event_date']);
    $event_location = mysqli_real_escape_string($con, $data['event_location']);
    $event_description = mysqli_real_escape_string($con, $data['event_description']);
    $event_task = mysqli_real_escape_string($con, $data['event_task']);

    // Insert into the 'events' table
    $insert_query = "INSERT INTO events (event_name, event_date, event_location, event_description, event_task) 
                     VALUES ('$event_name', '$event_date', '$event_location', '$event_description', '$event_task')";

    if (mysqli_query($con, $insert_query)) {
        echo json_encode(array('success' => true, 'message' => 'Event added successfully!'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error: ' . mysqli_error($con)));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request'));
}
?>