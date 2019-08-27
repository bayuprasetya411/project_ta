<?php
include('../config/koneksi.php');

$nik = $_GET['nik'];
$query = "SELECT * FROM tb_teknisi WHERE nik = $nik ";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $nik = $row['nik'];
    $nama = $row['nama'];
    $id_area = $row['id_area'];
    $no_telpon = $row['no_telpon'];
}

if (isset($_POST['update'])) {
    $nik = mysqli_real_escape_string($conn, $_POST["nik"]);
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $no_telpon = mysqli_real_escape_string($conn, $_POST["no_telpon"]);
    $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);
    $sql = "UPDATE tb_teknisi SET nama ='" . $nama . "', id_area ='" . $id_area . "', no_telpon='" . $no_telpon . "' WHERE nik='" . $nik . "'";
    $update = mysqli_query($conn, $sql);
    if ($update) {
        echo "<script>window.alert('Data Berhasil Diubah');
                window.location=(href='datateknisi.php')</script>";
    } else {
        echo "<script>window.alert('Data Gagal Diubah');
    window.location=(href='update_teknisi.php?nik=" . $nik . "')</script>";
    }
}

?>

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

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Teknisi</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Ubah Data Teknisi<small>Corporate Service</small></h2>
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

                            <label class="control-label" for="nik">Nik Karyawan</label>
                            <input type="text" name="nik" class="form-control" id="nik" value="<?php echo $nik ?>" required>

                            <label class="control-label" for="nama">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $nama ?>" autofocus="autofocus" required>

                            <?php
                            $query_area = mysqli_query($conn, "SELECT * FROM tb_area ORDER BY id_area DESC");
                            ?>

                            <label class="control-label" for="id_area">
                                Area
                            </label>
                            <select name="id_area" class="form-control" aria-controls="dataTable" id="id_area">
                                <?php
                                while ($data = mysqli_fetch_array($query_area)) {
                                    if ($data['id_area'] == $id_area) {
                                        ?>
                                <option value="<?php echo $data['id_area'] ?>" selected> <?php echo $data['area']; ?></option>
                                <?php
                                    } else {
                                        ?>
                                <option value="<?php echo $data['id_area'] ?>"> <?php echo $data['area']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                            <label class="control-label" for="no_telpon">No Telpon (08xxxxxxxxxxxxxx)</label>
                            <input type="text" name="no_telpon" class="form-control" id="no_telpon" value="<?php echo $no_telpon ?>" required>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="">
                                    <a href="datateknisi.php" class="btn btn-default">Batal</a>
                                    <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
                                </div>
                            </div>

                        </form>
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