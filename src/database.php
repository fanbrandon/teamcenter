<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$con){
	echo 'Connection Error: ' . mysqli_connect_error();
}
