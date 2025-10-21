<?php
// feedback.php
$conn = new mysqli("localhost", "root", "", "feedback_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save feedback
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = intval($_POST['question_id']);
    $rating = intval($_POST['rating']);
    $feedback = $conn->real_escape_string($_POST['feedback']);

    $sql = "INSERT INTO question_feedback (question_id, rating, feedback)
            VALUES ('$question_id', '$rating', '$feedback')";

    if ($conn->query($sql)) {
        echo "<script>alert('Thank you for your feedback!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Get average rating
$result = $conn->query("SELECT AVG(rating) as avg_rating FROM question_feedback WHERE question_id=1");
$row = $result->fetch_assoc();
$avg_rating = round($row['avg_rating'], 1);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Question Rating Feedback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <style>
        .star-rating input { display: none; }
        .star-rating label {
            font-size: 25px;
            color: gray;
            cursor: pointer;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
    </style>
</head>
<body class="container">
    <h2 class="text-center">Rate this Question</h2>
    <p><b>Question:</b> What is the capital of France?</p>
    <p>Average Rating: ⭐ <?= $avg_rating ?: 'No ratings yet'; ?></p>

    <form method="POST" class="form">
        <input type="hidden" name="question_id" value="1">

        <div class="star-rating text-center">
            <input type="radio" id="5-stars" name="rating" value="5"><label for="5-stars">★</label>
            <input type="radio" id="4-stars" name="rating" value="4"><label for="4-stars">★</label>
            <input type="radio" id="3-stars" name="rating" value="3"><label for="3-stars">★</label>
            <input type="radio" id="2-stars" name="rating" value="2"><label for="2-stars">★</label>
            <input type="radio" id="1-star" name="rating" value="1"><label for="1-star">★</label>
        </div>

        <div class="form-group">
            <label>Feedback:</label>
            <textarea name="feedback" class="form-control" rows="3" placeholder="Your feedback..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Submit Feedback</button>
    </form>
</body>
</html>
