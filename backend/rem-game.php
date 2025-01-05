<?php
$con = mysqli_connect('localhost', 'root', '', 'e-gaming');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['game_id'])) {
    $game_id = mysqli_real_escape_string($con, $_GET['game_id']);
    $sql = "DELETE FROM game WHERE game_id = '$game_id'";

    if (mysqli_query($con, $sql)) {
        header("Location: remove-game.php?message=Game removed successfully");
        exit();
    }
    else {
        echo "Error deleting user: " . mysqli_error($con);
    }
}
else {
    echo "Invalid request: No game specified.";
}

mysqli_close($con);
?>