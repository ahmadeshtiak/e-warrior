<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Warrior - Leaderboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Add the CSS styles from your original HTML file */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .site-logo img {
            height: 40px;
        }

        .header-menu ul {
            display: flex;
            list-style-type: none;
        }

        .header-menu li {
            margin: 0 15px;
        }

        .header-menu a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
        }

        .header-menu a:hover {
            color: #f1c40f;
        }

        .leaderboard {
            padding: 40px 0;
            background-color: #fff;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            color: #333;
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .leaderboard-table th, .leaderboard-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .leaderboard-table th {
            background-color: #333;
            color: #fff;
            font-weight: 700;
        }

        .leaderboard-table tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        .leaderboard-table tr:hover {
            background-color: #f1c40f;
            cursor: pointer;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header-menu {
                display: none;
                width: 100%;
                text-align: center;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: #333;
            }

            .header-menu.active {
                display: block;
            }

            .header-menu li {
                margin: 10px 0;
            }

            .nav-switch {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <a href="index.html" class="site-btn btn-sm">Go Back</a>
        <div class="container">
            <a href="index.html" class="site-logo">
                <img src="img/logo.png" alt="">
            </a>
            <nav class="header-menu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="review.html">Games</a></li>
                    <li><a href="categories.html">Blog</a></li>
                    <li><a href="community.html">Forums</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Leaderboard Section -->
    <main class="leaderboard">
        <div class="container">
            <h1 class="section-title">Leaderboard</h1>
            <table class="leaderboard-table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Player</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "e-gaming";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("<tr><td colspan='3'>Connection failed: " . $conn->connect_error . "</td></tr>");
    }

    
    $sql = "SELECT DENSE_RANK() OVER (ORDER BY rating DESC) AS rank, title, rating FROM game";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['rank']) . "</td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['rating']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No players found.</td></tr>";
    }

    $conn->close();
    ?>
</tbody>

            </table>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Game Warrior. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const navSwitch = document.querySelector('.nav-switch');
        const headerMenu = document.querySelector('.header-menu');

        navSwitch?.addEventListener('click', () => {
            headerMenu.classList.toggle('active');
        });
    </script>
</body>
</html>
