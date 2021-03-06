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
  <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="assets/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">

  <?php include('header.php') ?>

  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Dashboard</h3>
        </div>
        <div class="clearfix"></div>

        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-user"></i></div>
            <div class="count">0</div>
            <h3>Jumlah Teknisi</h3>
            <p><a href=" datateknisi.php">Lihat Detail <span class="fa fa-chevron-right"></span> </a></p>
          </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-pie-chart"></i></div>
            <div class="count">0</div>
            <h3>Jumlah Kriteria</h3>
            <p><a href="datakriteria.php">Lihat Detail <span class="fa fa-chevron-right"></span> </a></p>
          </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-bars"></i></div>
            <div class="count">0</div>
            <h3>Jumlah Sub Kriteria</h3>
            <p><a href="datasubkriteria.php">Lihat Detail <span class="fa fa-chevron-right"></span> </a></p>
          </div>
        </div>

        <form action="" method="get">
          <div class="input-group col-md-4 col-md-offset-8">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
            <select type="submit" name="tanggal" class="form-control" id="tanggal">
              <option>Pilih Periode</option>
              <option></option>
            </select>
          </div>
        </form>

        <p></p>
        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Hasil Penilain Bulan <a style='color:blue'> Maret-2019</a></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <canvas id="mybarChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  </div>
  <!-- page content -->
  <?php include('footer.php') ?>
  </div>
  </div>

  <!-- jQuery -->
  <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="assets/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="assets/vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="assets/vendors/Chart.js/dist/Chart.min.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="assets/build/js/custom.min.js"></script>

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