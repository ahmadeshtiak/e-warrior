<?php
$con = mysqli_connect('localhost','root');
mysqli_select_db($con,"e-gaming");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }

$title = $_POST['title'];
$des = $_POST['description'];
$genre = $_POST['genre'];
$price = $_POST['price'];
$rating = $_POST['rating'];

$query = "INSERT INTO `game`(`title`, `description`, `genre`, `price`, `rating`) VALUES ('$title','$des','$genre','$price','$rating')";
$result = mysqli_query($con, $query);
header("Location: ../add-game.html");
exit();

?>