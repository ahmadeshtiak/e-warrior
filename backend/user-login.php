<?php
session_start();

$con = mysqli_connect('localhost', 'root');
mysqli_select_db($con, "e-gaming");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $user = $con->real_escape_string($user);
    $pass = $con->real_escape_string($pass);

    $sql = "SELECT * FROM user WHERE username = '$user' AND password = '$pass'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        $_SESSION['username'] = $user;
        header("Location: ../home.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}


?>