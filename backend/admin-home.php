<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            /* Use a better font */
            background-color: #f4f4f4;
            /* Light background */
            display: flex;
            /* Enable flexbox for full height */
            flex-direction: column;
            /* Stack content vertically */
            min-height: 100vh;
            /* Ensure full viewport height */
            margin: 0;
            /* Remove default body margins */
        }

        .container {
            flex: 1;
            /* Allow container to take up available space */
            padding: 20px;
        }

        .admin-action {
            margin-top: 30px;
            /* Increased top margin */
            margin-bottom: 30px;
            /* Increased bottom margin */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: white;
            padding: 20px;
        }

        .admin-action h3,
        .admin-action h4 {
            margin-bottom: 20px;
            color: #333;
        }

        .admin-action a {
            margin: 5px 10px;
            /* Add horizontal spacing */
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
            /* Push footer to bottom */
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>


<body>
    <?php
    $con = mysqli_connect('localhost', 'root');
    mysqli_select_db($con, "e-gaming");

    $sql = "SELECT username, email, balance, points, xp FROM user";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $users = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    } else {
        echo "Error fetching users: " . mysqli_error($con);
    }

    mysqli_close($con);
    ?>


    <div class="container">
        <h1 class="text-center mt-5">Welcome, Admin!</h1>
        <p class="text-center lead">Manage users and games from this dashboard.</p>

        <div class="row admin-action justify-content-center">
            <div class="col-md-10">
                <h3>User Management</h3>
                <div class="text-center">
                    <a href="../register.html" class="btn btn-success"><i class="fas fa-user-plus"></i> Add User</a>
                    <a href="#" class="btn btn-danger"><i class="fas fa-user-slash"></i> Ban User</a>
                </div>
                <h4 class="mt-4">All Users</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Points</th>
                                <th scope="col">XP</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($users) && !empty($users)) {
                                foreach ($users as $user) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . htmlspecialchars($user['username']) . "</th>";
                                    echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['balance']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['points']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['xp']) . "</td>";
                                    echo "<td class='text-center'>";
                                    echo "<a href='ban-user.php?user_id=" . urlencode($user['username']) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to ban " . htmlspecialchars($user['username']) . "?\");'>";
                                    echo "<i class='fas fa-user-slash'></i> Ban User";
                                    echo "</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } 
                            else {
                                echo "<tr><td colspan='6' class='text-center'>No users found.</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="row admin-action justify-content-center">
            <div class="col-md-10">
                <h3>Game Management</h3>
                <div class="text-center">
                    <a href="../add-game.html" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Game</a>
                    <a href="../show-games.php" class="btn btn-info"><i class="fas fa-chart-line"></i> Show Games</a>
                    <a href="remove-game.php" class="btn btn-warning"><i class="fas fa-minus-circle"></i> Remove Game</a>
                </div>
            </div>
        </div>

        <div class="row admin-action justify-content-center">
            <div class="col-md-10">
                <h3>Other Actions</h3>
                <div class="text-center">
                    <a href="../index.html" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Admin Dashboard</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>