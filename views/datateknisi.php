<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah teknisi
    if (isset($_POST['tambah_teknisi'])) {

        $nik = mysqli_real_escape_string($conn, $_POST["nik"]);
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $no_telpon = mysqli_real_escape_string($conn, $_POST["no_telpon"]);
        $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);
        $query_tambah_teknisi = "INSERT INTO tb_teknisi (nik, nama, no_telpon, id_area) VALUES ('$nik','$nama','$no_telpon','$id_area')";
        $insert = mysqli_query($conn, $query_tambah_teknisi);

        if ($insert) {
            echo "<script>window.alert('Data Berhasil di Simpan');
                window.location=(href='datateknisi.php')</script>";
        } else {
            echo "<script>window.alert('Data Gagal di Simpan');
                window.location=(href='datateknisi.php')</script>";
        }
    }
    // aksi tambah teknisi

    // aksi ubah teknisi
    if (isset($_POST['update_teknisi'])) {
        $nik = mysqli_real_escape_string($conn, $_POST["nik"]);
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $no_telpon = mysqli_real_escape_string($conn, $_POST["no_telpon"]);
        $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);
        $query_update_teknisi = "UPDATE tb_teknisi SET nama ='" . $nama . "', id_area ='" . $id_area . "', no_telpon='" . $no_telpon . "' WHERE nik='" . $nik . "'";
        $update = mysqli_query($conn, $query_update_teknisi);
        if ($update) {
            echo "<script>
            window.alert('Data Berhasil di Ubah');
            window.location ='datateknisi.php';
        </script>";
        } else {
            echo "<script>
            window.alert('Data Gagal di Ubah');
            window.location = (href = 'update_teknisi.php?nik=" . $nik . "');
        </script>";
        }
    }
    // aksi ubah teknisi

    // aksi hapus teknisi
    if (isset($_POST['hapus_teknisi'])) {
        $nik = $_POST['nik'];
        $query_deleted_teknisi = "DELETE FROM tb_teknisi WHERE nik ='$nik'";
        $deleted = mysqli_query($conn, $query_deleted_teknisi);

        if ($deleted) {
            echo "<script>
        alert('Data Berhasil di Hapus');
            window.location=(href='datateknisi.php')
        </script>";
        } else {
            echo "<script>
        alert('Data Gagal di Hapus');
            window.location=(href='datateknisi.php')
        </script>";
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
        <!-- Datatables -->
        <link href="../assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../assets/build/css/custom.min.css" rel="stylesheet">
        <link rel='stylesheet' type='text/css' href='../assets/dist/sweetalert2.min.css'>
        <script src="../assets/dist/sweetalert2.min.js"></script>
        <!-- <link href="../assets/build/css/style.css" rel="stylesheet"> -->
        <!-- Select2 -->
        <link href="../assets/build/select2/select2.min.css" rel="stylesheet">


    </head>

    <!-- header -->
    <?php include('header.php'); ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
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
                        <div id="alert_tambah"></div>
                        <button class="btn btn-success" id="modal_tambah_teknisi_btn" name="tambah_teknisi_btn" href="#" data-toggle="modal" data-target="#modal-tambah-teknisi"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Teknisi</button>
                        <div class="table-responsive">
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
                                        $query_teknisi = "SELECT tb_teknisi.nik,tb_teknisi.nama,tb_teknisi.no_telpon, tb_area.area, tb_area.id_area FROM tb_teknisi
                                        inner JOIN tb_area on tb_teknisi.id_area = tb_area.id_area";
                                        $result_teknisi = mysqli_query($conn, $query_teknisi);
                                        while ($datateknisi = mysqli_fetch_array($result_teknisi)) {
                                            $nik = $datateknisi['nik'];
                                            $nama = $datateknisi['nama'];
                                            $no_telpon = $datateknisi['no_telpon'];
                                            $area = $datateknisi['area'];
                                            ?>
                                        <tr>
                                            <td><?php echo $nik ?></td>
                                            <td><?php echo $nama ?></td>
                                            <td class="text-center"><?php echo $no_telpon ?></td>
                                            <td class="text-center"><?php echo $area ?></td>
                                            <td><button type="button" id="<?php echo $nik ?>" class="btn btn-primary btn-xs edit_data_btn"><i class="fa fa-wrench"></i> Edit</button>
                                                <button type="button" id="<?php echo $nik ?>" class="btn btn-danger btn-xs hapus_data_btn"><i class="fa fa-trash"></i> Hapus</button>
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
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- /page content -->

    <?php include('footer.php') ?>

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

                <form id="form_tambah_teknisi" method="post" role="form" action="">
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

                <form id="form_edit" method="post" role="form" action="">
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
    <script src="../assets/build/select2/select2.min.js"></script>

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