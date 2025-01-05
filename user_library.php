<?php
session_start();

$host = 'localhost';
$dbname = 'e-gaming';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

$stmt = $pdo->prepare("SELECT user_id FROM user WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
    die("User not found. Please log in again.");
}

$user_id = $user['user_id'];

$query = "SELECT g.title AS game_name FROM user_library ul JOIN game g ON ul.game_id = g.game_id WHERE ul.user_id = :user_id";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            color: #444;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #f8f8f8;
            margin: 8px 0;
            padding: 10px;
            border-radius: 5px;
        }

        li:hover {
            background: #e8e8e8;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($username); ?>'s Game Library</h1>

        <?php if (count($games) > 0): ?>
            <ul id="gameList">
                <?php foreach ($games as $game): ?>
                    <li>
                        <?php echo htmlspecialchars($game['game_name']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>You don't own any games yet.</p>
        <?php endif; ?>

        <p><a href="index.html">Logout</a></p>
    </div>
</body>
</html>
