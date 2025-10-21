<?php
	include('../config/database.php');

	if (isset($_POST['deleteuserid'])) {
		$deleteuserid = $_POST['deleteuserid'];
		$deleteusercode = $_POST['deleteusercode'];

		// $sqlcheckaccount = mysqli_query($conn,"SELECT * FROM tbl_parcels INNER JOIN tbl_track ON tbl_parcels.TRACKINGNUM = tbl_track.TRACKINGNUM WHERE USERCODE = '".$deleteusercode."'");
  //       if (mysqli_num_rows($sqlcheckaccount) > 0) {
  //           $infocheckaccount = mysqli_fetch_array($sqlcheckaccount);                               
  //       }
  //       else{
  //       	$req_query = "DELETE FROM tbl_users WHERE ID ='$deleteuserid'";
		// 	$req_query_run = mysqli_query($conn, $req_query);
  //       }

		$req_query = "DELETE FROM tbl_users WHERE ID ='$deleteuserid'";
		$req_query_run = mysqli_query($conn, $req_query);
		mysqli_close($conn);
		header('Location: ../index.php?page=users&a=adminuser');
		exit;
	}
	elseif (isset($_POST['deletescheduleid'])) {
		$deletescheduleid = $_POST['deletescheduleid'];

		$req_query = "DELETE FROM tbl_venuelists WHERE VENUEID ='$deletescheduleid'";
		$req_query_run = mysqli_query($conn, $req_query);
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
		mysqli_close($conn);
		header('Location: ' . $redirect);
		exit;
	}
	elseif (isset($_POST['deletecategorycode'])) {
		$deletecategorycode = $_POST['deletecategorycode'];

		$req_query = "DELETE FROM tbl_category WHERE CATEGORYCODE ='$deletecategorycode'";
		$req_query_run = mysqli_query($conn, $req_query);
		mysqli_close($conn);
		header('Location: ../index.php?page=category&a=admincategory');
		exit;
	}
	elseif (isset($_POST['deleteformid'])) {
		$deleteformid = intval($_POST['deleteformid']);

		$req_query = "DELETE FROM tbl_forms WHERE ID ='$deleteformid'";
		$req_query_run = mysqli_query($conn, $req_query);
		mysqli_close($conn);
		header('Location: ../index.php?page=forms&a=adminforms');
		exit;
	}
	elseif (isset($_POST['deletedepartmentcode'])) {
		$deletedepartmentcode = $_POST['deletedepartmentcode'];

		$req_query = "DELETE FROM tbl_department WHERE DEPARTMENTCODE ='$deletedepartmentcode'";
		$req_query_run = mysqli_query($conn, $req_query);
		mysqli_close($conn);
		header('Location: ../index.php?page=department&a=admindepartment');
		exit;
	}
	elseif (isset($_POST['deleteschedulecode'])) {
		$deleteschedulecode = $_POST['deleteschedulecode'];

		$req_query = "DELETE FROM tbl_schedule WHERE SCHEDULECODE ='$deleteschedulecode'";
		$req_query_run = mysqli_query($conn, $req_query);
		mysqli_close($conn);
		header('Location: ../index.php?page=schedule&a=adminschedule');
		exit;
	}
	elseif (isset($_POST['deleteholidaycode'])) {
		$deleteholidaycode = $_POST['deleteholidaycode'];

		$req_query = "DELETE FROM tbl_holiday WHERE HOLIDAYCODE ='$deleteholidaycode'";
		$req_query_run = mysqli_query($conn, $req_query);
		mysqli_close($conn);
		header('Location: ../index.php?page=holiday&a=adminholiday');
		exit;
	}
	elseif (isset($_POST['deletequestionid'])) {
		$deletequestionid = intval($_POST['deletequestionid']);

		$req_query = "DELETE FROM questions WHERE id ='$deletequestionid'";
		$req_query_run = mysqli_query($conn, $req_query);
		mysqli_close($conn);
		header('Location: ../index.php?page=feedback&a=adminfeedback');
		exit;
	}

mysqli_close($conn);
?>