<?php
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

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $game_id = intval($_POST['game_id']);

    $stmt = $pdo->prepare("SELECT username FROM user WHERE user_id = ?"); // Only select username
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        $message = "User not found.";
    } else {
        $stmt = $pdo->prepare("SELECT title FROM game WHERE game_id = ?"); // Only select title
        $stmt->execute([$game_id]);
        $game = $stmt->fetch();

        if (!$game) {
            $message = "Game not found.";
        } else {
            $stmt = $pdo->prepare("SELECT 1 FROM user_library WHERE user_id = ? AND game_id = ?");
            $stmt->execute([$user_id, $game_id]);
            if ($stmt->fetch()) {
                $message = "You already own this game.";
            } else {
                try {
                    $stmt = $pdo->prepare("INSERT INTO user_library (user_id, game_id) VALUES (?, ?)");
                    $stmt->execute([$user_id, $game_id]);
                    $message = "Purchase successful! User <strong>" . htmlspecialchars($user['username']) . "</strong> successfully purchased the game <strong>" . htmlspecialchars($game['title']) . "</strong>.";

                } catch (PDOException $e) {
                    if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
                        $message = "You already own this game.";
                    } else {
                        $message = "An error occurred during purchase: " . $e->getMessage();
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Purchase</title>
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
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"],
        button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .message {
            margin: 15px 0;
            font-weight: bold;
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Purchase a Game</h1>
        <form id="purchaseForm" method="POST" action="">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" id="user_id" min="1" required>

            <label for="game_id">Game ID:</label>
            <input type="number" name="game_id" id="game_id" min="1" required>

            <button type="submit">Purchase</button>
        </form>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>

    <script>
        document.getElementById('purchaseForm').addEventListener('submit', function (event) {
            const userId = document.getElementById('user_id').value.trim();
            const gameId = document.getElementById('game_id').value.trim();
            const dataValue = document.getElementById('data_value').value.trim();

            if (!userId || !gameId || !dataValue) {
                event.preventDefault();
                alert('All fields are required. Please fill them in.');
            }
        });
    </script>
</body>
</html>
