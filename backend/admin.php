<?php
$con = mysqli_connect('localhost','root');
mysqli_select_db($con,"e-gaming");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? 'No Username Provided';
    $pass = $_POST['password'] ?? 'No Username Provided';

    $user = $con->real_escape_string($user);
    $pass = $con->real_escape_string($pass);

    $sql = "SELECT * FROM admin WHERE username = '$user' AND password = '$pass'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        $_SESSION['username'] = $user;
        header("Location: admin-home.php"); 
        exit();
    } else {

        echo "Invalid username or password.";
    }

}


?>