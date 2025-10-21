<?php
require '../config/db.php';
$mysqli = db_connect();

if (isset($_POST['date']) && isset($_POST['categorycode'])) {

    $date = $_POST['date'];
    $categorycode = $_POST['categorycode'];

	$ctrsched = 0;
    $ctrvenue = 0;
	    $stmt = $mysqli->prepare("SELECT * FROM tbl_schedule WHERE STATUS = 'Active'");
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		while($rows = $result->fetch_assoc()){
			$ctrsched = $ctrsched + 1;
		    $time = date("g:i A", strtotime($rows['CHECKIN']))." - ".date("g:i A", strtotime($rows['CHECKOUT']));
		    

		    $svenue = $mysqli->prepare("SELECT *, tbl_venuelists.SCHEDULECODE AS VS FROM tbl_venuelists WHERE VENUEDATE = ? AND CATEGORYCODE = ? AND SCHEDULECODE = ?");
		    $svenue->bind_param("sss", $date, $categorycode, $rows['SCHEDULECODE']);
		    $svenue->execute();
		    $rvenue = $svenue->get_result();

		    if ($rvenue->num_rows > 0) {
				$rowven = $rvenue->fetch_assoc();
				$ctrvenue = $ctrvenue + 1;
				echo "<div class='booked'><input type='radio' name='time' value='$time' disabled> $time - Booked</div>";
		    }
			else{
				echo "<div class='available'><input type='radio' name='time' value='$time' required> $time - Available</div>";
			}

			$svenue->close();
		}
	} else {
		echo "<p>No slots for this date.</p>";
	}

	if ($ctrsched == $ctrvenue) {
		echo "<br><div class='booked'>Fully Booked</div>";
	}


    $stmt->close();
}
?>