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
<?php include('header.php');
include('../config/koneksi.php'); ?>

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
                        <h2>Ubah Data Sub Kriteria</h2>
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
                            <div class="container">
                                <div class="row">

                                    <?php
                                    $id_kriteria = $_GET['id_kriteria'];
                                    $query = "SELECT tb_subkriteria.id_sub_kriteria, tb_subkriteria.nama_sub_kriteria, tb_subkriteria.nilai_sub_kriteria , tb_kriteria.nama_kriteria FROM tb_subkriteria 
                                    INNER JOIN tb_kriteria
                                    on tb_subkriteria.id_kriteria = tb_kriteria.id_kriteria
                                    WHERE tb_kriteria.id_kriteria = '$id_kriteria'";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        ?>

                                        <input type='hidden' class="form-control" name="id_sub_kriteria" id="id_sub_kriteria" value="<?php echo $row['id_sub_kriteria'] ?>" />

                                        <div class='col-sm-4'>
                                            <label> Nama Kriteria </label>
                                            <div class="form-group">
                                                <input type='text' class="form-control" name="id_kriteria" id="id_kriteria" value="<?php echo $row['nama_kriteria'] ?>" readonly />
                                            </div>
                                        </div>

                                        <div class='col-sm-4'>
                                            <label> Nama Sub Kriteria </label>
                                            <div class="form-group">
                                                <input type='text' class="form-control" name="nama_sub_kriteria" id="nama_sub_kriteria" value="<?php echo $row['nama_sub_kriteria'] ?>" autofocus />
                                            </div>
                                        </div>

                                        <div class='col-sm-4'>
                                            <label> Nilai Sub Kriteria</label>
                                            <div class="form-group">
                                                <input type='text' name="nilai_sub_kriteria" id="nilai_sub_kriteria" class="form-control" value="<?php echo $row['nilai_sub_kriteria'] ?>" />
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="">
                                        <a href="datakriteria.php" class="btn btn-default">Batal</a>
                                        <button type="submit" class="btn btn-primary" name="update" id="update">Ubah</button>
                                    </div>
                                </div>
                            </div>

                            <?php

                            if (isset($_POST['update'])) {

                                if ($_POST['nilai_sub_kriteria'] <= 100) {

                                    $id_kriteria = mysqli_real_escape_string($conn, $_POST["id_kriteria"]);
                                    $id_sub_kriteria = mysqli_real_escape_string($conn, $_POST["id_sub_kriteria"]);
                                    $nama_sub_kriteria = mysqli_real_escape_string($conn, $_POST["nama_sub_kriteria"]);
                                    $nilai_sub_kriteria = mysqli_real_escape_string($conn, $_POST["nilai_sub_kriteria"]);
                                    $query_ubah = "UPDATE tb_subkriteria SET nama_sub_kriteria ='" . $nama_sub_kriteria . "', nilai_sub_kriteria ='" . $nilai_sub_kriteria . "' WHERE id_sub_kriteria ='" . $id_sub_kriteria . "'";
                                    $ubah = mysqli_query($conn, $query_ubah);
                                    if ($ubah) {
                                        echo "<script>  window.alert('Data Berhasil Disimpan');
                                    window.location = (href = 'datakriteria.php');
                                        </script>";
                                    } else {
                                        echo "<script>
                                            window.alert('Data Gagal Disimpan');
                                            window.location = (href = 'datakriteria.php');
                                    </script>";
                                    }
                                } else {
                                    echo "<script> window.alert('Nilai Sub Kriteria maksimal 100'); 
                                    window.location = (href = 'datasubkriteria.php?id_kriteria=" . $id_kriteria . "');
                                    </script>";
                                }
                            }

                            ?>
                        </form>
                    </div>
                </div>
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