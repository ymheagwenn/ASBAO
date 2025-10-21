<?php
function db_connect() {
    $mysqli = new mysqli("localhost", "root", "", "db_asbao");
    if ($mysqli->connect_errno) {
        die("Failed to connect: " . $mysqli->connect_error);
    }
    return $mysqli;
}
?>
