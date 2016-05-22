<?php
session_start(); // Starting Session
include_once('koneksi.php');
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username atau Password salah";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=md5($_POST['password']);

// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from admin where password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: admin.php"); // Redirecting To Other Page
} else {
$error = "Username atau Password salah";
}
mysql_close($connection); // Closing Connection
}
}
?>