<?php
require '../config/db.php';
$mysqli = db_connect();
$events = [];

// Booked slots
// $sql = "SELECT booking_date, booking_time FROM bookings WHERE status='booked'";
// $result = $mysqli->query($sql);
// while ($row = $result->fetch_assoc()) {
//     $events[] = [
//         'title' => "Booked " . date("H:i", strtotime($row['booking_time'])),
//         'start' => $row['booking_date'] . "T" . $row['booking_time'],
//         'color' => 'red'
//     ];
// }

// Holidays
$sql = "SELECT HOLIDAYDATE, REMARKS FROM tbl_holiday WHERE STATUS='Active'";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['REMARKS'],
        'start' => $row['HOLIDAYDATE'],
        'display' => 'background',   // highlight background
        'color' => '#fec45d'
    ];
}

// Already fully booked dates
// $fully = $mysqli->query("
//   SELECT VENUEDATE
//   FROM tbl_venuelists
//   GROUP BY VENUEDATE
//   HAVING SUM(AVAILABILITY='1') = 0
// ");

// while ($row = $fully->fetch_assoc()) {
//     $events[] = [
//         "title" => "Fully Booked",
//         "start" => $row['VENUEDATE'],
//         "color" => "#999999"
//     ];
// }

echo json_encode($events);