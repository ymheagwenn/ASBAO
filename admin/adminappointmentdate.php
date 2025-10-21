<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
  #calendar { width: 60%; float: left; }
  #timeslot { width: 35%; float: right; border: 1px solid #ccc; padding: 10px; min-height: 400px; text-decoration: none;}
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

</style>

<div class="main-panel">
  <div class="content-wrapper" style="background-color: #FFFFFF;">

    <section class="page-section">
      <div class="container">
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
              <button type="submit" class="btn btn-sm btn-success" id="btn-book">Add Book Date</button>
              <a href="index.php?page=home&a=adminappointmentadd" id="booklists" class="btn btn-sm btn-info">Book Now</a>
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
              events: 'admin/load_events.php', // load booked slots + holidays
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
                  url: 'admin/check_holiday.php',
                  type: 'POST',
                  data: {date: date},
                  success: function(response){
                    if (response == "holiday") {
                      $("#slots").html("<p style='color:red;'>⛔ Holiday – booking not allowed</p>");
                      document.getElementById("btn-book").style.display = "none";
                    } else {
                      // Show available slots
                      $.ajax({
                        url: 'admin/adminslot.php',
                        type: 'POST',
                        data: {date: date, categorycode: categorycode},
                        success: function(r){
                          $("#slots").html(r);
                          $("#bookingForm button").prop("disabled", false);

                          //document.getElementById("booklists").style.display = "inline-block";
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
                url: 'admin/adminbooknow.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response){
                  $("#message").html(response);

                  if (response == 'Booked successfully saved') {
                    //window.location.href = "index.php?page=home&a=adminappointmentadd";
                  }

                  // Reload slots after booking
                  let date = $("#selected_date").val();
                  let categorycode = $("#category_code").val();
                  let usercode = document.getElementById("user_code").value;
                  $.ajax({
                    url: 'admin/adminslot.php',
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