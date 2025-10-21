<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
  #calendar { 
    width: 60%; 
    float: left; 
  }
  #timeslot { 
    width: 35%; 
    float: right; 
    border: 1px solid #ccc; 
    padding: 10px; 
    min-height: 400px; 
    text-decoration: none;
  }
  .available { color: green; margin: 5px 0; display: block; }
  .booked { color: red; margin: 5px 0; display: block; }
  .holiday { background-color: #ffcccc !important; }

  #booklists{
    display: none;
  }

  #btn-book{
    display: none;
  }

  /* Remove underline or any text decoration */
  .fc-col-header-cell-cushion,
  .fc-daygrid-day-number {
    text-decoration: none !important;
  }

  /* Optional: make them clean & bold */
  .fc-col-header-cell-cushion {
    font-weight: bold;
    color: #333;
  }

  .fc-daygrid-day-number {
    font-size: 14px;
    font-weight: bold;
    color: #000;
  }

  /* Mobile Responsive Styles */
  @media (max-width: 768px) {
    #calendar { 
      width: 100%; 
      float: none; 
      margin-bottom: 20px;
    }
    #timeslot { 
      width: 100%; 
      float: none; 
      margin-top: 20px;
    }
    
    /* Make calendar more compact on mobile */
    .fc-toolbar {
      flex-direction: column;
      gap: 10px;
    }
    
    .fc-toolbar-chunk {
      display: flex;
      justify-content: center;
    }
    
    .fc-button {
      font-size: 12px;
      padding: 4px 8px;
    }
    
    .fc-daygrid-day-number {
      font-size: 12px;
    }
    
    .fc-col-header-cell-cushion {
      font-size: 11px;
      padding: 4px 2px;
    }
    
    /* Adjust calendar height on mobile */
    .fc-daygrid-body {
      font-size: 12px;
    }
    
    .fc-daygrid-day-frame {
      min-height: 60px;
    }
  }

  @media (max-width: 480px) {
    /* Extra small screens */
    .fc-toolbar-title {
      font-size: 16px;
    }
    
    .fc-button {
      font-size: 10px;
      padding: 2px 6px;
    }
    
    .fc-daygrid-day-number {
      font-size: 10px;
    }
    
    .fc-col-header-cell-cushion {
      font-size: 10px;
      padding: 2px 1px;
    }
    
    .fc-daygrid-day-frame {
      min-height: 50px;
    }
    
    #timeslot {
      padding: 8px;
    }
    
    #timeslot h3 {
      font-size: 18px;
    }
    
    #timeslot h5 {
      font-size: 16px;
    }
  }

</style>

<div class="main-panel">
  <div class="content-wrapper" style="background-color: #FFFFFF;">

    <?php
      // Check if user has pending feedback
      $usercode = $_SESSION['USERCODE'];
      $feedback_count = CHECKFEEDBACK($usercode);
      if ($feedback_count > 0) {
    ?>
    <div class="container mb-4">
      <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: #fff3cd; border-color: #ffeaa7;">
        <div class="d-flex align-items-center">
          <i class="mdi mdi-information-outline me-3" style="font-size: 24px; color: #856404;"></i>
          <div>
            <h6 class="alert-heading mb-1" style="color: #856404; font-weight: bold;">Feedback Required</h6>
            <p class="mb-0" style="color: #856404;">
              You have <strong><?php echo $feedback_count; ?> completed appointment(s)</strong> that need your feedback before making a new booking.
            </p>
            <div class="mt-2">
              <a href="index.php?page=home&a=userfeedback" class="btn btn-warning btn-sm">
                <i class="mdi mdi-comment-text"></i> Provide Feedback First
              </a>
              <a href="index.php?page=home&a=userdashboard" class="btn btn-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Dashboard
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php 
      // Hide the booking interface when feedback is pending
      echo '<div class="container text-center"><p class="text-muted">Please complete your feedback before booking a new appointment.</p></div>';
      exit();
    } 
    ?>

    <section class="page-section">
      <div class="container">
        <!-- Important Notice Section -->
        <div class="row mb-4">
          <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: #fff3cd; border-color: #ffeaa7;">
              <div class="d-flex align-items-center">
                <i class="mdi mdi-information-outline me-3" style="font-size: 24px; color: #856404;"></i>
                <div>
                  <h6 class="alert-heading mb-1" style="color: #856404; font-weight: bold;">Important Notice</h6>
                  <p class="mb-0" style="color: #856404;">
                    <strong>Before booking an appointment:</strong> Please download the required forms from the "Forms" section on the sidebar. 
                    Accepted reservations must submit the following requirements three (3) days before the scheduled event:
                  </p>
                  <ul class="mb-0 mt-2" style="color: #856404;">
                    <li>Duly filled out IRS FORM</li>
                    <li>Supporting documents</li>
                  </ul>
                </div>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
        
        <div class="row">
          <input type="hidden" id="categorycode" value="<?php echo $_GET['venue']; ?>">
          <div id="calendar"></div>

          <div id="timeslot">
            <h3 class="text-center"><?php echo CATEGORYNAME($_GET['venue']); ?></h3><br>
            <h5>Time Slots</h5>
            <form id="bookingForm">
              <input type="hidden" id="selected_date" name="date">
              <input type="hidden" id="category_code" name="categorycode">
              <input type="hidden" id="user_code" name="usercode" value="<?php echo $_SESSION['USERCODE']; ?>">
              <div id="slots"></div>
              <br>
              <!-- <button type="submit" class="btn btn-sm btn-success" id="btn-book">Book Now</button> -->
              <button type="submit" class="btn btn-sm btn-success" id="btn-book">Add Book Date</button>
              <a href="index.php?page=home&a=userappointmentadd&venue=<?php echo $_GET['venue']; ?>" id="booklists" class="btn btn-sm btn-info">Book Now</a>
            </form>
            <div id="message"></div>
          </div>

          <script>
          document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              headerToolbar: {
                left: '',
                center: 'title',
                right: 'prev,next'
              },
              selectable: true,
              events: 'user/load_events.php', // load booked slots + holidays
              validRange: function(nowDate) {
                return { start: nowDate }; // disable past dates
              },
              dateClick: function(info) {
                let date = info.dateStr;
                let categorycode = document.getElementById("categorycode").value;

                $("#selected_date").val(date);
                $("#category_code").val(categorycode);

                // Prevent selecting holidays (marked in load_events.php)
                $.ajax({
                  url: 'user/check_holiday.php',
                  type: 'POST',
                  data: {date: date},
                  success: function(response){
                    if (response == "holiday") {
                      $("#slots").html("<p style='color:red;'>⛔ Holiday – booking not allowed</p>");
                      document.getElementById("btn-book").style.display = "none";
                    } else {
                      // Show available slots
                      $.ajax({
                        url: 'user/userslot.php',
                        type: 'POST',
                        data: {date: date, categorycode: categorycode},
                        success: function(r){
                          $("#slots").html(r);
                          $("#bookingForm button").prop("disabled", false);

                          document.getElementById("btn-book").style.display = "inline-block";
                        }
                      });
                    }
                  }
                });
              }
            });
            calendar.render();

            $("#bookingForm").submit(function(e){
              e.preventDefault();

              $.ajax({
                url: 'user/userbooknow.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response){
                  $("#message").html(response);

                  if (response == 'Booked successfully saved') {
                    //window.location.href = "index.php?page=home&a=userappointmentadd";
                  }

                  // Reload slots after booking
                  let date = $("#selected_date").val();
                  let categorycode = $("#category_code").val();
                  let usercode = document.getElementById("user_code").value;

                  $.ajax({
                    url: 'user/userslot.php',
                    type: 'POST',
                    data: {date: date, categorycode: categorycode, usercode: usercode},
                    success: function(r){
                      $("#slots").html(r);


                      document.getElementById("booklists").style.display = "inline-block";
                    }
                  });

                  // Refresh calendar events (booked slot turns red)
                  calendar.refetchEvents();
                }
              });
            });
          });
          </script>
        </div>
      </div>
    </section>
  </div>