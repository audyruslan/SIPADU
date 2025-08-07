  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <strong>Copyright &copy; <?= date("Y"); ?>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 0.1
      </div>
  </footer>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header bg-danger">
                  <h5 class="modal-title" id="exampleModalLabel"><strong><?= $admin["nama_lengkap"]; ?></strong>, Anda
                      Yakin
                      Ingin
                      Keluar?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">Pilih Tombol <strong>"Logout"</strong> jika ingin melanjtukan.</div>
              <div class="modal-footer">
                  <button class="btn btn-dark" type="button" data-dismiss="modal">Batal</button>
                  <a class="btn btn-danger" href="logout.php">Logout</a>
              </div>
          </div>
      </div>
  </div>


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/adminlte.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <!-- Sweetalert -->
  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="plugins/fullcalendar/main.js"></script>
  <!-- My Script -->
  <script src="assets/js/script.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>


  <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
      <script>
          Swal.fire({
              title: '<?= $_SESSION['status'];  ?>',
              icon: '<?= $_SESSION['status_icon'];  ?>',
              text: '<?= $_SESSION['status_info'];  ?>'
          });
      </script>
  <?php
        unset($_SESSION['status']);
    }
    ?>

  <script>
      // Hapus Admin
      $(document).on('click', '.hapus_admin', function(e) {

          e.preventDefault();
          var href = $(this).attr('href');

          Swal.fire({
              title: 'Apakah Anda Yakin?',
              text: "Data Admin!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus Data!'
          }).then((result) => {
              if (result.value) {
                  document.location.href = href;
              }

          })

      });

      // Hapus pengaduan
      $(document).on('click', '.hapus_pengaduan', function(e) {

          e.preventDefault();
          var href = $(this).attr('href');

          Swal.fire({
              title: 'Apakah Anda Yakin?',
              text: "Data Pengaduan!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus Data!'
          }).then((result) => {
              if (result.value) {
                  document.location.href = href;
              }

          })

      });
  </script>

  <script>
      $(document).ready(function() {
          // dataTable Product
          $('#productTable').DataTable({
              "language": {
                  url: 'assets/json/id.json'
              }
          });

          // dataTable Pelanggan
          $('#pelangganTable').DataTable({
              "language": {
                  url: 'assets/json/id.json'
              }
          });

          // dataTable Pemasukkan
          $('#pemasukkanTable').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "responsive": true,
              "language": {
                  url: 'assets/json/id.json'
              }
          });

          // dataTable Pengeluaran
          $('#pengeluaranTable').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "responsive": true,
              "language": {
                  url: 'assets/json/id.json'
              }
          });
      });
  </script>

  <script>
      $(function() {
          /*
           * DONUT CHART
           * -----------
           */


          <?php
            $hasilg = mysqli_query($conn, "SELECT hasil_id, count(hasil_id) jlh_id FROM hasil group by hasil_id ORDER BY jlh_id desc");
            while ($rg = mysqli_fetch_array($hasilg)) {
                if ($rg[0] > 0) {
                    $arr[] = array('label' => '&nbsp;' . $arpkt[$rg['hasil_id']], 'data' => array(array('Penyakit ' . $rg['hasil_id'], $rg['jlh_id'])));
                }
            }
            ?>
          var donutData = <?php echo json_encode($arr); ?>

          function legendFormatter(label, series) {
              return '<div class="text text-muted">' + label + ' ' + Math.round(series.percent) + '%';
          };

          $.plot('#donut-chart', donutData, {
              series: {
                  pie: {
                      show: true,
                      radius: 1,
                      innerRadius: 0.3,
                      label: {
                          show: true,
                          radius: 2 / 3,
                          formatter: function(label, series) {
                              return '<div class="badge bg-navy color-pallete">' + Math.round(series
                                  .percent) + '%</div>';
                          },
                          threshold: 0.1
                      }

                  }
              },
              legend: {
                  show: false
              }
          })
          /*
           * END DONUT CHART
           */

      })

      /*
       * Custom Label formatter
       * ----------------------
       */
      function labelFormatter(label, series) {
          return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
              label +
              '<br>' +
              Math.round(series.percent) + '%</div>'
      }
  </script>
  </body>

  </html>