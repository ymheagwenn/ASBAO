          <footer class="footer" style="background-color: #40826D;">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-white d-block text-center text-sm-start d-sm-inline-block">
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

    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <!-- Print -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#dtInventory').DataTable({
          "lengthChange": false,
          "bInfo": false,
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search",
          },
          dom: 'Bfrtip',
          buttons: [
            {
              extend: 'copyHtml5',
              exportOptions: { columns: ':visible' }
            },
            {
              extend: 'excelHtml5',
              title: 'ASBAO Report',
              exportOptions: { columns: ':visible' }
            },
            {
              extend: 'pdfHtml5',
              title: 'ASBAO Report',
              orientation: 'landscape',
              pageSize: 'A4',
              exportOptions: { columns: ':visible' },
              customize: function (doc) {
                // Force headers to match the visible table headers exactly
                var expectedHeaders = ['#','Reservation Date','Name (Contact)','Department','Venue','Time','Activity Date','Purpose','Status','Actions','Feedback'];
                if (doc.content && doc.content[1] && doc.content[1].table && doc.content[1].table.body && doc.content[1].table.body.length) {
                  // Replace header row
                  doc.content[1].table.headerRows = 1;
                  doc.content[1].table.body[0] = expectedHeaders;
                }
                doc.styles.tableHeader.alignment = 'center';
                var objLayout = {};
                objLayout.hLineWidth = function(i) { return 0.5; };
                objLayout.vLineWidth = function(i) { return 0.5; };
                objLayout.hLineColor = function(i) { return '#cccccc'; };
                objLayout.vLineColor = function(i) { return '#cccccc'; };
                objLayout.paddingLeft = function(i) { return 6; };
                objLayout.paddingRight = function(i) { return 6; };
                objLayout.paddingTop = function(i) { return 6; };
                objLayout.paddingBottom = function(i) { return 6; };
                doc.content[1].layout = objLayout;
              }
            },
            {
              text: 'Word',
              action: function (e, dt, node, config) {
                exportTableToWord('#dtInventory', 'admin_report_' + new Date().toISOString().split('T')[0] + '.doc');
              }
            },
            'print'
          ]
        });
      });
    </script>

    <script>
      function exportTableToWord(selector, filename) {
        var table = document.querySelector(selector);
        if (!table) return;
        var headers = ['#','Reservation Date','Name (Contact)','Department','Venue','Time','Activity Date','Purpose','Status','Actions','Feedback'];
        // Build a clean table from current DOM to strip icons/HTML and ensure exact headers
        var rows = table.querySelectorAll('tr');
        var bodyHtml = '<table><thead><tr>' + headers.map(function(h){return '<th>'+h+'</th>';}).join('') + '</tr></thead><tbody>';
        for (var r = 1; r < rows.length; r++) { // skip original header row
          var cells = rows[r].querySelectorAll('th,td');
          if (!cells.length) continue;
          bodyHtml += '<tr>';
          for (var c = 0; c < headers.length && c < cells.length; c++) {
            var text = (cells[c].innerText || '').trim();
            bodyHtml += '<td>' + text.replace(/\s+/g,' ') + '</td>';
          }
          bodyHtml += '</tr>';
        }
        bodyHtml += '</tbody></table>';

        var styles = '<style>\n' +
          'table{border-collapse:collapse;width:100%;font-family:Arial, sans-serif;font-size:12px;}\n' +
          'th,td{border:1px solid #000;padding:6px;vertical-align:top;}\n' +
          'th{text-align:center;background:#f2f2f2;}\n' +
          '</style>';
        var title = '<h3 style="font-family:Arial, sans-serif;">ASBAO Report</h3>';
        var html = '<html><head><meta charset="utf-8"><title>Report</title>' + styles + '</head><body>' + title + bodyHtml + '</body></html>';
        var blob = new Blob(['\ufeff', html], { type: 'application/msword' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = filename || 'report.doc';
        a.click();
        URL.revokeObjectURL(url);
      }
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        if (window.bootstrap) {
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
          tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
          })
        }
      });
    </script>
    
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
        $('#dtDepartment').DataTable({
          "lengthChange": false,
          "bInfo": false,
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Department",
          }
        });
      });
    </script>

    <script>
      $(document).ready(function() {
        $('#dtHoliday').DataTable({
          "lengthChange": false,
          "bInfo": false,
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search Holiday",
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
                    window.location.href = "index.php?page=appointment&a=adminmain";
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
  </body>
</html>