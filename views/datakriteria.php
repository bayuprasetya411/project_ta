<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah kriteria
    if (isset($_POST['tambah_kriteria'])) {

        $id_kriteria = $_POST["id_kriteria"];
        $nama_kriteria = $_POST["nama_kriteria"];
        $bobot_kriteria = $_POST["bobot_kriteria"];

        if ($_POST['bobot_kriteria'] <= 100) {

            $query_tambah_kriteria = "INSERT INTO tb_kriteria (id_kriteria, nama_kriteria, bobot_kriteria) VALUES ('$id_kriteria','$nama_kriteria','$bobot_kriteria')";
            $insert_kriteria = mysqli_query($conn, $query_tambah_kriteria);
            if ($insert_kriteria) {
                echo "<script>window.location=(href='datakriteria.php?status=1')</script>";
            } else {
                echo "<script>window.location=(href='datakriteria.php?status=2')</script>";
            }
        } else {
            echo "<script>window.location=(href='datakriteria.php?status=7')</script>";
        }
    }
    // aksi tambah kriteria

    // aksi ubah kriteria
    if (isset($_POST['update_kriteria'])) {

        if ($_POST['bobot_kriteria'] <= 100) {
            $id_kriteria = $_POST["id_kriteria"];
            $nama_kriteria = $_POST["nama_kriteria"];
            $bobot_kriteria = $_POST["bobot_kriteria"];
            $query_update_kriteria  = "UPDATE tb_kriteria SET nama_kriteria ='" . $nama_kriteria . "', bobot_kriteria ='" . $bobot_kriteria . "' WHERE id_kriteria ='" . $id_kriteria . "'";
            $update_kriteria = mysqli_query($conn, $query_update_kriteria);
            if ($update_kriteria) {
                echo "<script>window.location=(href='datakriteria.php?status=3')</script>";
            } else {
                echo "<script>window.location=(href='datakriteria.php?status=4')</script>";
            }
        } else {
            echo "<script>window.location=(href='datakriteria.php?status=7')</script>";
        }
    }
    // aksi ubah kriteria

    // aksi tambah sub Kriteria
    if (isset($_POST['tambah_subkriteria'])) {
        $id_kriteria = $_POST["id_kriteria"];
        $nama_sub_kriteria = $_POST["nama_sub_kriteria"];
        $nilai_sub_kriteria = $_POST["nilai_sub_kriteria"];

        if ($nilai_sub_kriteria <= 100) {
            $query_tambah_subkriteria = "INSERT INTO tb_subkriteria (id_sub_kriteria, nama_sub_kriteria, nilai_sub_kriteria, id_kriteria) VALUES ('','$nama_sub_kriteria','$nilai_sub_kriteria','$id_kriteria')";
            $insert_subkriteria = mysqli_query($conn, $query_tambah_subkriteria);
            if ($insert_subkriteria) {
                echo "<script>window.location=(href='datakriteria.php?status=1')</<script>";
            } else {
                echo "<script>window.location=(href='datakriteria.php?status=2')</script>";
            }
        } else {
            echo "<script>window.location=(href='datakriteria.php?status=8')</script>";
        }
    }
    // aksi tambah sub Kriteria

    // aksi ubah sub kriteria
    if (isset($_POST['update_subkriteria'])) {
        for ($i = 0; $i < count($_POST['id_sub_kriteria']); $i++) {

            $id_kriteria =  $_POST["id_kriteria"][$i];
            $id_sub_kriteria =  $_POST["id_sub_kriteria"][$i];
            $nama_sub_kriteria =  $_POST["nama_sub_kriteria"][$i];
            $nilai_sub_kriteria =  $_POST["nilai_sub_kriteria"][$i];
            $query_update_subkriteria = "UPDATE tb_subkriteria SET nama_sub_kriteria ='" . $nama_sub_kriteria . "', nilai_sub_kriteria ='" . $nilai_sub_kriteria . "' WHERE id_sub_kriteria ='" . $id_sub_kriteria . "'";
            $update_subkriteria = mysqli_query($conn, $query_update_subkriteria);
        }
        if ($update_subkriteria) {
            echo "<script>window.location=(href='datakriteria.php?status=3')</script>";
        } else {
            echo "<script>window.location=(href='datakriteria.php?status=4')</script>";
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
        <?php include('../config/stylesheet.php'); ?>
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
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if ((isset($_GET['status'])) and ($_GET['status'] == 1)) {
                                echo '<div class="alert alert-success alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                <strong>Data Berhasil Disimpan</strong>
                            </div>';
                            } elseif ((isset($_GET['status'])) and ($_GET['status'] == 2)) {
                                echo '<div class="alert alert-danger alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                <strong>Data Sudah Terdaftar!!!</strong>
                            </div>';
                            } elseif ((isset($_GET['status'])) and ($_GET['status'] == 3)) {
                                echo '<div class="alert alert-success alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                <strong>Data Berhasil Diperbaharui</strong>
                            </div>';
                            } elseif ((isset($_GET['status'])) and ($_GET['status'] == 4)) {
                                echo '<div class="alert alert-danger alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                <strong>Data Gagal Diperbaharui</strong>
                            </div>';
                            } elseif ((isset($_GET['status'])) and ($_GET['status'] == 7)) {
                                echo '<div class="alert alert-warning alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                <strong>Peringatan!!!</strong> Bobot Kriteria Maksimal 100
                            </div>';
                            } elseif ((isset($_GET['status'])) and ($_GET['status'] == 8)) {
                                echo '<div class="alert alert-warning alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                <strong>Peringatan!!!</strong> Nilai Sub Kriteria Maksimal 100
                            </div>';
                            }

                            ?>
                        <button class="btn btn-success" id="modal_tambah_kriteria_btn" name="modal_tambah_kriteria_btn" href="#" data-toggle="modal" data-target="#modal-tambah-kriteria"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Kriteria</button>
                        <div class="table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:10%">ID Kriteria</th>
                                        <th style="width:30%">Nama Kriteria</th>
                                        <th class="text-center" style="width:10%">Bobot Kriteria</th>
                                        <th class="text-center" style="width:20%">Bobot Normaliasi Kriteria</th>
                                        <th class="text-center" style="width:30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query_kriteria = "SELECT * FROM tb_kriteria ";
                                        $result_total_bobot = mysqli_query($conn, "SELECT SUM(bobot_kriteria) as total_bobot FROM tb_kriteria");
                                        $result_kriteria = mysqli_query($conn, $query_kriteria);
                                        $data_total_bobot = mysqli_fetch_array($result_total_bobot);
                                        while ($datakriteria = mysqli_fetch_array($result_kriteria)) {

                                            ?>
                                        <tr>
                                            <td class="text-center"><?php echo $datakriteria['id_kriteria']; ?></td>
                                            <td><?php echo $datakriteria['nama_kriteria']; ?></td>
                                            <td class="text-center"><?php echo $datakriteria['bobot_kriteria']; ?></td>
                                            <td class="text-center"><?php echo $datakriteria['bobot_kriteria'] / $data_total_bobot['total_bobot']; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-xs edit_kriteria_btn" id="<?php echo $datakriteria['id_kriteria']; ?>"><i class="fa fa-edit"></i> Edit</button>
                                                <button type="button" class="btn btn-success btn-xs tambah_subkriteria_btn" id="<?php echo $datakriteria['id_kriteria']; ?>"><i class="fa fa-plus"></i> Tambah Sub Kriteria</button>
                                                <button type="button" class="btn btn-warning btn-xs edit_subkriteria_btn" id="<?php echo $datakriteria['id_kriteria']; ?>"><i class="fa fa-edit"></i> Edit Sub Kriteria </button>
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

        $query_id_kriteria = mysqli_query($conn, "SELECT id_kriteria FROM tb_kriteria ORDER BY id_kriteria DESC");
        $dataid = mysqli_fetch_array($query_id_kriteria);
        $id_kriteria = $dataid['id_kriteria'];
        $no = substr($id_kriteria, 1);
        $tambah_id_kriteria = (int) $no + 1;

        if (strlen($tambah_id_kriteria) == 1) {
            $kode_kriteria = "C" . $tambah_id_kriteria;
        }
        ?>

    <div id="modal-tambah-kriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaltambahkriteria">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modaltambahkriteria">Tambah Data Kriteria</h2>

                </div>

                <form id="form_tambah_kriteria" method="post" data-parsley-validate role="form" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="id_kriteria">
                                ID Kriteria
                            </label>
                            <input type="text" name="id_kriteria" class="form-control" id="id_kriteria" Value="<?php echo $kode_kriteria ?>" required readonly />
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
                        <button type="submit" name="tambah_kriteria" class="btn btn-primary" id="tambah_kriteria_btn">Simpan</button>

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
                    <h2 class="modal-title text-center" id="modaleditkriteria">Ubah Data Kriteria</h2>

                </div>

                <form id="form_edit_kriteria" method="post" role="form" data-parsley-validate action="">
                    <div class="modal-body" id="info-edit-kriteria">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="update_kriteria" class="btn btn-primary" id="update_kriteria_btn">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit kriteria -->

    <!-- Modal tambah Subkriteria -->
    <div id="modal-tambah-subkriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaltambahsubkriteria">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modaltambahsubkriteria">Tambah Data Sub Kriteria</h2>
                </div>
                <form id="form_tambah_sub" method="post" data-parsley-validate role="form" action="">
                    <div class="modal-body" id="info-tambah-subkriteria">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah_subkriteria" class="btn btn-primary" id="tambah_subkriteria">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Modal tambah Subkriteria -->

    <!-- Modal detail subkriteria -->
    <div id="modal-detail-subkriteria" class="modal fade bs-example-modal-lg" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaldetailsubkriteria">
        <div class="modal-dialog  modal-lg" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modaldetailsubkriteria">Ubah Data Sub Kriteria</h2>

                </div>

                <form id="form_detail_subkriteria" method="post" data-parsley-validate role="form" action="">
                    <div class="modal-body" id="info-detail-subkriteria">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="update_subkriteria" class="btn btn-primary" id="update_subkriteria_btn">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal detail subkriteria -->

    <?php include('../config/javascript.php'); ?>

    <script>
        $(document).ready(function() {

            // script edit kriteria
            $(document).on('click', '.edit_kriteria_btn', function() {

                var edit_id_kriteria = $(this).attr('id');
                $.ajax({
                    url: "update_kriteria.php",
                    method: "POST",
                    data: {
                        edit_id_kriteria: edit_id_kriteria
                    },
                    success: function(data) {
                        $("#info-edit-kriteria").html(data);
                        $("#modal-edit-kriteria").modal("show");
                    }
                });

            });
            // script edit kriteria

            // script tambah sub kriteria
            $(document).on('click', '.tambah_subkriteria_btn', function() {

                var get_id_kriteria = $(this).attr('id');
                $.ajax({
                    url: "tambah_subkriteria.php",
                    method: "POST",
                    data: {
                        get_id_kriteria: get_id_kriteria
                    },
                    success: function(data) {
                        $("#info-tambah-subkriteria").html(data);
                        $("#modal-tambah-subkriteria").modal("show");
                    }
                });

            });
            // script tambah sub kriteria

            // script detail sub kriteria
            $(document).on('click', '.edit_subkriteria_btn', function() {

                var edit_id_subkriteria = $(this).attr('id');
                $.ajax({
                    url: "update_subkriteria.php",
                    method: "POST",
                    data: {
                        edit_id_subkriteria: edit_id_subkriteria
                    },
                    success: function(data) {
                        $("#info-detail-subkriteria").html(data);
                        $("#modal-detail-subkriteria").modal("show");
                    }
                });

            });
            // script detail sub kriteria
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