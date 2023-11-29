<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

date_default_timezone_set('US/Pacific');

if(isset($_POST["submit"])){
  
  $name = $user_data['firstname'];
  $comment = trim($_POST["comment"]); // Trim to remove leading and trailing whitespace, check if comment is empty
    if (empty($comment)) {
        $error_message="Cannot be empty";
    } else {
  $date = date('F d Y, h:i:s A');
  $reply_id = $_POST["reply_id"];
  $reply_name = $_POST["reply_name"];

  $query = "INSERT INTO questions (name, comment, date, reply_id, reply_name) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($con, $query);

  if ($stmt) {
      mysqli_stmt_bind_param($stmt, "sssss", $name, $comment, $date, $reply_id, $reply_name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      // Redirect to the same page after form submission to prevent resubmission
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit();
  } else {
      echo "Error in prepared statement: " . mysqli_error($con);
  }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="questions.css" />
    <title>Questions</title>
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
            <h1>Questions</h1>
        <?php
        $datas = mysqli_query($con, "SELECT * FROM questions WHERE reply_id = 0"); // only select comment and not select reply
        foreach($datas as $data) {
        require 'comment.php';
        }
        ?>
            <form action="" method="post">
                <h3 id="title">Ask a Question</h3>
                <input type="hidden" name="reply_id" id="reply_id">
                <input type="hidden" name="reply_name" id="reply_name">
    
                <!-- Wrap each input element in a div to stack them -->
                <div class="userName">
                    <p>Your name:</p>
                    <label for="name">
                    <?php
                    echo $user_data['firstname'];
                    ?>
                    </label>
                </div>
    
                <div class="userInput">
                    <label for="comment">Your question:</label>
                    <textarea name="comment" id="comment" placeholder="Your question"></textarea>
                </div>

                <div>
                    <button class="submit" type="submit" name="submit">Submit</button>
                    <button type="button" class="submit" onclick="cancelComment()">Cancel</button>
                </div>
            </form>
        </div>

        <script>
        function reply(id, name){
        title = document.getElementById('title');
        title.innerHTML = "Reply to " + name;
        document.getElementById('reply_id').value = id;
        document.getElementById('reply_name').value = name;
		    window.scrollTo(0,document.body.scrollHeight);
        }
        function cancelComment() {
        // Clear the textarea when "Cancel" is clicked
        document.getElementById('comment').value = '';
        title.innerHTML = "Ask a Question";
        document.getElementById('reply_id').value = "";
        document.getElementById('reply_name').value = "";
        document.getElementById('comment').value = "";
        }
        </script>
      </div>
    </div>
  </body>
</html>