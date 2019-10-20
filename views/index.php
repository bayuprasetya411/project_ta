<?php
session_start();
if (isset($_SESSION['login'])) {

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPK | Dashboard</title>

    <!-- Bootstrap -->
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../assets/vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../assets/build/css/custom.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../assets/build/select2/select2.min.css" rel="stylesheet">


    <style>
      .count {
        color: gray;
      }
    </style>

  </head>

  <body class="nav-md">

    <?php include('header.php');
      include('../config/koneksi.php'); ?>

    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Dashboard</h3>
          </div>
          <div class="clearfix"></div>

          <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="tile-stats" id="dashboardteknisi">
              <div class="icon"><i class="fa fa-user"></i></div>
              <?php
                $query_teknisi = mysqli_query($conn, "SELECT count(nik) as jumlah_teknisi FROM tb_teknisi");
                while ($datateknisi = mysqli_fetch_array($query_teknisi)) { ?>
                <div class="count"><?php echo $datateknisi['jumlah_teknisi']; ?></div>
              <?php } ?>
              <h3>Jumlah Teknisi</h3>
              <p><a href=" datateknisi.php">Lihat Detail <span class="fa fa-chevron-right"></span> </a></p>
            </div>
          </div>

          <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12" id="dashboardkriteria">
            <div class="tile-stats">
              <div class="icon"><i class="fa fa-pie-chart"></i></div>
              <?php
                $query_kriteria = mysqli_query($conn, "SELECT count(id_kriteria) as jumlah_kriteria FROM tb_kriteria");
                while ($datakriteria = mysqli_fetch_array($query_kriteria)) {
                  ?>
                <div class="count"><?php echo $datakriteria['jumlah_kriteria']; ?></div>
              <?php } ?>
              <h3>Jumlah Kriteria</h3>
              <p><a href="datakriteria.php">Lihat Detail <span class="fa fa-chevron-right"></span> </a></p>
            </div>
          </div>

          <div class="clearfix"></div>

          <!-- Bar graph -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Grafik Penilaian</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <form action="" method="get">
                  <div class="input-group col-md-4 col-md-offset-8">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                    <select type="submit" name="filter_periode" class="form-control select-search-periode" id="filter_periode" style="width:100%;">
                      <option></option>
                      <?php
                        $queryperiode = mysqli_query($conn, "SELECT tb_nilai.id_periode, tb_periode.nama_periode FROM tb_nilai
                                    inner join tb_periode
                                    on tb_nilai.id_periode = tb_periode.id_periode 
                                    group by tb_nilai.id_periode");
                        while ($row = mysqli_fetch_array($queryperiode)) { ?>
                        <option value="<?php echo $row['id_periode'] ?>"><?php echo $row['nama_periode'] ?></option>
                      <?php
                        } ?>
                    </select>
                  </div>
                </form>


                <div style="padding:1%">
                  <h2>
                    Hasil Penilaian Teknisi Periode <a style="color:blue;">Maret-2019</a>
                  </h2>
                </div>

                <p></p>

                <canvas id="mybarChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- Bar graph -->

        <!-- line graph -->
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Grafik Individu Teknisi Per Tahun</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <form action="" method="get">
                <div class="input-group col-md-4 col-md-offset-8">
                  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                  <select type="submit" name="tahun" class="form-control" id="tahun">
                    <option>-- Pilih Tahun --</option>
                    <option></option>
                  </select>
                </div>
              </form>

              <div style="padding:1%">
                <h2>
                  <td>Teknisi</td>
                  <td>:</td>
                  <td>
                    I Gusti Agung Bayu Prasetya Dikayana
                  </td>
                </h2>
                <h4>
                  Hasil Penilaian Teknisi Periode <a style="color:blue;"> Tahun 2019</a>
                </h4>
              </div>

              <p></p>
              <div class="x_content2">
                <div id="graph_line" style="width:100%; height:300px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Bar graph -->

      <div class="clearfix"></div>
    </div>
    </div>
    </div>
    <!-- page content -->
    <?php include('footer.php') ?>
    </div>
    </div>

    <!-- jQuery -->
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- morris.js -->
    <script src="../assets/vendors/raphael/raphael.min.js"></script>
    <script src="../assets/vendors/morris.js/morris.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../assets/build/js/custom.min.js"></script>
    <script src="../assets/build/select2/select2.min.js"></script>


    <script>
      $(".select-search-periode").select2({
        placeholder: "-- Pilih Periode --",
        allowClear: true
      });
    </script>

  <?php
  } else {
    echo "<script>
    alert('Anda Belum Login!!!');window.location=(href='login.php');
  </script>";
  }
  ?>

  <?php


  if ((isset($_GET['aksi'])) and ($_GET['aksi'] == "logout")) {
    session_destroy();
    echo "<script>window.location=(href='login.php')</script>";
  }
  ?>
  </body>

  </html>