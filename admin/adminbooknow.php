<?php
require '../config/db.php';
$mysqli = db_connect();

if (isset($_POST['date']) && isset($_POST['time']) && isset($_POST['categorycode']) && isset($_POST['usercode'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $categorycode = $_POST['categorycode'];
    $usercode = $_POST['usercode'];
    $controlcode = "";
    $schedulecode = getScheduleByRange($mysqli, $time);
    $categoryname = CATEGORYNAME($mysqli, $categorycode);
    $categorydesc = CATEGORYDESC($mysqli, $categorycode);

    // Check if still available
    $stmt = $mysqli->prepare("SELECT * FROM tbl_venuelists WHERE CATEGORYCODE = ? AND VENUEDATE = ? AND SCHEDULECODE = ?");
    $stmt->bind_param("sss", $categorycode, $date, $schedulecode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 0) {
        $row = $result->fetch_assoc();
        // if ($row['status'] == 'available') {
        //     $update = $mysqli->prepare("UPDATE bookings SET status='booked' WHERE booking_date=? AND booking_time=?");
        //     $update->bind_param("ss", $date, $time);
        //     $update->execute();
        //     echo "<p style='color:green;'>✅ Booked successfully for $date at $time</p>";
        // } else {
        //     echo "<p style='color:red;'>❌ Slot already booked!</p>";
        // }

        $stmt = $mysqli->prepare("INSERT INTO tbl_venuelists (USERCODE, CONTROLCODE, CATEGORYCODE, SCHEDULECODE, CATEGORYNAME, CATEGORYDESCRIPTION, VENUEDATE, VENUETIME) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $usercode, $controlcode, $categorycode, $schedulecode, $categoryname, $categorydesc, $date, $time);

        if ($stmt->execute()) {
            echo "Booked successfully saved";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo "<p style='color:red;'>Invalid Slot!</p>";
    }
}

function getScheduleByRange($mysqli, $time) {
    list($start, $end) = explode(" - ", $time);

    // Convert to 24-hour time (MySQL TIME format)
    $checkin  = date("H:i", strtotime($start)); // 13:00:00
    $checkout = date("H:i", strtotime($end));   // 15:00:00

    // Prepare query
    $stmt = $mysqli->prepare("
        SELECT SCHEDULECODE, CHECKIN, CHECKOUT,
               CONCAT(DATE_FORMAT(CHECKIN, '%h:%i %p'), ' - ', DATE_FORMAT(CHECKOUT, '%h:%i %p')) AS time_range
        FROM tbl_schedule WHERE CHECKIN = ? AND CHECKOUT = ? ");
    $stmt->bind_param("ss", $checkin, $checkout);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        return $row['SCHEDULECODE'];
    }
}

function CATEGORYNAME($mysqli, $categorycode) {

    // Prepare query
    $stmt = $mysqli->prepare("SELECT * FROM tbl_category WHERE CATEGORYCODE = ? ");
    $stmt->bind_param("s", $categorycode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        return $row['CATEGORYNAME'];
    }
}

function CATEGORYDESC($mysqli, $categorycode) {

    // Prepare query
    $stmt = $mysqli->prepare("SELECT * FROM tbl_category WHERE CATEGORYCODE = ? ");
    $stmt->bind_param("s", $categorycode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        return $row['DESCRIPTION'];
    }
}
