<?php
$con = mysqli_connect('localhost', 'root', '', 'e-gaming');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['user_id'])) {
    $username = mysqli_real_escape_string($con, $_GET['user_id']);
    $sql = "DELETE FROM user WHERE username = '$username'";

    if (mysqli_query($con, $sql)) {
        header("Location: admin-home.php?message=User banned successfully");
        exit();
    }
    else {
        echo "Error deleting user: " . mysqli_error($con);
    }
}
else {
    echo "Invalid request: No user specified.";
}

mysqli_close($con);
?>