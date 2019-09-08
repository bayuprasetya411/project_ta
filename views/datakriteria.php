<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah kriteria
    if (isset($_POST['tambah_kriteria'])) {

        $id_kriteria = mysqli_real_escape_string($conn, $_POST["id_kriteria"]);
        $nama_kriteria = mysqli_real_escape_string($conn, $_POST["nama_kriteria"]);
        $bobot_kriteria = mysqli_real_escape_string($conn, $_POST["bobot_kriteria"]);

        if ($_POST['bobot_kriteria'] <= 100) {

            $querytambah = "INSERT INTO tb_kriteria (id_kriteria, nama_kriteria, bobot_kriteria) VALUES ('$id_kriteria','$nama_kriteria','$bobot_kriteria')";
            $insert = mysqli_query($conn, $querytambah);
            if ($insert) {
                echo "<script> window.alert('Data Berhasil Disimpan');
                            window.location=(href='datakriteria.php') </script>";
            } else {
                echo "<script> window.alert('Data Gagal Disimpan');
                window.location=(href='datakriteria.php') </script>";
            }
        } else {
            echo "<script> window.alert('bobot kriteria maksimal 100');
            window.location=(href='datakriteria.php'); </script>";
        }
    }
    // aksi tambah kriteria

    // aksi ubah kriteria
    if (isset($_POST['edit_kriteria'])) {

        if ($_POST['bobot_kriteria'] <= 100) {
            $id_kriteria = mysqli_real_escape_string($conn, $_POST["id_kriteria"]);
            $nama_kriteria = mysqli_real_escape_string($conn, $_POST["nama_kriteria"]);
            $bobot_kriteria = mysqli_real_escape_string($conn, $_POST["bobot_kriteria"]);
            $sql = "UPDATE tb_kriteria SET nama_kriteria ='" . $nama_kriteria . "', bobot_kriteria ='" . $bobot_kriteria . "' WHERE id_kriteria ='" . $id_kriteria . "'";
            $update = mysqli_query($conn, $sql);
            if ($update) {
                echo "<script>window.alert('Data Berhasil Diubah');
                        window.location=(href='datakriteria.php')</script>";
            } else {
                echo "<script>window.alert('Data Gagal Diubah');
                window.location=(href='datakriteria.php')</script>";
            }
        } else {
            echo "<script> window.alert('bobot kriteria maksimal 100');
            window.location=(href='datakriteria.php') </script>";
        }
    }
    // aksi ubah kriteria

    // aksi tambah sub Kriteria
    if (isset($_POST['tambah_sub'])) {
        $id_kriteria = mysqli_real_escape_string($conn, $_POST["id_kriteria"]);
        $nama_sub_kriteria = mysqli_real_escape_string($conn, $_POST["nama_sub_kriteria"]);
        $nilai_sub_kriteria = mysqli_real_escape_string($conn, $_POST["nilai_sub_kriteria"]);

        if ($nilai_sub_kriteria <= 100) {


            $query_tambah = "INSERT INTO tb_subkriteria (id_sub_kriteria, nama_sub_kriteria, nilai_sub_kriteria, id_kriteria) VALUES ('','$nama_sub_kriteria','$nilai_sub_kriteria','$id_kriteria')";
            $tambah = mysqli_query($conn, $query_tambah);
            if ($tambah) {
                echo "<script>
                alert('Data Berhasil di Simpan');
                window.location = (href = 'datakriteria.php');
                </script>";
            } else {
                echo "<script>
                alert('Data Gagal Diubah');
                window.location = (href = 'datakriteria.php')
                </script>";
            }
        } else {
            echo "<script>
        alert('Nilai Sub Kriteria Maksimal 100');
        window.location = (href = 'datakriteria.php')
        </script>";
        }
    }
    // aksi tambah sub Kriteria

    // aksi ubah sub kriteria
    if (isset($_POST['edit_subkriteria'])) {
        for ($i = 0; $i < count($_POST['id_sub_kriteria']); $i++) {

            $id_kriteria =  $_POST["id_kriteria"][$i];
            $id_sub_kriteria =  $_POST["id_sub_kriteria"][$i];
            $nama_sub_kriteria =  $_POST["nama_sub_kriteria"][$i];
            $nilai_sub_kriteria =  $_POST["nilai_sub_kriteria"][$i];
            $query_ubah = "UPDATE tb_subkriteria SET nama_sub_kriteria ='" . $nama_sub_kriteria . "', nilai_sub_kriteria ='" . $nilai_sub_kriteria . "' WHERE id_sub_kriteria ='" . $id_sub_kriteria . "'";
            $ubah = mysqli_query($conn, $query_ubah);
        }
        if ($ubah) {
            echo "<script>  window.alert('Data Berhasil di Ubah');
            window.location = (href = 'datakriteria.php');
                </script>";
        } else {
            echo "<script>
                    window.alert('Data Gagal di Ubah');
                    window.location = (href = 'datakriteria.php');
            </script>";
        }
    }
    // aksi ubah sub kriteria
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>SPK | Data Kriteria</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <!-- Bootstrap -->
        <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../assets/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../assets/build/css/custom.min.css" rel="stylesheet">
        <link href="../assets/build/css/style.css" rel="stylesheet">

    </head>

    <!-- header -->
    <?php include('header.php'); ?>

    <!-- Page Content -->

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Data Kriteria</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabel Data Kriteria<small>Corporate Service</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <button class="btn btn-success" id="btn-input" name="btn-input" href="#" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Kriteria</button>
                        <div class="table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID Kriteria</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot Kriteria</th>
                                        <th>Bobot Normaliasi Kriteria</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM tb_kriteria ";
                                        $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_kriteria");
                                        $result = mysqli_query($conn, $query);
                                        $data_total_bobot = mysqli_fetch_array($result_total_bobot);
                                        while ($data = mysqli_fetch_array($result)) {

                                            ?>
                                        <tr>
                                            <td><?php echo $data['id_kriteria']; ?></td>
                                            <td><?php echo $data['nama_kriteria']; ?></td>
                                            <td><?php echo $data['bobot_kriteria']; ?></td>
                                            <td><?php echo $data['bobot_kriteria'] / $data_total_bobot['total_bobot']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-xs edit_datakriteria" id="<?php echo $data['id_kriteria']; ?>"><i class="fa fa-wrench"></i></button>
                                                <button type="button" class="btn btn-success btn-xs tambahsub_data" id="<?php echo $data['id_kriteria']; ?>"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-warning btn-xs detail_datasubkriteria" id="<?php echo $data['id_kriteria']; ?>"><i class="fa fa-book"></i></button>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!--/Page Content -->
        </div>
    </div>
    <!-- Footer -->
    <?php include('footer.php'); ?>
    </div>
    <!-- /menu content -->


    <!-- Modal Tambah kriteria -->
    <?php

        $sql = mysqli_query($conn, "SELECT id_kriteria FROM tb_kriteria ORDER BY id_kriteria DESC");
        $id = mysqli_fetch_array($sql);
        $id_kriteria = $id['id_kriteria'];
        $no = substr($id_kriteria, 1);
        $tambah = (int) $no + 1;

        if (strlen($tambah) == 1) {
            $kode = "C" . $tambah;
        }
        ?>

    <div id="modal-input" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalinput">Tambah Data Kriteria</h2>

                </div>

                <form id="form_tambah" method="post" role="form" action="">
                    <div class="modal-body">
                        <div class="form-group" id="tabel_tambah">
                            <label class="control-label" for="id_kriteria">
                                ID Kriteria
                            </label>
                            <input type="text" name="id_kriteria" class="form-control" id="id_kriteria" Value="<?php echo $kode ?>" required readonly />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama_kriteria">
                                Nama Kriteria
                            </label>
                            <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" required autofocus="" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="bobot_kriteria">
                                Bobot Kriteria
                            </label>
                            <input type="number" name="bobot_kriteria" class="form-control" id="bobot_kriteria" required placeholder="Bobot Kriteria (1-100)">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah_kriteria" class="btn btn-primary" id="tambah">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Tambah kriteria -->

    <!-- Modal edit kriteria -->
    <div id="modal-edit-kriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaleditkriteria">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modaleditkriteria">Ubah Data Kriteria</h2>

                </div>

                <form id="form_edit_kriteria" method="post" role="form" action="">
                    <div class="modal-body" id="info-editkriteria">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="edit_kriteria" class="btn btn-primary" id="edit_kriteria">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit kriteria -->

    <!-- Modal Data Subkriteria -->
    <div id="modal-subkriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
        <div class="modal-dialog" role="documnet" id="info-sub">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalinput">Tambah Data Sub Kriteria</h2>
                </div>
                <form id="form_tambah_sub" method="post" role="form" action="">
                    <div class="modal-body" id="info-subkriteria">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah_sub" class="btn btn-primary" id="tambah_sub">Tambah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Modal Data Subkriteria -->

    <!-- Modal edit subkriteria -->
    <div id="modal-edit-subkriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaledit">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modaledit">Ubah Data Sub Kriteria</h2>

                </div>

                <form id="form_edit_subkriteria" method="post" role="form" action="">
                    <div class="modal-body" id="info-editsub">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="edit_subkriteria" class="btn btn-primary" id="edit_subkriteria">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit subkriteria -->

    <!-- jQuery -->
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../assets/vendors/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- Datatables -->
    <script src="../assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="../assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../assets/build/js/custom.min.js"></script>

    <!-- script tambah kriteria -->
    <script>
        $(document).ready(function() {

            $(document).on('click', '.edit_datakriteria', function() {

                var edit_id_kriteria = $(this).attr('id');
                $.ajax({
                    url: "update_kriteria.php",
                    method: "POST",
                    data: {
                        edit_id_kriteria: edit_id_kriteria
                    },
                    success: function(data) {
                        $("#info-editkriteria").html(data);
                        $("#modal-edit-kriteria").modal("show");
                    }
                });

            });

            $(document).on('click', '.tambahsub_data', function() {

                var get_id_kriteria = $(this).attr('id');
                $.ajax({
                    url: "tambah_subkriteria.php",
                    method: "POST",
                    data: {
                        get_id_kriteria: get_id_kriteria
                    },
                    success: function(data) {
                        $("#info-subkriteria").html(data);
                        $("#modal-subkriteria").modal("show");
                    }
                });

            });

            $(document).on('click', '.detail_datasubkriteria', function() {

                var edit_id_subkriteria = $(this).attr('id');
                $.ajax({
                    url: "update_subkriteria.php",
                    method: "POST",
                    data: {
                        edit_id_subkriteria: edit_id_subkriteria
                    },
                    success: function(data) {
                        $("#info-editsub").html(data);
                        $("#modal-edit-subkriteria").modal("show");
                    }
                });

            });
        });
    </script>
    <!-- script tambah kriteria -->

<?php
} else {
    echo "<script>
    alert('Anda Belum Login!!!');window.location=(href='login.php');
    </script>";
}
?>
</body>

    </html>