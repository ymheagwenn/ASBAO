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

<div class="main-panel">
    <div class="content-wrapper" style="background-color: #D6F6D5;">
        <div class="row">
            <?php

                include 'config/database.php';

                // Initialize current user
                $usercode = isset($_SESSION['USERCODE']) ? $_SESSION['USERCODE'] : '';

                // Gate: only allow if there is at least one completed appointment pending feedback
                $hasPending = false;
                $chk = $conn->query("SELECT 1 FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.USERCODE = '$usercode' AND FEEDBACK = 'NOT RATED' AND tbl_appointment.STATUS = 'COMPLETED' LIMIT 1");
                if ($chk && $chk->num_rows > 0) { $hasPending = true; }
                if (!$hasPending) {
                    echo '<div class="col-12 text-center"><br><p>No completed reservations require feedback at this time.</p><a href="index.php?page=home&a=userdashboard" class="btn btn-success">Go to Dashboard</a><br><br></div>';
                    exit();
                }

                // Current question
                $qid = isset($_GET['qid']) ? intval($_GET['qid']) : 1;

                // Save feedback
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $question_id = intval($_POST['question_id']);
                    $rating = intval($_POST['rating']);

                    $conn->query("INSERT INTO question_feedback (usercode, question_id, rating)
                                  VALUES ('$usercode','$question_id', '$rating')");

                    // Move to next question
                    $next_qid = $question_id + 1;

                    ?>
                        <script type="text/javascript">
                            window.location = "index.php?page=home&a=userfeedback&qid=<?= $next_qid ?>";
                            exit();
                        </script>
                    <?php
                }

                // Fetch all questions for left column list
                $questions = [];
                $rsQ = $conn->query("SELECT id, question_text FROM questions ORDER BY id ASC");
                if ($rsQ) {
                    while ($q = $rsQ->fetch_assoc()) { $questions[] = $q; }
                }

                // Fetch question
                $result = $conn->query("SELECT * FROM questions WHERE id=$qid");
                $question = $result->fetch_assoc();

                if (!$question) {
                    $sql = mysqli_query($conn,"SELECT tbl_appointment.CONTROLCODE AS CCODE FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_appointment.CONTROLCODE IN (SELECT CONTROLCODE FROM tbl_appointment WHERE FEEDBACK='NOT RATED') AND tbl_venuelists.USERCODE = '$usercode' GROUP BY tbl_appointment.CONTROLCODE");
                    if (mysqli_num_rows($sql) > 0) {
                          $info = mysqli_fetch_array($sql);
                          
                          $cc = $info['CCODE'];

                          $sql = "UPDATE tbl_appointment SET FEEDBACK='RATED' WHERE CONTROLCODE = '$cc'";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }

                          $sql = "UPDATE question_feedback SET appointid='$cc', status = '1' WHERE status = 0 AND usercode = '$usercode'";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }
                    }

                    echo '<div class="col-12 text-center"><br><p>You have completed all questions. Thank you!</p><a href="index.php?page=home&a=userdashboard" class="btn btn-success">Go to Dashboard</a><br><br></div>';
                    exit();
                }

                // Average rating
                $result2 = $conn->query("SELECT AVG(rating) AS avg_rating FROM question_feedback WHERE question_id=$qid");
                $row = $result2->fetch_assoc();
                $avg_rating = round($row['avg_rating'], 1);
            ?>

            <h2 class="text-center">Question #<?= $qid ?></h2>
            <h3 class="text-center"><br><?= htmlspecialchars($question['question_text']) ?></h3>
            <p class="text-center">Average Rating: ⭐ <?= $avg_rating ?: 'No ratings yet'; ?></p>

            <form method="POST" class="text-center">
                <input type="hidden" name="question_id" value="<?= $qid ?>">

                <div class="star-rating text-center">
                    <input type="radio" id="5-stars" name="rating" value="5" required><label for="5-stars">★</label>
                    <input type="radio" id="4-stars" name="rating" value="4"><label for="4-stars">★</label>
                    <input type="radio" id="3-stars" name="rating" value="3"><label for="3-stars">★</label>
                    <input type="radio" id="2-stars" name="rating" value="2"><label for="2-stars">★</label>
                    <input type="radio" id="1-star" name="rating" value="1"><label for="1-star">★</label>
                </div>
                <br><br>
                <button type="submit" class="btn btn-success btn-block">Submit & Next</button>
            </form>
        </div>
    </div>