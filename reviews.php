<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Gaming Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #121212;
            color: rgb(94, 94, 94);
        }
        h1, h2 {
            color: rgb(179, 107, 0);
            text-align: center;
        }
        h2 {
            margin-top: 30px;
        }
        p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #1e1e1e;
        }
        table, th, td {
            border: 1px solid #444;
        }
        th, td {
            padding: 15px;
            text-align: left;
            color: #ddd;
        }
        th {
            background-color: #333;
        }
        td {
            background-color: #222;
        }
        hr {
            border: 0;
            height: 1px;
            background-color: #444;
        }
        button {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #ff9800;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }
        button:hover {
            background-color: #e68a00;
        }
        form {
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 5px;
            width: 50%;
            color: #ddd;
        }
        form input, form textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #222;
            color: #ddd;
        }
        form input[type="submit"] {
            background-color: #ff9800;
            color: #fff;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #e68a00;
        }
    </style>
    <script>
        function filterReviews() {
            const searchKeyword = prompt("Enter a keyword to filter reviews:");
            const reviewSections = document.querySelectorAll(".review-section");

            reviewSections.forEach(section => {
                const comment = section.querySelector(".comment").textContent.toLowerCase();
                if (comment.includes(searchKeyword.toLowerCase())) {
                    section.style.display = "block";
                } else {
                    section.style.display = "none";
                }
            });
        }
    </script>
</head>
<body>
    <h1>e-Gaming Reviews</h1>
    <button onclick="filterReviews()">Filter Reviews</button>

    <!-- Add Review Form -->
    <form method="POST" action="">
        <h2>Add a Review</h2>
        <input type="text" name="game_id" placeholder="Game ID" required>
        <input type="text" name="user_id" placeholder="User ID" required>
        <textarea name="comment" rows="4" placeholder="Comment" required></textarea>
        <input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" required>
        <input type="date" name="review_date" required>
        <input type="submit" name="add_review" value="Add Review">
    </form>

    <!-- PHP for Adding/Removing Reviews -->
    <?php
    $servername = "localhost"; 
    $username = "root";        
    $password = "";            
    $dbname = "e-gaming";      

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['add_review'])) {
        $game_id = $_POST['game_id'];
        $user_id = $_POST['user_id'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $review_date = $_POST['review_date'];

        $addQuery = "INSERT INTO Reviews (game_id, user_id, comment, rating, review_date) VALUES ('$game_id', '$user_id', '$comment', '$rating', '$review_date')";
        if ($conn->query($addQuery) === TRUE) {
            echo "<p>Review added successfully!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }

    if (isset($_POST['remove_review'])) {
        $review_id = $_POST['review_id'];

        $removeQuery = "DELETE FROM Reviews WHERE rating_id='$review_id'";
        if ($conn->query($removeQuery) === TRUE) {
            echo "<p>Review removed successfully!</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }

    $reviewsQuery = "SELECT * FROM Reviews";
    $reviewsResult = $conn->query($reviewsQuery);

    if ($reviewsResult && $reviewsResult->num_rows > 0) {
        while ($review = $reviewsResult->fetch_assoc()) {
            $review_id = htmlspecialchars($review["rating_id"]);
            $game_id = htmlspecialchars($review["game_id"]);
            $user_id = htmlspecialchars($review["user_id"]);
            $comment = htmlspecialchars($review["comment"]);
            $rating = htmlspecialchars($review["rating"]);
            $review_date = htmlspecialchars($review["review_date"]);

            echo "<div class='review-section'>";
            echo "<h2>Review for Game ID: $game_id</h2>";
            echo "<p><strong>User ID:</strong> $user_id</p>";
            echo "<p class='comment'><strong>Comment:</strong> $comment</p>";
            echo "<p><strong>Rating:</strong> $rating / 5</p>";
            echo "<p><strong>Review Date:</strong> $review_date</p>";
            
            echo "<form method='POST' action='' style='display:inline-block;'>";
            echo "<input type='hidden' name='review_id' value='$review_id'>";
            echo "<input type='submit' name='remove_review' value='Remove Review' style='background-color:red; color:white; cursor:pointer;'>";
            echo "</form>";

            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews found in the database.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
