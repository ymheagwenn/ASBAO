<?php
require '../config/db.php';
$mysqli = db_connect();

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $stmt = $mysqli->prepare("SELECT HOLIDAYCODE FROM tbl_holiday WHERE HOLIDAYDATE = ?");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "holiday";
    } else {
        echo "ok";
    }
}
