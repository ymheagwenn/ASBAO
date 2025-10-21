          <footer class="footer" style="background-color: #40826D; position: fixed; bottom: 0; left: 0; right: 0; z-index: 1030;">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-white d-block text-sm-start d-sm-inline-block">
                Copyright © Auxiliary Services and Business Affairs Office Venue Reservation <?php echo date('Y'); ?>
              </span>
              <!-- <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">
                Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com
              </span> -->
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>


    <script src="assets/js/jquery.js"></script>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <!-- Copy, CSV and Excel -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <!-- Print -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#dtCategory').DataTable({
          "lengthChange": false,
          "bInfo": false,
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Category",
          }
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#dtSchedule').DataTable({
          "lengthChange": false,
          "bInfo": false,
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Schedule",
          }
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#dtUser').DataTable({
          "lengthChange": false,
          "bInfo": false,
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search User",
          }
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#dtAppointment').DataTable({
          "lengthChange": false,
          "bInfo": false,
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search",
          }//,
          //dom: 'Bfrtip',
          //buttons: [
              //'csv'
              //'copy',
              //'excel',
              //'pdf',
              //'print'

            //   {
            //   extend: 'excelHtml5',
            //   exportOptions: {
            //       columns: ':visible'
            //   }
            // },
            // 'colvis'
          //]
        });
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function () {
        $('.logout').click(function (e) {
          e.preventDefault();

          Swal.fire({
            title: 'Do you want to log out?',
            text: "Your session has been logged out due to inactivity.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Log out'
          }).then((result) => {
            if (result.isConfirmed) {

              window.location.href = 'logout.php';
            }
          });

        });

        $('.deleteuser').click(function (e) {
          e.preventDefault();

          var deluserid = $(this).closest('tr').find('.deleteuserid').val();
          var delusercode = $(this).closest('tr').find('.deleteusercode').val();

          Swal.fire({
            title: 'Are you sure?',
            text: "Once deleted, you will not be able to recover this data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

              $.ajax({
                type: "POST",
                url: "admin/admindelete.php",
                data: {"deleteuserid": deluserid, "deleteusercode": delusercode},
                success: function (response){

                  Swal.fire(
                    'Deleted!',
                    'Data deleted successfully!',
                    'success'
                  ).then((result) => {
                    location.reload();
                  });

                }
              });
            }
          });
        });

        $('.deletevenueschedule').click(function (e) {
          e.preventDefault();

          var delscheduleid = $(this).closest('tr').find('.deletescheduleid').val();

          Swal.fire({
            title: 'Are you sure?',
            text: "Once deleted, you will not be able to recover this data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

              $.ajax({
                type: "POST",
                url: "admin/admindelete.php",
                data: {"deletescheduleid": delscheduleid},
                success: function (response){

                  Swal.fire(
                    'Deleted!',
                    'Data deleted successfully!',
                    'success'
                  ).then((result) => {
                    window.location.href = "index.php?page=home&a=userdashboard";
                  });

                }
              });
            }
          });
        });


        $('.deleteparcel').click(function (e) {
          e.preventDefault();

          var delparcelcode = $(this).closest('tr').find('.deleteparcelcode').val();

          Swal.fire({
            title: 'Are you sure?',
            text: "Once deleted, you will not be able to recover this data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {

              $.ajax({
                type: "POST",
                url: "admin/admindelete.php",
                data: {"deleteparcelcode": delparcelcode},
                success: function (response){

                  Swal.fire(
                    'Deleted!',
                    'Data deleted successfully!',
                    'success'
                  ).then((result) => {
                    location.reload();
                  });

                }
              });
            }
          });
        });

      });
    </script>

    <script type="text/javascript">
      function isNumberKey(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
          return false;
        else {
          var len = $(element).val().length;
          var index = $(element).val().indexOf('.');
          if (index > 0 && charCode == 46) {
            return false;
          }
          if (index > 0) {
            var CharAfterdot = (len + 1) - index;
            if (CharAfterdot > 3) {
              return false;
            }
          }

        }
        return true;
      }
    </script>

    <script type="text/javascript">
      function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
      }
    </script>

    <script>
      function calc(){

        var total = 0 ;
         $('.price').each(function(){
          var p = $(this).val();
              p =  p.replace(/,/g,'')
              p = p > 0 ? p : 0;
            total = parseFloat(p) + parseFloat(total)
         })
         if($('.price').length > 0)
         $('.price').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2,minimumFractionDigits:2}))
      }
    </script>
  </body>
</html>