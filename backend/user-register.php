<?php
$con = mysqli_connect('localhost','root');
mysqli_select_db($con,"e-gaming");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];

$query = "INSERT INTO `user`(`username`, `email`, `password`, `balance`, `points`, `xp`) VALUES ('$user','$email','$pass',0,0,0)";
$result = mysqli_query($con, $query);
header("Location: ../login.html");
exit();

?>