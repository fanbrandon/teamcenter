<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a form with input fields named 'about_me', 'experience', and 'accommodations'
    $about_me = mysqli_real_escape_string($con, $_POST['about_me']);
    $experience = mysqli_real_escape_string($con, $_POST['experience']);
    $accommodations = mysqli_real_escape_string($con, $_POST['accommodations']);

    $user_id = $_SESSION['user_id'];

    // Update or insert into the user_info table
    $update_query = "INSERT INTO user_info (user_id, about_me, experience, accommodations) VALUES ('$user_id', '$about_me', '$experience', '$accommodations') ON DUPLICATE KEY UPDATE about_me='$about_me', experience='$experience', accommodations='$accommodations'";
    mysqli_query($con, $update_query);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="profile.css" />
    <title>Profile</title>
    <script>
        function toggleForm() {
            var form = document.getElementById('editForm');
            form.style.display = (form.style.display === 'none') ? 'block' : 'none';
        }
    </script>
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
        <div class="container2">
          <h1>My Profile</h1> 
          <div class="profile">
            <?php
            // Devise the query
            $query = "SELECT users.firstname, users.lastname, users.email, user_info.about_me, user_info.experience, user_info.accommodations FROM users ";
            $query = $query . "LEFT OUTER JOIN user_info ON users.user_id = user_info.user_id ";
            $query = $query . "WHERE users.user_id = ";
            
            // Set the user context
            $datas = mysqli_query($con, $query . strval($_SESSION['user_id'])); 

            // Have a dictionary of display fields and column names
            $fieldcolumns = [
                "First Name:" => "firstname",
                "Last Name:" => "lastname", 
                "Email Address:" => "email", 
            ];

            // Render as paragraphs
            foreach ($datas as $data) {
              foreach ($fieldcolumns as $field => $column) {
                  echo "<p style=\"font-size: 20px;\"><strong><span style=\"color: #C5B682;\">$field</span></strong> <span style=\"color: white;\">{$data[$column]}</span></p>";
              }
          
              // Display 'About Me'
              echo "<p style=\"font-size: 20px;\"><strong><span style=\"color: #C5B682;\">About Me</span></strong>: ";
              if ($data['about_me'] !== null) {
                  echo $data['about_me'];
              } else {
                  echo "No information available";
              }
              echo "</p>";
          
              // Display 'Experience'
              echo "<p style=\"font-size: 20px;\"><strong><span style=\"color: #C5B682;\">Experience</span></strong>: ";
              if ($data['experience'] !== null) {
                  echo $data['experience'];
              } else {
                  echo "No information available";
              }
              echo "</p>";
          
              // Display 'Accommodations'
              echo "<p style=\"font-size: 20px;\"><strong><span style=\"color: #C5B682;\">Accommodations</span></strong>: ";
              if ($data['accommodations'] !== null) {
                  echo $data['accommodations'];
              } else {
                  echo "No information available";
              }
              echo "</p>";
          }
          ?>
            <br>
            <!-- Form for updating information -->
            <button type="button" onclick="toggleForm()" id="editButton" class="action-button">Edit Profile</button>
            <form method="post" id="editForm" style="display:none;">
                <label for="about_me">About Me:</label>
                <textarea id="about_me" name="about_me"><?php echo $data['about_me']; ?></textarea><br><br>

                <label for="experience">Experience:</label>
                <textarea id="experience" name="experience"><?php echo $data['experience']; ?></textarea><br><br>

                <label for="accommodations">Accommodations:</label>
                <textarea id="accommodations" name="accommodations"><?php echo $data['accommodations']; ?></textarea><br><br>

                <input type="submit" value="Save Changes" id="saveButton" class="action-button">
            </form>

          </div>
        </div>
      </div>
    </div>
  </body>
</html>