<?php 
	session_start();
	require 'config/database.php';
    require 'config/function.php';

	if(isset($_POST['a'])){
		$a = $_POST['a'];
	}
	elseif(isset($_GET['a'])){
		$a = $_GET['a'];
	}else{
		$a = 'index';
	}
	
	if($a == 'index'){
		include 'main.php';
	}
	elseif($a == 'login'){
		include 'login.php';
	}
	elseif($a == 'register'){
		include 'register.php';
	}
	elseif($a == 'forgotpassword'){
		include 'forgotpassword.php';
	}
	elseif($a == 'usermain'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/usermain.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userfeedback'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userfeedback.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userdashboard'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userdashboard.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userappointmentdate'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userappointmentdate.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userprofilepicture'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userprofilepicture.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userchangepass'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userchangepass.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'usereditprofile'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/usereditprofile.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userforms'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userforms.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userappointmentadd'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userappointmentadd.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userappointmentedit'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userappointmentedit.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'userappointmentreceipt'){
		include 'user/userappointmentreceipt.php';
	}
	elseif($a == 'userhistory'){
		include 'user/userheader.php';
		include 'user/usertopbar.php';
		include 'user/usernavbar.php';
		include 'user/userhistory.php';
		include 'user/userfooter.php';
	}
	elseif($a == 'adminmain'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminmain.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminprofile'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminprofile.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminprofilepicture'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminprofilepicture.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'admindashboard'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admindashboard.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminappointmentdate'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminappointmentdate.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminappointment'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminappointment.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminappointmentadd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminappointmentadd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminappointmentedit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminappointmentedit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminappointmentview'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminappointmentview.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminappointmentscan'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminappointmentscan.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminappointmentreceipt'){
		include 'admin/adminappointmentreceipt.php';
	}
	elseif($a == 'admincategory'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admincategory.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'admincategoryadd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admincategoryadd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'admincategoryedit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admincategoryedit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'admincategoryupload'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admincategoryupload.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminforms'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminforms.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminformsadd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminformsadd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminformsedit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminformsedit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'admindepartment'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admindepartment.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'admindepartmentadd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admindepartmentadd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'admindepartmentedit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/admindepartmentedit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminschedule'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminschedule.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminscheduleadd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminscheduleadd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminscheduleedit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminscheduleedit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminholiday'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminholiday.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminholidayadd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminholidayadd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminholidayedit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminholidayedit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminfeedback'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminfeedback.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminfeedbackadd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminfeedbackadd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminfeedbackedit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminfeedbackedit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminfeedbackreport'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminfeedbackreport.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminuser'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminuser.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminuseradd'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminuseradd.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminuseredit'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminuseredit.php';
		include 'admin/adminfooter.php';
	}
	elseif($a == 'adminreport'){
		include 'admin/adminheader.php';
		include 'admin/admintopbar.php';
		include 'admin/adminnavbar.php';
		include 'admin/adminreport.php';
		include 'admin/adminfooter.php';
	}

	mysqli_close($conn);
?>