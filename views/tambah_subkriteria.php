<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SPK | Update Teknisi</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- jQuery -->
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap -->
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../assets/build/css/custom.min.css" rel="stylesheet">

</head>


<!-- header -->
<?php include('header.php'); ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Kriteria</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tambah Data Sub Kriteria</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="demo-form" data-parsley-validate method="post">
                            <?php
                            include('../config/koneksi.php');

                            $id_kriteria = $_GET['id_kriteria'];
                            $query = "SELECT * FROM tb_kriteria WHERE id_kriteria = '$id_kriteria' ";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $id_kriteria = $row['id_kriteria'];
                                $nama_kriteria = $row['nama_kriteria'];
                            }
                            ?>

                            <input type="hidden" name="id_kriteria" class="form-control" id="nik" value="<?php echo $id_kriteria ?>">

                            <label class="control-label" for="nama_kriteria">Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" value="<?php echo $nama_kriteria ?>" readonly>

                            <label class="control-label" for="nama_sub_kriteria">Nama Sub Kriteria</label>
                            <input type="text" name="nama_sub_kriteria" class="form-control" id="nama_sub_kriteria" placeholder="Nama Sub Kriteria" required autofocus="autofocus" />

                            <label class="control-label" for="nilai_sub_kriteria">Nilai Sub Kriteria</label>
                            <input type="number" name="nilai_sub_kriteria" class="form-control" id="nilai_sub_kriteria" placeholder="Nilai Sub Kriteria (0-100)">

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="">
                                    <a href="datakriteria.php" class="btn btn-default">Batal</a>
                                    <button type="submit" class="btn btn-primary" name="simpan" id="update">Simpan</button>
                                </div>
                            </div>
                        </form>

                        <?php

                        if (isset($_POST['simpan'])) {
                            if ($_POST['nilai_sub_kriteria'] <= 100) {
                                $nama_sub_kriteria = mysqli_real_escape_string($conn, $_POST["nama_sub_kriteria"]);
                                $nilai_sub_kriteria = mysqli_real_escape_string($conn, $_POST["nilai_sub_kriteria"]);
                                $query_tambah = "INSERT INTO tb_subkriteria (id_sub_kriteria, nama_sub_kriteria, nilai_sub_kriteria, id_kriteria) VALUES ('','$nama_sub_kriteria','$nilai_sub_kriteria','$id_kriteria')";
                                $tambah = mysqli_query($conn, $query_tambah);
                                if ($tambah) {
                                    echo "<script>  window.alert('Data Berhasil Disimpan');
                                    window.location = (href = 'datakriteria.php')
                                        </script>";
                                } else {
                                    echo "<script>
                                                window.alert('Data Gagal Disimpan');
                                    </script>";
                                }
                            } else {
                                echo "<script> window.alert('Nilai Sub Kriteria maksimal 100') </script>";
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page content -->
</div>
<?php include('footer.php'); ?>
</div>


<!-- NProgress -->
<script src="../assets/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="../assets/vendors/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
<script src="../assets/vendors/jszip/dist/jszip.min.js"></script>
<script src="../assets/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../assets/vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- Custom Theme Scripts -->
<script src="../assets/build/js/custom.min.js"></script>
</body>

</html>