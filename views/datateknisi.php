<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah teknisi
    if (isset($_POST['tambah_teknisi'])) {

        $nik = $_POST["nik"];
        $nama = $_POST["nama"];
        $no_telpon = $_POST["no_telpon"];
        $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);
        $query_tambah_teknisi = "INSERT INTO tb_teknisi (nik, nama, no_telpon, id_area) VALUES ('$nik','$nama','$no_telpon','$id_area')";

        $insert = mysqli_query($conn, $query_tambah_teknisi);

        if ($insert) {
            echo "<script>window.location=(href='datateknisi.php?status=1')</script>";
        } else {
            echo "<script>window.location=(href='datateknisi.php?status=2')</script>";
        }
    }
    // aksi tambah teknisi

    // aksi ubah teknisi
    if (isset($_POST['update_teknisi'])) {
        $nik = $_POST["nik"];
        $nama = $_POST["nama"];
        $no_telpon = $_POST["no_telpon"];
        $id_area = $_POST["id_area"];
        $query_update_teknisi = "UPDATE tb_teknisi SET nama ='" . $nama . "', id_area ='" . $id_area . "', no_telpon='" . $no_telpon . "' WHERE nik='" . $nik . "'";
        $update = mysqli_query($conn, $query_update_teknisi);
        if ($update) {
            echo "<script>window.location=(href='datateknisi.php?status=3')</script>";
        } else {
            echo "<script>window.location=(href='datateknisi.php?status=4')</script>";
        }
    }
    // aksi ubah teknisi

    // aksi hapus teknisi
    if (isset($_POST['hapus_teknisi'])) {
        $nik = $_POST['nik'];
        $query_deleted_teknisi = "DELETE FROM tb_teknisi WHERE nik ='$nik'";
        $deleted = mysqli_query($conn, $query_deleted_teknisi);

        if ($deleted) {
            echo "<script>window.location=(href='datateknisi.php?status=5')</script>";
        } else {
            echo "<script>window.location=(href='datateknisi.php?status=6')</script>";
        }
    }
    // aksi hapus teknisi

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SPK | Data Teknisi</title>
        <?php include('../config/stylesheet.php') ?>
    </head>

    <!-- header -->
    <?php include('header.php'); ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Teknisi</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tabel Data Teknisi<small>Corporate Service</small></h2>
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
                        } elseif ((isset($_GET['status'])) and ($_GET['status'] == 5)) {
                            echo '<div class="alert alert-success alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                            <strong>Data Berhasil Dihapus</strong>
                        </div>';
                        } elseif ((isset($_GET['status'])) and ($_GET['status'] == 6)) {
                            echo '<div class="alert alert-danger alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                            <strong>Data Gagal Dihapus</strong>
                        </div>';
                        }

                        ?>

                    <button class="btn btn-success" id="modal_tambah_teknisi_btn" name="tambah_teknisi_btn" href="#" data-toggle="modal" data-target="#modal-tambah-teknisi"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Teknisi</button>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:10%">Nik</th>
                                    <th style="width:40%">Nama</th>
                                    <th class="text-center" style="width:30%">No Telpon</th>
                                    <th class="text-center" style="width:10%">Area</th>
                                    <th class="text-center" style="width:10%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $query_teknisi = "SELECT * FROM tb_teknisi
                                    inner JOIN tb_area on tb_teknisi.id_area = tb_area.id_area";
                                    $result_teknisi = mysqli_query($conn, $query_teknisi);
                                    while ($datateknisi = mysqli_fetch_array($result_teknisi)) {
                                    
                                        ?>
                                    <tr>
                                        <td><?php echo $datateknisi['nik']?></td>
                                        <td><?php echo $datateknisi['nama']?></td>
                                        <td class="text-center"><?php echo $datateknisi['no_telpon'] ?></td>
                                        <td class="text-center"><?php echo $datateknisi['area'] ?></td>
                                        <td><button type="button" id="<?php echo $datateknisi['nik'] ?>" class="btn btn-primary btn-xs edit_data_btn"><i class="fa fa-edit"></i> Edit</button>
                                            <button type="button" id="<?php echo $datateknisi['nik'] ?>" class="btn btn-danger btn-xs hapus_data_btn"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                    
                                <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- /page content -->
        </div>
        <?php include('footer.php')?>
    </div>
</div>
    

    <!-- Modal Tambah Teknisi -->
    <div id="modal-tambah-teknisi" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaltambahteknisi">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modaltambahteknisi">Tambah Data Teknisi</h2>
                </div>

                <form id="form_tambah_teknisi" method="post" role="form" data-parsley-validate action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="nik">Nik Karyawan</label>
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="Nik Karyawan" required autofocus="autofocus" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Karyawan" required>
                        </div>

                        <?php
                            $query_area = mysqli_query($conn, "SELECT * FROM tb_area ORDER BY id_area DESC");
                            ?>

                        <div class="form-group">
                            <label class="control-label" for="id_area">Area</label>
                            <select name="id_area" class="form-control select-area" id="id_area" style="width:100%;" required>
                                <option></option>
                                <?php while ($dataarea = mysqli_fetch_array($query_area)) { ?>
                                    <option value="<?php echo $dataarea['id_area']; ?>"><?php echo $dataarea['area']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="no_telpon">No Telpon (08xxxxxxxxxxxx)</label>
                            <input type="number" name="no_telpon" class="form-control" id="no_telpon" placeholder="Notel Karyawan" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah_teknisi" class="btn btn-primary" id="tambah_teknisi_btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Tambah Teknisi -->

    <!-- Modal ubah Teknisi -->
    <div id="modal-edit-teknisi" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaleditteknisi">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modalieditteknisi">Ubah Data Teknisi</h2>
                </div>

                <form id="form_edit" method="post" role="form" data-parsley-validate action="">
                    <div class="modal-body" id="info-edit-teknisi">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="update_teknisi" class="btn btn-primary " id="update_teknisi_btn">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal ubah Teknisi -->

    <!-- Modal hapus Teknisi -->
    <div id="modal-hapus-teknisi" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalhapusteknisi">
        <div class="modal-dialog
        " role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modalhapusteknisi">Hapus Data Teknisi</h2>
                </div>

                <form id="form_hapus" method="post" role="form" action="">
                    <div class="modal-body" id="info-hapus-teknisi">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus_teknisi" class="btn btn-primary" id="hapus_teknisi_btn">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Hapus Teknisi -->

    <?php include('../config/javascript.php'); ?>

    <script>
        $(document).ready(function() {

            $('.select-area').select2({
                dropdownParent: $('#modal-tambah-teknisi'),
                placeholder: "-- Pilih Area --",
                allowClear: true
            });

            // Script ubah teknisi
            $(document).on('click', '.edit_data_btn', function() {

                var edit_nik = $(this).attr('id');
                $.ajax({
                    url: "update_teknisi.php",
                    method: "POST",
                    data: {
                        edit_nik: edit_nik
                    },
                    success: function(data) {
                        $("#info-edit-teknisi").html(data);
                        $("#modal-edit-teknisi").modal("show");
                    }
                });

            });
            // Script ubah teknisi

            // Script hapus teknisi
            $(document).on('click', '.hapus_data_btn', function() {

                var hapus_nik = $(this).attr('id');
                $.ajax({
                    url: "hapus_teknisi.php",
                    method: "POST",
                    data: {
                        hapus_nik: hapus_nik
                    },
                    success: function(data) {
                        $("#info-hapus-teknisi").html(data);
                        $("#modal-hapus-teknisi").modal("show");
                    }
                });

            });
            // Script hapus teknisi
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