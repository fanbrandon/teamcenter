<?php
session_start();

include("database.php");
include("functions.php");

$error_message = ""; // Initialize an empty error message

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user_type = $_POST['user_type'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // store in the database
        $user_id = random_num(5);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $query = "INSERT into users (user_id, user_name, password, email, firstname, lastname, user_type) VALUES ('$user_id', '$user_name', '$hashed_password', '$email', '$firstname', '$lastname', '$user_type')";
        mysqli_query($con, $query);

        if ($user_type == 'user') {
            header("Location: StudentLogin.php");
            exit();
        } elseif ($user_type == 'admin') {
            header("Location: adminLogin.php");
            exit();
        } else {
            // Handle other user_types as needed
        }
    } else {
        $error_message = "Please fill out all forms.";
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
        <h2>Signup</h2>
        <form method="post">
            <div class="user-box">Username
                <input id="text" type="text" name="user_name"><br><br>
            </div>
			<div class="user-box">Password
                <input id="text" type="password" name="password"><br><br>
            </div>
            <div class="user-box">Email
                <input id="text" type="text" name="email"><br><br>
            </div>
			<div class="user-box">First Name
                <input id="text" type="text" name="firstname"><br><br>
            </div>
			<div class="user-box">Last Name
                <input id="text" type="text" name="lastname"><br><br>
            </div>
			<select id="user_type" name="user_type">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
            </select>

			<div class="button-container">
                <input id="button" type="submit" class="submit" value="Login">
            </div>
			
		</form>
        <div class="error-message">
            <?php echo $error_message; ?>
        </div>
	</div>	
</body>
</html>
