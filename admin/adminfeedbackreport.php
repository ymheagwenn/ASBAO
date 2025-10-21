        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-chart-bar"></i>
                </span> Feedback Report
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <button onclick="exportToPDF()" style="text-decoration: none; padding: 8px;" class="btn-dark text-white">
                      <i class="mdi mdi-file-pdf icon-sm align-middle"></i>
                      <span></span>&nbsp; Export PDF
                    </button>
                  </li>
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <button onclick="exportToExcel()" style="text-decoration: none; padding: 8px; margin-left: 10px;" class="btn-success text-white">
                      <i class="mdi mdi-file-excel icon-sm align-middle"></i>
                      <span></span>&nbsp; Export Excel
                    </button>
                  </li>
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <button onclick="exportToWord()" style="text-decoration: none; padding: 8px; margin-left: 10px;" class="btn-primary text-white">
                      <i class="mdi mdi-file-word icon-sm align-middle"></i>
                      <span></span>&nbsp; Export Word
                    </button>
                  </li>
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <button onclick="printReport()" style="text-decoration: none; padding: 8px; margin-left: 10px;" class="btn-info text-white">
                      <i class="mdi mdi-printer icon-sm align-middle"></i>
                      <span></span>&nbsp; Print
                    </button>
                  </li>
                </ul>
              </nav>
            </div>
            
            <!-- Summary Cards -->
            <div class="row">
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Total Questions</h6>
                        <h4 class="mb-0"><?php
                          $total_questions = mysqli_query($conn, "SELECT COUNT(*) as total FROM questions");
                          $total_q = mysqli_fetch_array($total_questions);
                          echo $total_q['total'];
                        ?></h4>
                      </div>
                      <div class="flex-shrink-0">
                        <i class="mdi mdi-help-circle text-primary" style="font-size: 2rem;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Total Responses</h6>
                        <h4 class="mb-0"><?php
                          $total_responses = mysqli_query($conn, "SELECT COUNT(*) as total FROM question_feedback");
                          $total_r = mysqli_fetch_array($total_responses);
                          echo $total_r['total'];
                        ?></h4>
                      </div>
                      <div class="flex-shrink-0">
                        <i class="mdi mdi-account-multiple text-success" style="font-size: 2rem;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Average Rating</h6>
                        <h4 class="mb-0"><?php
                          $avg_rating = mysqli_query($conn, "SELECT AVG(rating) as avg FROM question_feedback");
                          $avg_r = mysqli_fetch_array($avg_rating);
                          echo number_format($avg_r['avg'], 2);
                        ?></h4>
                      </div>
                      <div class="flex-shrink-0">
                        <i class="mdi mdi-star text-warning" style="font-size: 2rem;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h6 class="card-title mb-0">Response Rate</h6>
                        <h4 class="mb-0"><?php
                          $response_rate = mysqli_query($conn, "SELECT COUNT(DISTINCT usercode) as unique_users FROM question_feedback");
                          $rate = mysqli_fetch_array($response_rate);
                          echo $rate['unique_users'];
                        ?></h4>
                      </div>
                      <div class="flex-shrink-0">
                        <i class="mdi mdi-chart-line text-info" style="font-size: 2rem;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Rating Scale Legend -->
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Rating Scale</h5>
                    <div class="row">
                      <div class="col-md-2 text-center">
                        <div class="rating-scale-item">
                          <div class="rating-number" style="background-color: #dc3545; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">1</div>
                          <small>Strongly Disagree</small>
                        </div>
                      </div>
                      <div class="col-md-2 text-center">
                        <div class="rating-scale-item">
                          <div class="rating-number" style="background-color: #fd7e14; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">2</div>
                          <small>Disagree</small>
                        </div>
                      </div>
                      <div class="col-md-2 text-center">
                        <div class="rating-scale-item">
                          <div class="rating-number" style="background-color: #ffc107; color: black; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">3</div>
                          <small>Neutral</small>
                        </div>
                      </div>
                      <div class="col-md-2 text-center">
                        <div class="rating-scale-item">
                          <div class="rating-number" style="background-color: #20c997; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">4</div>
                          <small>Agree</small>
                        </div>
                      </div>
                      <div class="col-md-2 text-center">
                        <div class="rating-scale-item">
                          <div class="rating-number" style="background-color: #198754; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-weight: bold;">5</div>
                          <small>Strongly Agree</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            

            <!-- Individual Responses -->
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Feedback by Category (Question → Rating)</h5>
                    <div class="table-responsive">
                      <table class="table table-striped" id="feedbackReportTable">
                        <thead>
                          <tr>
                            <th width="5%">#</th>
                            <th width="65%">Question</th>
                            <th width="30%" class="text-center">Rating</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $count = 1;
                            // Show each response as: Question → Rating label (include all 1-5 ratings)
                            $response_sql = mysqli_query($conn, "SELECT qf.rating, q.question_text FROM question_feedback qf 
                                                              LEFT JOIN questions q ON qf.question_id = q.id 
                                                              ORDER BY qf.id DESC LIMIT 200");
                            if (mysqli_num_rows($response_sql) > 0) {
                              while ($response = mysqli_fetch_array($response_sql)) {
                                $rating_class = '';
                                $rating_text = '';
                                switch(intval($response['rating'])) {
                                  case 1:
                                    $rating_class = 'badge-danger';
                                    $rating_text = 'Strongly Disagree';
                                    break;
                                  case 2:
                                    $rating_class = 'badge-warning';
                                    $rating_text = 'Disagree';
                                    break;
                                  case 3:
                                    $rating_class = 'badge-secondary';
                                    $rating_text = 'Neutral';
                                    break;
                                  case 4:
                                    $rating_class = 'badge-info';
                                    $rating_text = 'Agree';
                                    break;
                                  case 5:
                                    $rating_class = 'badge-success';
                                    $rating_text = 'Strongly Agree';
                                    break;
                                }
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $count++; ?></td>
                                  <td><?php echo htmlspecialchars($response['question_text']); ?></td>
                                  <td class="text-center">
                                    <span class="badge <?php echo $rating_class; ?>">
                                      <?php echo $response['rating']; ?> - <?php echo $rating_text; ?>
                                    </span>
                                  </td>
                                </tr>
                                <?php
                              }
                            } else {
                              ?>
                              <tr>
                                <td colspan="3" class="text-center">No individual responses available</td>
                              </tr>
                              <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <style>
          .rating-bar {
            min-width: 60px;
          }
          .rating-count {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 2px;
          }
          .progress {
            margin-bottom: 2px;
          }
          .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: none;
          }
          .badge {
            font-size: 0.75em;
          }
        </style>

        <script>
          function exportToPDF() {
            // Create a new window for PDF generation
            var printWindow = window.open('', '_blank');
            var table = document.getElementById('feedbackReportTable');
            
            printWindow.document.write(`
              <html>
                <head>
                  <title>Feedback Report</title>
                  <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    .summary { margin-bottom: 20px; }
                    .summary-item { display: inline-block; margin-right: 20px; }
                  </style>
                </head>
                <body>
                  <h1>Feedback Report</h1>
                  <div class="summary">
                    <div class="summary-item"><strong>Generated:</strong> ${new Date().toLocaleDateString()}</div>
                    <div class="summary-item"><strong>Total Questions:</strong> <?php echo $total_q['total']; ?></div>
                    <div class="summary-item"><strong>Total Responses:</strong> <?php echo $total_r['total']; ?></div>
                    <div class="summary-item"><strong>Average Rating:</strong> <?php echo number_format($avg_r['avg'], 2); ?></div>
                  </div>
                  ${table.outerHTML}
                </body>
              </html>
            `);
            
            printWindow.document.close();
            printWindow.print();
          }

          function exportToExcel() {
            // Create a simple CSV export of the visible table
            var csv = 'No,Question,Rating\n';
            var table = document.getElementById('feedbackReportTable');
            var rows = table.getElementsByTagName('tr');

            for (var i = 1; i < rows.length; i++) {
              var cells = rows[i].getElementsByTagName('td');
              if (cells.length > 0) {
                var no = (cells[0].textContent || '').trim();
                var question = (cells[1].textContent || '').replace(/\n/g, ' ').replace(/"/g, '""').trim();
                var rating = (cells[2].textContent || '').trim();
                csv += no + ',"' + question + '",' + rating + '\n';
              }
            }

            var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'feedback_report_' + new Date().toISOString().split('T')[0] + '.csv';
            a.click();
            window.URL.revokeObjectURL(url);
          }

          function exportToWord() {
            var table = document.getElementById('feedbackReportTable');
            var htmlContent = '<html><head><meta charset="utf-8"><title>Feedback Report</title></head><body>' +
                              '<h1>Feedback Report</h1>' + table.outerHTML + '</body></html>';
            var blob = new Blob(['\ufeff', htmlContent], { type: 'application/msword' });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'feedback_report_' + new Date().toISOString().split('T')[0] + '.doc';
            a.click();
            URL.revokeObjectURL(url);
          }

          function printReport() {
            var table = document.getElementById('feedbackReportTable');
            var w = window.open('', '_blank');
            w.document.write('<html><head><title>Feedback Report</title></head><body>');
            w.document.write('<h1>Feedback Report</h1>');
            w.document.write(table.outerHTML);
            w.document.write('</body></html>');
            w.document.close();
            w.print();
          }
        </script>


