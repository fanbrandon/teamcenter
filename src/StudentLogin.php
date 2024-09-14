<?php
session_start();

include("database.php");
include("functions.php");

$error_message = ""; // Initialize an empty error message

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Read from the database
        $query = "SELECT * FROM users WHERE user_name = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $user_name);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    $_SESSION['user_type'] = $user_data['user_type'];

                    // Redirect based on user_type
                    if ($_SESSION['user_type'] == 'user') {
                        header("Location: user_home.php");
                        exit();
                    } elseif ($_SESSION['user_type'] == 'admin') {
                        $error_message = "Incorrect user type. Please log in as admin";
                    } else {
                        // Handle other user_types as needed
                    }
                } else {
                    $error_message = "Incorrect password. Please try again.";
                }
            } else {
                $error_message = "User not found. Please check your username.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $error_message = "Error querying the database.";
        }
    } else {
        $error_message = "Invalid username or password format.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="style2.css" />
	<title>Login</title>
</head>
<body>
    <div class="login-box">
	<a href="index.php">
        <img src="images/Primary_Vertical_1_Color_Green.png" class="logo" alt="Logo">
    </a>
        <h2>Login</h2>
        <form method="post">
            <div class="user-box">Username
                <input id="text" type="text" name="user_name"><br><br>
            </div>
			<div class="user-box">Password
                <input id="text" type="password" name="password"><br><br>
            </div>

			<div class="button-container">
                <input id="button" type="submit" class="submit" value="Login">
                <a href="signUp.php" class="signup-link">Signup</a>
            </div>
			<div class="error-message">
                <?php echo $error_message; ?>
            </div>
			
		</form>
	</div>	
</body>
</html>