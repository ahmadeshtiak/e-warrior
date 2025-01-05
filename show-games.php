<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color:rgb(195, 219, 236);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            flex: 1;
            padding: 20px;
        }

        .admin-action {
            margin-top: 30px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: white;
            padding: 20px;
        }

        .table {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <?php
    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, "e-gaming");

    $sql = "SELECT game_id, title, description, genre, price, rating FROM game";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $games = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $games[] = $row;
        }
    } else {
        echo "Error fetching games: " . mysqli_error($con);
    }

    mysqli_close($con);
    ?>

    <div class="container">
        <p class="text-center lead">Showing all the games.</p>
        <a href="backend/admin-home.php" class="">Go Back</a>
        <div class="row admin-action justify-content-center">
            <div class="col-md-10">
                <h4 class="mt-4">All Games</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Genre</th>
                                <th>Price</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($games) && !empty($games)) {
                                foreach ($games as $game) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . htmlspecialchars($game['game_id']) . "</th>";
                                    echo "<td>" . htmlspecialchars($game['title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($game['description']) . "</td>";
                                    echo "<td>" . htmlspecialchars($game['genre']) . "</td>";
                                    echo "<td>" . htmlspecialchars($game['price']) . "</td>";
                                    echo "<td>" . htmlspecialchars($game['rating']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No games found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <footer>
            <p>&copy; 2025 Admin Dashboard</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>