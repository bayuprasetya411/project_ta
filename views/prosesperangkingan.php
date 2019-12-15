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
        <title>SPK | Proses Perankingan</title>
        <?php include('../config/stylesheet.php') ?>
    </head>

    <?php include('header.php'); ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Proses Perangkingan</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabel Ranking Teknisi<small>Corporate Service</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form action="" method="get">
                            <div class="container">
                                <div class="row">
                                    <div class='col-sm-4 col-sm-offset-8'>
                                        <div class="form-group">
                                            <div class='input-group'>
                                                <select name="periode" class="form-control select-search-periode" id="filter_periode" style="width:100%; padding:2px;">
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

                        <!-- Filter Berdasarkan Periode -->
                        <?php if (!empty($_GET)) {
                                $periode = $_GET['periode']; ?>
                            <label>
                                <h2><b>Hasil Perhitungan Periode <a style="color:blue;"><?php echo $periode; ?></a></b></h2>
                            </label>
                            <br />
                            <br />
                            <!-- tabel bobot normalisasi -->
                            <div style="text-align: center">
                                <label>
                                    <h3 class="panel-title" style=" font-size:15pt"><b>Tabel Normalisasi Bobot</b></h3>
                                </label>
                            </div>

                            <table class="table table-bordered table-striped table-hover nw">
                                <thead>
                                    <tr>
                                        <th class="text-center">-</th>
                                        <!-- tampil nama kriteria -->
                                        <?php $query_row1x1 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                            INNER JOIN tb_kriteria
                                                            ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                            INNER JOIN tb_periode
                                                            ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                            WHERE tb_periode.nama_periode = '" . $periode . "'"
                                                );

                                                while ($row1x1 = mysqli_fetch_array($query_row1x1)) {
                                                    $id_periode1x1 = $row1x1['id_periode'];
                                                    $nama_periode1x1 = $row1x1['nama_periode'];
                                                    $nama_kriteria1x1 = $row1x1['nama_kriteria'];
                                                    ?>
                                            <th class="text-center"><?php echo $nama_kriteria1x1 ?></th>
                                        <?php
                                                }
                                                ?>
                                        <!-- tampil nama kriteria -->
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th>Bobot Kriteria</th>
                                    <!-- tampil bobot kriteria -->
                                    <?php
                                            $query_row2x1 = mysqli_query(
                                                $conn,
                                                "SELECT * FROM tb_periode_has_kriteria
                                                        INNER JOIN tb_kriteria
                                                        ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                        INNER JOIN tb_periode
                                                        ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                        WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'"
                                            );

                                            while ($row2x1 = mysqli_fetch_array($query_row2x1)) {
                                                $id_kriteria2x1 =  $row2x1['id_kriteria'];
                                                $bobot_kriteria2x1 =  $row2x1['bobot_kriteria'];
                                                // query tampil bobot kriteria
                                                $query_row2x2 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                            INNER JOIN tb_kriteria
                                                            ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                            INNER JOIN tb_periode
                                                            ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                            WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "' and tb_periode_has_kriteria.id_kriteria ='" . $id_kriteria2x1 . "'"
                                                );
                                                // query tampil bobot kriteria
                                                ?>

                                        <td class="text-center">
                                            <?php
                                                        while ($row2x2 = mysqli_fetch_array($query_row2x2)) {
                                                            // query tampil total bobot
                                                            $result_total_bobot2x2 = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
                                                                                    inner join tb_kriteria
                                                                                    on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                    where tb_periode_has_kriteria.id_periode ='" . $id_periode1x1 . "'");

                                                            $total2x2 = mysqli_fetch_array($result_total_bobot2x2);
                                                            $total_bobot2x2 = $total2x2['total_bobot'];
                                                            // query tampil total bobot
                                                            echo $bobot_kriteria2x1;
                                                            ?>
                                            <?php
                                                        }
                                                        ?>
                                        </td>
                                    <?php
                                            }
                                            ?>
                                    <td class="text-center"><?php echo $total_bobot2x2 ?></td>
                                </tr>
                                <!-- tampil bobot kriteria -->
                                <tr>
                                    <th>Bobot Normalisasi Kriteria</th>
                                    <!-- tampil bobot kriteria -->
                                    <?php
                                            $query_row3x1 = mysqli_query(
                                                $conn,
                                                "SELECT * FROM tb_periode_has_kriteria
                                                INNER JOIN tb_kriteria
                                                ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                INNER JOIN tb_periode
                                                ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'"
                                            );
                                            $bobot_normalisasi3x2 = 0;
                                            while ($row3x1 = mysqli_fetch_array($query_row3x1)) {
                                                $id_kriteria3x1 =  $row3x1['id_kriteria'];
                                                $bobot_kriteria3x1 =  $row3x1['bobot_kriteria'];
                                                // query tampil bobot kriteria
                                                $query_row3x2 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                            INNER JOIN tb_kriteria
                                                            ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                            INNER JOIN tb_periode
                                                            ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                            WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "' and tb_periode_has_kriteria.id_kriteria ='" . $id_kriteria3x1 . "'"
                                                );
                                                // query tampil bobot kriteria

                                                ?>
                                        <td class="text-center">
                                            <?php
                                                        while ($row3x2 = mysqli_fetch_array($query_row3x2)) {

                                                            $result_total_bobot3x2 = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
                                                                                    inner join tb_kriteria
                                                                                    on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                    where tb_periode_has_kriteria.id_periode ='" . $id_periode1x1 . "'");

                                                            $total3x2 = mysqli_fetch_array($result_total_bobot3x2);
                                                            $total_bobot3x2 = $total3x2['total_bobot'];
                                                            $bobot_normalisasi3x2 = $bobot_kriteria3x1 / $total_bobot3x2;
                                                            $total_bobot_normalisasi3x2 += $bobot_normalisasi3x2;
                                                            // query tampil total bobot
                                                            echo $bobot_normalisasi3x2;
                                                            ?>
                                            <?php
                                                        }
                                                        ?>
                                        </td>
                                    <?php
                                            }
                                            ?>
                                    <td class="text-center"><?php echo $total_bobot_normalisasi3x2  ?></td>
                                </tr>
                                <!-- tampil bobot kriteria -->
                            </table>
                            <br />
                            <!-- /tabel bobot normalisasi -->

                            <!-- tabel nilai ultility -->
                            <div style="text-align: center">
                                <label>
                                    <h3 class="panel-title" style=" font-size:15pt"><b>Tabel Nilai Ultility</b></h3>
                                </label>
                            </div>

                            <table id="tb_nilai_ultility" class="table table-bordered table-striped table-hover nw">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Teknisi</th>
                                        <?php $query_row4x1 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                            INNER JOIN tb_kriteria
                                                            ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                            INNER JOIN tb_periode
                                                            ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                            WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'"
                                                );

                                                while ($row4x1 = mysqli_fetch_array($query_row4x1)) {
                                                    $id_periode4x1 = $row4x1['id_periode'];
                                                    $nama_periode4x1 = $row4x1['nama_periode'];
                                                    $nama_kriteria4x1 = $row4x1['nama_kriteria'];
                                                    ?>
                                            <th class="text-center"><?php echo $nama_kriteria4x1 ?></th>
                                        <?php
                                                }
                                                ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                            $query_teknisi2x1 = mysqli_query($conn, "SELECT tb_nilai.id_periode ,tb_nilai.nik ,tb_teknisi.nama FROM tb_nilai
                                        INNER JOIN tb_teknisi
                                        on tb_nilai.nik = tb_teknisi.nik
                                        where tb_nilai.id_periode = '" . $id_periode1x1 . "'
                                        group by tb_nilai.nik
                                        ");

                                            while ($data_teknisi2x1 = mysqli_fetch_assoc($query_teknisi2x1)) {
                                                $nik2x1 = $data_teknisi2x1['nik'];
                                                $nama_teknisi2x1 = $data_teknisi2x1['nama']; ?>
                                        <tr>
                                            <td><?php echo $nama_teknisi2x1 ?></td>

                                            <?php
                                                        $query_periode_has_kriteria2x2 = mysqli_query($conn, "SELECT *, tb_periode.nama_periode FROM tb_periode_has_kriteria
                                                                                                inner Join tb_periode
                                                                                                on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                                                INNER JOIN tb_kriteria
                                                                                                ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                                WHERE tb_periode_has_kriteria.id_periode = '" . $id_periode1x1 . "'");

                                                        while ($data_periode_has_kriteria2x2 = mysqli_fetch_array($query_periode_has_kriteria2x2)) {

                                                            $id_kriteria2x2 = $data_periode_has_kriteria2x2['id_kriteria'];
                                                            $query_subkriteria2x2 = mysqli_query($conn, "SELECT tb_nilai.id_periode,tb_nilai.nik, tb_nilai.id_kriteria, tb_subkriteria.nilai_sub_kriteria From tb_nilai
                                                                                            inner join tb_subkriteria
                                                                                            on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                                                                            Where tb_nilai.id_kriteria = '" . $id_kriteria2x2 . "' and tb_nilai.nik ='" . $nik2x1 . "' and tb_nilai.id_periode ='" . $id_periode4x1 . "'");
                                                            ?>

                                                <td class="text-center">
                                                    <?php
                                                                    while ($datasub2x2 = mysqli_fetch_array($query_subkriteria2x2)) {
                                                                        $nilai_ultility2x2 = $datasub2x2['nilai_sub_kriteria'];
                                                                        echo $nilai_ultility2x2;
                                                                    }
                                                                    ?>
                                                </td>
                                            <?php
                                                        }
                                                        ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- /tabel nilai ultility -->
                            <br />

                            <!-- tabel hasil perangkingan -->
                            <div style="text-align: center">
                                <label>
                                    <h3 class="panel-title" style=" font-size:15pt"><b>Tabel Nilai Akhir</b></h3>
                                </label>
                            </div>

                            <table id="tb_nilai_akhir" class="table table-bordered table-striped table-hover nw" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Teknisi</th>

                                        <?php
                                                $query_periode_has_kriteria = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                INNER JOIN tb_kriteria
                                                ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                INNER JOIN tb_periode
                                                ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'
                                                "
                                                );

                                                while ($data_periode_has_kriteria = mysqli_fetch_array($query_periode_has_kriteria)) {
                                                    $id_periode = $data_periode_has_kriteria['id_periode'];
                                                    $nama_periode = $data_periode_has_kriteria['nama_periode'];

                                                    ?>
                                            <th class="text-center"><?php echo $data_periode_has_kriteria['nama_kriteria'] ?></th>
                                        <?php
                                                }
                                                ?>
                                        <th class="text-center">Total Nilai</th>
                                        <th class="text-center">Rank</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                            $rank = 1;
                                            $arraytotal_nilai = [];
                                            $query_teknisi = mysqli_query($conn, "SELECT tb_nilai.nilai_akhir, tb_nilai.id_periode ,tb_nilai.nik ,tb_teknisi.nama FROM tb_nilai
                                        INNER JOIN tb_teknisi
                                        on tb_nilai.nik = tb_teknisi.nik
                                        where tb_nilai.id_periode = '" . $id_periode . "'
                                        group by tb_nilai.nik
                                        order by tb_nilai.nilai_akhir desc 
                                        
                                        ");

                                            while ($data_teknisi = mysqli_fetch_assoc($query_teknisi)) {
                                                $nik = $data_teknisi['nik'];
                                                $nama_teknisi = $data_teknisi['nama'];
                                                $nilai_akhir = $data_teknisi['nilai_akhir'];
                                                ?>
                                        <tr>
                                            <td><?php echo $nama_teknisi ?></td>

                                            <?php
                                                        $total_nilai = 0;
                                                        $query_periode_has_kriteria2 = mysqli_query($conn, "SELECT *, tb_periode.nama_periode FROM tb_periode_has_kriteria
                                                                                            inner Join tb_periode
                                                                                            on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                                            INNER JOIN tb_kriteria
                                                                                            ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                            WHERE tb_periode_has_kriteria.id_periode = '" . $id_periode . "'");

                                                        while ($data_periode_has_kriteria2 = mysqli_fetch_array($query_periode_has_kriteria2)) {

                                                            $nama_periode2 = $data_periode_has_kriteria2['nama_periode'];
                                                            $id_periode2 = $data_periode_has_kriteria2['id_periode'];
                                                            $id_kriteria = $data_periode_has_kriteria2['id_kriteria'];
                                                            $bobot_kriteria = $data_periode_has_kriteria2['bobot_kriteria'];

                                                            $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
                                                                                    inner join tb_kriteria
                                                                                    on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                    where tb_periode_has_kriteria.id_periode ='" . $id_periode . "'");

                                                            while ($data_total_bobot = mysqli_fetch_array($result_total_bobot)) {
                                                                $bobot_normalisasi = $bobot_kriteria / $data_total_bobot['total_bobot'];
                                                                $query_subkriteria = mysqli_query($conn, "SELECT tb_nilai.nilai_akhir, tb_nilai.nik,tb_nilai.id_periode, tb_nilai.id_kriteria, tb_subkriteria.nilai_sub_kriteria From tb_nilai
                                                                                        inner join tb_subkriteria
                                                                                        on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                                                                        Where tb_nilai.id_kriteria = '" . $id_kriteria . "' and tb_nilai.nik ='" . $nik . "' and tb_nilai.id_periode ='" . $id_periode2 . "'
                                                                                        ");
                                                                ?>

                                                    <td class="text-center">
                                                        <?php
                                                                            while ($datasub = mysqli_fetch_array($query_subkriteria)) {
                                                                                $nilai_ultility = $datasub['nilai_sub_kriteria'] * $bobot_normalisasi;
                                                                                $total_nilai += $nilai_ultility;
                                                                                echo $nilai_ultility;
                                                                            }


                                                                            ?>
                                                    </td>
                                            <?php
                                                            }
                                                        }
                                                        $query_update_nilai_akhir = mysqli_query($conn, "Update tb_nilai set nilai_akhir ='" . $total_nilai . "' where nik ='" . $nik . "' and id_periode ='" . $id_periode2 . "' ");
                                                        ?>
                                            <td class="text-center"><?php echo $total_nilai ?></td>
                                            <td class="text-center"><?php echo $rank++ ?></td>
                                        <?php
                                                }
                                                ?>
                                        </tr>
                                </tbody>
                            </table>
                        <?php
                            }
                            // Filter Berdasarkan Periode

                            // Filter Berdasarkan Bulan Sekarang
                            else { ?>
                            <label>
                                <h2><b>Hasil Perhitungan Periode <a style="color:blue;"><?php echo $tanggal; ?></a></b></h2>
                            </label>
                            <br />
                            <br />

                            <!-- tabel bobot normalisasi -->
                            <div style="text-align: center">
                                <label>
                                    <h3 class="panel-title" style=" font-size:15pt"><b>Tabel Normalisasi Bobot</b></h3>
                                </label>
                            </div>

                            <table class="table table-bordered table-striped table-hover nw">
                                <thead>
                                    <tr>
                                        <th class="text-center">-</th>
                                        <!-- tampil nama kriteria -->
                                        <?php $query_row1x1 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                                INNER JOIN tb_kriteria
                                                                ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                INNER JOIN tb_periode
                                                                ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                WHERE tb_periode.nama_periode = '" . $tanggal . "'"
                                                );

                                                while ($row1x1 = mysqli_fetch_array($query_row1x1)) {
                                                    $id_periode1x1 = $row1x1['id_periode'];
                                                    $nama_periode1x1 = $row1x1['nama_periode'];
                                                    $nama_kriteria1x1 = $row1x1['nama_kriteria'];
                                                    ?>
                                            <th class="text-center"><?php echo $nama_kriteria1x1 ?></th>
                                        <?php
                                                }
                                                ?>
                                        <!-- tampil nama kriteria -->
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th>Bobot Kriteria</th>
                                    <!-- tampil bobot kriteria -->
                                    <?php
                                            $query_row2x1 = mysqli_query(
                                                $conn,
                                                "SELECT * FROM tb_periode_has_kriteria
                                                            INNER JOIN tb_kriteria
                                                            ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                            INNER JOIN tb_periode
                                                            ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                            WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'"
                                            );

                                            while ($row2x1 = mysqli_fetch_array($query_row2x1)) {
                                                $id_kriteria2x1 =  $row2x1['id_kriteria'];
                                                $bobot_kriteria2x1 =  $row2x1['bobot_kriteria'];
                                                // query tampil bobot kriteria
                                                $query_row2x2 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                                INNER JOIN tb_kriteria
                                                                ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                INNER JOIN tb_periode
                                                                ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "' and tb_periode_has_kriteria.id_kriteria ='" . $id_kriteria2x1 . "'"
                                                );
                                                // query tampil bobot kriteria
                                                ?>

                                        <td class="text-center">
                                            <?php
                                                        while ($row2x2 = mysqli_fetch_array($query_row2x2)) {
                                                            // query tampil total bobot
                                                            $result_total_bobot2x2 = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
                                                                                        inner join tb_kriteria
                                                                                        on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                        where tb_periode_has_kriteria.id_periode ='" . $id_periode1x1 . "'");

                                                            $total2x2 = mysqli_fetch_array($result_total_bobot2x2);
                                                            $total_bobot2x2 = $total2x2['total_bobot'];
                                                            // query tampil total bobot
                                                            echo $bobot_kriteria2x1;
                                                            ?>
                                            <?php
                                                        }
                                                        ?>
                                        </td>
                                    <?php
                                            }
                                            ?>
                                    <td class="text-center"><?php echo $total_bobot2x2 ?></td>
                                </tr>
                                <!-- tampil bobot kriteria -->
                                <tr>
                                    <th>Bobot Normalisasi Kriteria</th>
                                    <!-- tampil bobot kriteria -->
                                    <?php
                                            $query_row3x1 = mysqli_query(
                                                $conn,
                                                "SELECT * FROM tb_periode_has_kriteria
                                                            INNER JOIN tb_kriteria
                                                            ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                            INNER JOIN tb_periode
                                                            ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                            WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'"
                                            );
                                            $bobot_normalisasi3x2 = 0;
                                            while ($row3x1 = mysqli_fetch_array($query_row3x1)) {
                                                $id_kriteria3x1 =  $row3x1['id_kriteria'];
                                                $bobot_kriteria3x1 =  $row3x1['bobot_kriteria'];
                                                // query tampil bobot kriteria
                                                $query_row3x2 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                                INNER JOIN tb_kriteria
                                                                ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                INNER JOIN tb_periode
                                                                ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "' and tb_periode_has_kriteria.id_kriteria ='" . $id_kriteria3x1 . "'"
                                                );
                                                // query tampil bobot kriteria

                                                ?>
                                        <td class="text-center">
                                            <?php
                                                        while ($row3x2 = mysqli_fetch_array($query_row3x2)) {

                                                            $result_total_bobot3x2 = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_periode_has_kriteria
                                                                                            inner join tb_kriteria
                                                                                            on tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                            where tb_periode_has_kriteria.id_periode ='" . $id_periode1x1 . "'");
                                                            $total3x2 = mysqli_fetch_array($result_total_bobot3x2);
                                                            $total_bobot3x2 = $total3x2['total_bobot'];
                                                            $bobot_normalisasi3x2 = $bobot_kriteria3x1 / $total_bobot3x2;
                                                            $total_bobot_normalisasi3x2 += $bobot_normalisasi3x2;
                                                            // query tampil total bobot
                                                            echo $bobot_normalisasi3x2;
                                                            ?>
                                            <?php
                                                        }
                                                        ?>
                                        </td>
                                    <?php
                                            }
                                            ?>
                                    <td class="text-center"><?php echo $total_bobot_normalisasi3x2  ?></td>
                                </tr>
                                <!-- tampil bobot kriteria -->
                            </table>
                            <br />
                            <!-- /tabel bobot normalisasi -->

                            <!-- tabel nilai ultility -->
                            <div style="text-align: center">
                                <label>
                                    <h3 class="panel-title" style=" font-size:15pt"><b>Tabel Nilai Ultility</b></h3>
                                </label>
                            </div>

                            <table id="tb_nilai_ultility" class="table table-bordered table-striped table-hover nw">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Teknisi</th>
                                        <?php $query_row4x1 = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                                INNER JOIN tb_kriteria
                                                                ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                INNER JOIN tb_periode
                                                                ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'"
                                                );

                                                while ($row4x1 = mysqli_fetch_array($query_row4x1)) {
                                                    $id_periode4x1 = $row4x1['id_periode'];
                                                    $nama_periode4x1 = $row4x1['nama_periode'];
                                                    $nama_kriteria4x1 = $row4x1['nama_kriteria'];
                                                    ?>
                                            <th class="text-center"><?php echo $nama_kriteria4x1 ?></th>
                                        <?php
                                                }
                                                ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                            $query_teknisi2x1 = mysqli_query($conn, "SELECT tb_nilai.id_periode ,tb_nilai.nik ,tb_teknisi.nama FROM tb_nilai
                                                                INNER JOIN tb_teknisi
                                                                on tb_nilai.nik = tb_teknisi.nik
                                                                where tb_nilai.id_periode = '" . $id_periode1x1 . "'
                                                                group by tb_nilai.nik");

                                            while ($data_teknisi2x1 = mysqli_fetch_assoc($query_teknisi2x1)) {
                                                $nik2x1 = $data_teknisi2x1['nik'];
                                                $nama_teknisi2x1 = $data_teknisi2x1['nama'];
                                                ?>
                                        <tr>
                                            <td><?php echo $nama_teknisi2x1 ?></td>

                                            <?php
                                                        $query_periode_has_kriteria2x2 = mysqli_query($conn, "SELECT *, tb_periode.nama_periode FROM tb_periode_has_kriteria
                                                                    inner Join tb_periode
                                                                    on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                    INNER JOIN tb_kriteria
                                                                    ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                    WHERE tb_periode_has_kriteria.id_periode = '" . $id_periode1x1 . "'");

                                                        while ($data_periode_has_kriteria2x2 = mysqli_fetch_array($query_periode_has_kriteria2x2)) {

                                                            $id_kriteria2x2 = $data_periode_has_kriteria2x2['id_kriteria'];
                                                            $query_subkriteria2x2 = mysqli_query($conn, "SELECT tb_nilai.nik, tb_nilai.id_kriteria, tb_subkriteria.nilai_sub_kriteria From tb_nilai
                                                                        inner join tb_subkriteria
                                                                        on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                                                        Where tb_nilai.id_kriteria = '" . $id_kriteria2x2 . "' and tb_nilai.nik ='" . $nik2x1 . "' and tb_nilai.id_periode='" . $id_periode1x1 . "'");
                                                            ?>

                                                <td class="text-center">
                                                    <?php
                                                                    while ($datasub2x2 = mysqli_fetch_array($query_subkriteria2x2)) {
                                                                        $nilai_ultility2x2 = $datasub2x2['nilai_sub_kriteria'];
                                                                        echo $nilai_ultility2x2;
                                                                    }
                                                                    ?>
                                                </td>
                                            <?php
                                                        }
                                                        ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- /tabel nilai ultility -->
                            <br />

                            <!-- tabel hasil perangkingan -->
                            <div style="text-align: center">
                                <label>
                                    <h3 class="panel-title" style=" font-size:15pt"><b>Tabel Nilai Akhir</b></h3>
                                </label>
                            </div>

                            <table id="tb_nilai_akhir" class="table table-bordered table-striped table-hover nw" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Teknisi</th>

                                        <?php
                                                $query_periode_has_kriteria = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM tb_periode_has_kriteria
                                                    INNER JOIN tb_kriteria
                                                    ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                    INNER JOIN tb_periode
                                                    ON tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                    WHERE tb_periode.nama_periode = '" . $nama_periode1x1 . "'"
                                                );

                                                while ($data_periode_has_kriteria = mysqli_fetch_array($query_periode_has_kriteria)) {
                                                    $id_periode = $data_periode_has_kriteria['id_periode'];
                                                    $nama_periode = $data_periode_has_kriteria['nama_periode'];

                                                    ?>
                                            <th class="text-center"><?php echo $data_periode_has_kriteria['nama_kriteria'] ?></th>
                                        <?php
                                                }
                                                ?>
                                        <th class="text-center">Total Nilai</th>
                                        <th class="text-center">Rank</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                            $rank = 1;
                                            $query_teknisi = mysqli_query($conn, "SELECT tb_nilai.id_periode ,tb_nilai.nik ,tb_teknisi.nama FROM tb_nilai
                                                            INNER JOIN tb_teknisi
                                                            on tb_nilai.nik = tb_teknisi.nik
                                                            where tb_nilai.id_periode = '" . $id_periode . "'
                                                            group by tb_nilai.nik
                                                            order by tb_nilai.nilai_akhir desc");

                                            while ($data_teknisi = mysqli_fetch_assoc($query_teknisi)) {

                                                $nik = $data_teknisi['nik'];
                                                $nama_teknisi = $data_teknisi['nama'];
                                                $nilai_akhir = $data_teknisi['nilai_akhir'];
                                                ?>
                                        <tr>
                                            <td><?php echo $nama_teknisi ?></td>

                                            <?php

                                                        $total_nilai = 0;
                                                        $query_periode_has_kriteria2 = mysqli_query($conn, "SELECT *, tb_periode.nama_periode FROM tb_periode_has_kriteria
                                                                                        inner Join tb_periode
                                                                                        on tb_periode_has_kriteria.id_periode = tb_periode.id_periode
                                                                                        INNER JOIN tb_kriteria
                                                                                        ON tb_periode_has_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                                                                        WHERE tb_periode_has_kriteria.id_periode = '" . $id_periode . "'");

                                                        while ($data_periode_has_kriteria2 = mysqli_fetch_array($query_periode_has_kriteria2)) {

                                                            $nama_periode2 = $data_periode_has_kriteria2['nama_periode'];
                                                            $id_periode2 = $data_periode_has_kriteria2['id_periode'];
                                                            $id_kriteria = $data_periode_has_kriteria2['id_kriteria'];
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
                                                                                        Where tb_nilai.id_kriteria = '" . $id_kriteria . "' and tb_nilai.nik ='" . $nik . "'and tb_nilai.id_periode='" . $id_periode2 . "'");
                                                                ?>

                                                    <td class="text-center">
                                                        <?php
                                                                            while ($datasub = mysqli_fetch_array($query_subkriteria)) {
                                                                                $nilai_ultility = $datasub['nilai_sub_kriteria'] * $bobot_normalisasi;
                                                                                $total_nilai += $nilai_ultility;
                                                                                echo $nilai_ultility;
                                                                            }
                                                                            ?>
                                                    </td>
                                            <?php
                                                            }
                                                        }
                                                        $query_update_nilai_akhir = mysqli_query($conn, "Update tb_nilai set nilai_akhir ='" . $total_nilai . "' where nik ='" . $nik . "' and id_periode ='" . $id_periode2 . "' ")
                                                        ?>
                                            <td class="text-center"><?php echo $total_nilai ?></td>
                                            <td class="text-center"><?php echo $rank++ ?></td>
                                        <?php
                                                }
                                                ?>
                                        </tr>
                                </tbody>
                            </table>
                        <?php } ?>
                        <!--Filter Berdasarkan Bulan Sekarang -->

                    </div>
                    <form method="POST" action="laporan_perankingan.php" target="_blank">
                        <input type="hidden" name="periode" value="<?php echo $nama_periode ?>">
                        <button type="submit" class="btn btn-primary" name="cetak_laporan" id="cetak_laporan"><i class="fa fa-print"></i> Cetak Laporan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    </div>

    <!-- /page content -->

    <?php include('footer.php'); ?>

    </div>
    </div>

    <?php include('../config/javascript.php'); ?>

    <script>
        $(".select-search-periode").select2({
            placeholder: "-- Pilih Periode --",
            allowClear: true
        });


        $(function() {
            $('#tb_nilai_ultility').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
            });
        });
        $(function() {
            $('#tb_nilai_akhir').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>

<?php
} else {
    echo "<script>
        alert('Anda Belum Login!!!');window.location=(href='login.php');
    </script>";
}


?>
</body>

    </html>