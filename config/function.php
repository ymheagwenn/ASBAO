<?php
    function TOTALAPPOINTMENTAPPROVED(){
        require 'database.php';

        date_default_timezone_set('Asia/Manila');
        $nowdate = date('Y-m-d');

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_appointment WHERE STATUS = 'ACCEPTED'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }

        return $result;
    }

    function TOTALAPPOINTMENTPENDING(){
        require 'database.php';

        date_default_timezone_set('Asia/Manila');
        $nowdate = date('Y-m-d');

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_appointment WHERE STATUS = 'PENDING'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }

        return $result;
    }

    function TOTALAPPOINTMENTCANCELLED(){
        require 'database.php';

        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d');
        $week = date('Y-m-d', strtotime('+7 days'));

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.VENUEDATE BETWEEN '$today' AND '$week' AND tbl_appointment.STATUS = 'CANCELLED'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }

        return $result;
    }

    function TOTALAPPOINTMENTCOMPLETED(){
        require 'database.php';

        date_default_timezone_set('Asia/Manila');
        $nowdate = date('Y-m-d');

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_appointment WHERE STATUS = 'COMPLETED'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }

        return $result;
    }


    function CHECKFEEDBACK($id){
        require 'database.php';

        date_default_timezone_set('Asia/Manila');
        $nowdate = date('Y-m-d');

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.USERCODE = '$id' AND FEEDBACK = 'NOT RATED' AND tbl_appointment.STATUS = 'COMPLETED' GROUP BY tbl_appointment.CONTROLCODE");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }
        else{
            $result = 0;
        }

        return $result;
    }

    function MAINSTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['ROLE'] ."   -   ".$info['STATUS'];
        }

        return $result;
    }

    function MAINFULLNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['LASTNAME'] .", ". $info['FIRSTNAME'] ."  ". $info['MIDDLENAME'];
        }

        return $result;
    }

    function ADMINAPPOINTMENTCHECK(){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_appointment.STATUS != 'COMPLETED' AND tbl_appointment.STATUS != 'CANCELLED' GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }
        else{
            $result = 0;
        }

        return $result;
    }

    function USERAPPOINTMENTCHECK($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.USERCODE = '$id' AND tbl_appointment.STATUS != 'COMPLETED' AND tbl_appointment.STATUS != 'CANCELLED' GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }
        else{
            $result = 0;
        }

        return $result;
    }

    function VENUELISTSCHECK($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_venuelists WHERE USERCODE = '$id' AND AVAILABILITY='0'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }

        return $result;
    }

    function VENUELISTSCONTROLCODE($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT COUNT(*) AS TOTAL FROM tbl_venuelists WHERE CONTROLCODE = '$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['TOTAL'];
        }

        return $result;
    }

    function APPOINTFIRST($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['FIRSTNAME'];
        }

        return $result;
    }

    function APPOINTMIDDLE($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['MIDDLENAME'];
        }

        return $result;
    }

    function APPOINTLAST($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['LASTNAME'];
        }

        return $result;
    }

    function APPOINTCONTACT($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['CONTACT'];
        }

        return $result;
    }

    function APPOINTEMAIL($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['EMAIL'];
        }

        return $result;
    }

    function APPOINTADDRESS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['ADDRESS'];
        }

        return $result;
    }

    function APPOINTREMARK($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['REMARKS'];
        }

        return $result;
    }

    function APOINTSTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['STATUS'];
        }

        return $result;
    }

    function APPOINTMENTDESCRIPTION($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment WHERE ID ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['REMARKS'];
        }

        return $result;
    }

    function USERFIRSTNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['FIRSTNAME'];
        }

        return $result;
    }

    function USERMIDDLENAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['MIDDLENAME'];
        }

        return $result;
    }

    function USERLASTNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['LASTNAME'];
        }

        return $result;
    }

    function USERGENDER($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['GENDER'];
        }

        return $result;
    }

    function USERCONTACT($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['CONTACT'];
        }

        return $result;
    }

    function USERADDRESS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['ADDRESS'];
        }

        return $result;
    }

    function USERDEPARTMENT($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['DEPARTMENTCODE'];
        }

        return $result;
    }

    function USERDEPARTMENTNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['DEPARTMENT'];
        }

        return $result;
    }

    function USERROLE($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['ROLE'];
        }

        return $result;
    }

    function USEREMAIL($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['EMAIL'];
        }

        return $result;
    }

    function USERPASS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['PASSWORD'];
        }

        return $result;
    }

    function USERSTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['STATUS'];
        }

        return $result;
    }

    function USERPICTURE($id){
        require 'database.php';
        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);

            if (trim($info['PROFILE']) == 'No Image') {
                $result = "There was no image set";
            }
            else{
                $result = "Image has been changed";
            }
        }

        return $result;
    }

    function PROFILEPATH($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_users WHERE USERCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            
            if ($info['PROFILE'] == 'No Image') {
                $result = 'assets/images/icons/profile_128.png';
            }
            else{
                $result = $info['PROFILE'];
            }
        }

        return $result;
    }

    function CATEGORYVENUE($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['CATEGORYVENUE'];
        }

        return $result;
    }


    function CATEGORYNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['CATEGORYNAME'];
        }

        return $result;
    }

    function CATEGORYDESCRIPTION($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['DESCRIPTION'];
        }

        return $result;
    }

    function CATEGORYSTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['STATUS'];
        }

        return $result;
    }

    function CATEGORYPATH($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            
            if (empty(trim($info['PHOTOS']))) {
                $result = 'models/img/unavailable.jpg';
            }
            else{
                $result = $info['PHOTOS'];
            }
        }

        return $result;
    }

    function VENUEDATE($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_venuelists WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['VENUEDATE'];
        }
    }

    function VENUETIMEIN($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_venuelists WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['VENUETIMEIN'];
        }
    }

    function VENUETIMEOUT($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_venuelists WHERE CATEGORYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['VENUETIMEOUT'];
        }

        return $result;
    }

    function QUESTIONNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM questions WHERE id ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['question_text'];
        }

        return $result;
    }

    function FORMNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_forms WHERE ID ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['FILENAME'];
        }

        return $result;
    }

    function FORMSTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_forms WHERE ID ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['STATUS'];
        }

        return $result;
    }

    function DEPARTMENTNAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_department WHERE DEPARTMENTCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['DEPARTMENTNAME'];
        }

        return $result;
    }

    function DEPARTMENTDESC($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_department WHERE DEPARTMENTCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['DESCRIPTION'];
        }

        return $result;
    }

    function DEPARTMENTSTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_department WHERE DEPARTMENTCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['STATUS'];
        }

        return $result;
    }

    function SCHEDULECODE($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_schedule WHERE SCHEDULECODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['SCHEDULECODE'];
        }

        return $result;
    }

    function SCHEDULENAME($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_schedule WHERE SCHEDULECODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['SCHEDULENAME'];
        }

        return $result;
    }

    function SCHEDULECHECKIN($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_schedule WHERE SCHEDULECODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['CHECKIN'];
        }

        return $result;
    }

    function SCHEDULECHECKOUT($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_schedule WHERE SCHEDULECODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['CHECKOUT'];
        }

        return $result;
    }

    function SCHEDULEREMARKS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_schedule WHERE SCHEDULECODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['REMARKS'];
        }

        return $result;
    }

    function SCHEDULESTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_schedule WHERE SCHEDULECODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['STATUS'];
        }

        return $result;
    }

    function HOLIDAYDATE($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_holiday WHERE HOLIDAYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['HOLIDAYDATE'];
        }

        return $result;
    }


    function HOLIDAYREMARKS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_holiday WHERE HOLIDAYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['REMARKS'];
        }

        return $result;
    }

    function HOLIDAYSTATUS($id){
        require 'database.php';

        $sql = mysqli_query($conn,"SELECT * FROM tbl_holiday WHERE HOLIDAYCODE ='$id'");
        if (mysqli_num_rows($sql) > 0) {
            $info = mysqli_fetch_array($sql);
            $result = $info['STATUS'];
        }

        return $result;
    }
?>