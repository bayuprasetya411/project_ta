<?php
session_start();
if (isset($_SESSION['login'])) {
  include('../config/koneksi.php');
  include('../config/function.php');
  error_reporting(0);
  $tanggal = tgl_indo(date('Y-m'));

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
    <?php include('../config/stylesheet.php'); ?>

    <style>
      .count {
        color: gray;
      }
    </style>

  </head>

  <body class="nav-md">

    <?php include('header.php'); ?>

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
                  <div class="container">
                    <div class="row">
                      <div class='col-sm-4 col-sm-offset-8'>
                        <div class="form-group">
                          <div class='input-group'>
                            <select name="periode" class="form-control select-search-periode" id="filter_periode" style="width:100%;">
                              <option></option>
                              <?php
                                $queryperiode = mysqli_query($conn, "SELECT tb_nilai.id_periode, tb_periode.nama_periode FROM tb_nilai
                                                        inner join tb_periode
                                                        on tb_nilai.id_periode = tb_periode.id_periode 
                                                        group by tb_nilai.id_periode");
                                while ($row = mysqli_fetch_array($queryperiode)) { ?>
                                <option value="<?php echo $row['nama_periode'] ?>"><?php echo $row['nama_periode'] ?></option>
                              <?php
                                } ?>
                            </select>

                            <span class="input-group-btn">
                              <button type="submit" style="height: 38px;" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

                <?php if (!empty($_GET)) {
                    $query_teknisi = mysqli_query($conn, "SELECT tb_periode.nama_periode, tb_nilai.id_periode ,tb_nilai.nik ,tb_teknisi.nama FROM tb_nilai
                      INNER JOIN tb_periode
                      on tb_nilai.id_periode = tb_periode.id_periode
                      INNER JOIN tb_teknisi
                      on tb_nilai.nik = tb_teknisi.nik
                      where tb_periode.nama_periode = '" . $_GET['periode'] . "'
                      group by tb_nilai.nik ");

                    $nama_teknisi = array();
                    $total_nilai1 = array();
                    while ($data_teknisi = mysqli_fetch_assoc($query_teknisi)) {
                      $nik = $data_teknisi['nik'];
                      $nama_teknisi[] = $data_teknisi['nama'];
                      $id_periode = $data_teknisi['id_periode'];

                      // echo "<pre>";
                      // print_r($nama_teknisi);
                      // echo "</pre>";
                      // exit();

                      $total_nilai = 0;
                      $query_periode_has_kriteria2 = mysqli_query($conn, "SELECT *, tb_periode.nama_periode FROM tb_periode_has_kriteria
                                      inner Join tb_periode
                                      on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                      INNER JOIN tb_kriteria
                                      ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                      WHERE tb_periode_has_kriteria.id_periode = '" . $id_periode . "'");

                      while ($data_periode_has_kriteria2 = mysqli_fetch_array($query_periode_has_kriteria2)) {
                        $id_kriteria = $data_periode_has_kriteria2['id_kriteria'];
                        $nama_periode = $data_periode_has_kriteria2['nama_periode'];
                        $bobot_kriteria = $data_periode_has_kriteria2['bobot_kriteria'];
                        $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
                                inner join tb_kriteria
                                on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                where tb_periode_has_kriteria.id_periode ='" . $id_periode . "'");

                        while ($data_total_bobot = mysqli_fetch_array($result_total_bobot)) {
                          $bobot_normalisasi = $bobot_kriteria / $data_total_bobot['total_bobot'];
                          $query_subkriteria = mysqli_query($conn, "SELECT tb_nilai.id_periode, tb_nilai.nik, tb_nilai.id_kriteria, tb_subkriteria.nilai_sub_kriteria From tb_nilai
                                inner join tb_subkriteria
                                on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                Where tb_nilai.id_kriteria = '" . $id_kriteria . "' and tb_nilai.nik ='" . $nik . "' and tb_nilai.id_periode='" . $id_periode . "'");

                          while ($datasub = mysqli_fetch_array($query_subkriteria)) {
                            $nilai_ultility = $datasub['nilai_sub_kriteria'] * $bobot_normalisasi;
                            $total_nilai += $nilai_ultility;
                          }
                        }
                      }
                      $total_nilai1[] = $total_nilai;
                    }
                    ?>
                  <div style="padding:1%">
                    <h2>
                      <b>Hasil Penilaian Teknisi Periode <a style="color:blue;"><?php echo $nama_periode ?></a></b>
                    </h2>
                  </div>

                  <p></p>

                  <div id="grafik_teknisi" style="width:100%; height: 500px; margin: 0 auto"></div>
              </div>
            </div>
          </div>
        </div>
      <?php  } else {
          $query_teknisi = mysqli_query($conn, "SELECT tb_periode.create_at, tb_periode.nama_periode, tb_nilai.id_periode ,tb_nilai.nik ,tb_teknisi.nama FROM tb_nilai
                          INNER JOIN tb_periode
                          on tb_nilai.id_periode = tb_periode.id_periode
                          INNER JOIN tb_teknisi
                          on tb_nilai.nik = tb_teknisi.nik
                          where tb_periode.nama_periode = '" . $tanggal . "'
                          group by tb_nilai.nik ");

          $nama_teknisi = array();
          $total_nilai1 = array();
          while ($data_teknisi = mysqli_fetch_assoc($query_teknisi)) {
            $nik = $data_teknisi['nik'];
            $nama_teknisi[] = $data_teknisi['nama'];
            $id_periode = $data_teknisi['id_periode'];

            // echo "<pre>";
            // print_r($nama_teknisi);
            // echo "</pre>";
            // exit();

            $total_nilai = 0;
            $query_periode_has_kriteria2 = mysqli_query($conn, "SELECT *, tb_periode.nama_periode FROM tb_periode_has_kriteria
                                          inner Join tb_periode
                                          on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                          INNER JOIN tb_kriteria
                                          ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                          WHERE tb_periode_has_kriteria.id_periode = '" . $id_periode . "'");

            while ($data_periode_has_kriteria2 = mysqli_fetch_array($query_periode_has_kriteria2)) {
              $id_kriteria = $data_periode_has_kriteria2['id_kriteria'];
              $nama_periode = $data_periode_has_kriteria2['nama_periode'];
              $bobot_kriteria = $data_periode_has_kriteria2['bobot_kriteria'];
              $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
                                    inner join tb_kriteria
                                    on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                    where tb_periode_has_kriteria.id_periode ='" . $id_periode . "'");

              while ($data_total_bobot = mysqli_fetch_array($result_total_bobot)) {
                $bobot_normalisasi = $bobot_kriteria / $data_total_bobot['total_bobot'];
                $query_subkriteria = mysqli_query($conn, "SELECT tb_nilai.nik, tb_nilai.id_kriteria, tb_subkriteria.nilai_sub_kriteria From tb_nilai
                                    inner join tb_subkriteria
                                    on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                    Where tb_nilai.id_kriteria = '" . $id_kriteria . "' and tb_nilai.nik ='" . $nik . "' and tb_nilai.id_periode='" . $id_periode . "' ");

                while ($datasub = mysqli_fetch_array($query_subkriteria)) {
                  $nilai_ultility = $datasub['nilai_sub_kriteria'] * $bobot_normalisasi;
                  $total_nilai += $nilai_ultility;
                }
              }
            }
            $total_nilai1[] = $total_nilai;
          }
          ?>
        <div style="padding:1%">
          <h2>
            <b>Hasil Penilaian Teknisi Periode <a style="color:blue;"><?php echo $tanggal ?></a></b>
          </h2>
        </div>

        <p></p>

        <div id="grafik_teknisi" style="width:100%; height: 500px; margin: 0 auto"></div>
      </div>
    </div>
    </div>
    </div>
  <?php } ?>

  <!-- Bar graph -->
  <div class="clearfix"></div>
  </div>
  </div>
  </div>
  <!-- page content -->
  <?php include('footer.php') ?>
  </div>
  </div>

  <?php include('../config/javascript.php'); ?>

  <script>
    // $(".select-search-teknisi").select2({
    //   placeholder: "-- Pilih Teknisi --",
    //   allowClear: true
    // });
    $(".select-search-periode").select2({
      placeholder: "-- Pilih Periode --",
      allowClear: true
    });
    // $(".select-search-tahun").select2({
    //   placeholder: "-- Pilih Tahun --",
    //   allowClear: true
    // });
  </script>

  <script>
    // Grafik Semua Teknisi 
    Highcharts.chart('grafik_teknisi', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Hasil Penilaian Teknisi '
      },

      xAxis: {
        categories: <?= json_encode($nama_teknisi); ?>,
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Nilai'
        }
      },
      tooltip: {
        headerFormat: '<span style="font-size:15px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
          '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0
        }
      },
      series: [{
        name: 'Total Nilai',
        data: <?= json_encode($total_nilai1); ?>

      }]
    });
    // Grafik Semua Teknisi 
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