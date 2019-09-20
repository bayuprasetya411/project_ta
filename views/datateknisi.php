<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah teknisi
    if (isset($_POST['tambah'])) {

        $nik = mysqli_real_escape_string($conn, $_POST["nik"]);
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $no_telpon = mysqli_real_escape_string($conn, $_POST["no_telpon"]);
        $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);
        $querytambah = "INSERT INTO tb_teknisi (nik, nama, no_telpon, id_area) VALUES ('$nik','$nama','$no_telpon','$id_area')";
        $insert = mysqli_query($conn, $querytambah);

        if ($insert) {
            echo "<script>window.alert('Data Berhasil Disimpan');
                window.location=(href='datateknisi.php')</script>";
        } else {
            echo "<script>window.alert('Data Gagal Disimpan');
                window.location=(href='datateknisi.php')</script>";
        }
    }
    // aksi tambah teknisi

    // aksi ubah teknisi
    if (isset($_POST['ubah'])) {
        $nik = mysqli_real_escape_string($conn, $_POST["nik"]);
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $no_telpon = mysqli_real_escape_string($conn, $_POST["no_telpon"]);
        $id_area = mysqli_real_escape_string($conn, $_POST["id_area"]);
        $sql = "UPDATE tb_teknisi SET nama ='" . $nama . "', id_area ='" . $id_area . "', no_telpon='" . $no_telpon . "' WHERE nik='" . $nik . "'";
        $update = mysqli_query($conn, $sql);
        if ($update) {
            echo "<script>
            window.alert('Data Berhasil Diubah');
            window.location = (href = 'datateknisi.php')
        </script>";
        } else {
            echo "<script>
            window.alert('Data Gagal Diubah');
            window.location = (href = 'update_teknisi.php?nik=" . $nik . "');
        </script>";
        }
    }
    // aksi ubah teknisi

    // aksi hapus teknisi
    if (isset($_POST['hapus'])) {
        $nik = $_POST['nik'];
        $query_deleted = "DELETE FROM tb_teknisi WHERE nik ='$nik'";
        $deleted = mysqli_query($conn, $query_deleted);

        if ($deleted) {
            echo "<script>
        alert('Data Berhasil Terhapus');
            window.location=(href='datateknisi.php')
        </script>";
        } else {
            echo "<script>
        alert('Data Gagal Terhapus');
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
        <link href="../assets/build/css/style.css" rel="stylesheet">


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
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="alert_tambah"></div>
                        <button class="btn btn-success" id="btn-input" name="btn-input" href="#" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Teknisi</button>
                        <div class="table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nik</th>
                                        <th>Nama</th>
                                        <th>No Telpon</th>
                                        <th>Area</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $query = "SELECT tb_teknisi.nik,tb_teknisi.nama,tb_teknisi.no_telpon, tb_area.area, tb_area.id_area FROM tb_teknisi
                                        inner JOIN tb_area on tb_teknisi.id_area = tb_area.id_area";
                                        $result = mysqli_query($conn, $query);
                                        while ($data = mysqli_fetch_array($result)) {
                                            $nik = $data['nik'];
                                            $nama = $data['nama'];
                                            $no_telpon = $data['no_telpon'];
                                            $area = $data['area'];
                                            ?>
                                        <tr>
                                            <td><?php echo $nik ?></td>
                                            <td><?php echo $nama ?></td>
                                            <td><?php echo $no_telpon ?></td>
                                            <td><?php echo $area ?></td>
                                            <td><button type="button" id="<?php echo $nik ?>" class="btn btn-primary btn-xs ubah_data"><i class="fa fa-wrench"></i></button>
                                                <button type="button" id="<?php echo $nik ?>" class="btn btn-danger btn-xs hapus_data"><i class="fa fa-trash"></i></button>
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
    <div id="modal-input" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalinput">Tambah Data Teknisi</h2>
                </div>

                <form id="form_tambah" method="post" role="form" action="">
                    <div class="modal-body" id="tabel_tambah">
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
                            <select name="id_area" class="form-control" id="id_area">
                                <option value="0">-- Pilih Area --</option>
                                <?php while ($tampil = mysqli_fetch_array($query_area)) { ?>
                                    <option value="<?php echo $tampil['id_area']; ?>"><?php echo $tampil['area']; ?></option>
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
                        <button type="submit" name="tambah" class="btn btn-primary" id="tambah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Tambah Teknisi -->

    <!-- Modal ubah Teknisi -->
    <div id="modal-edit" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaledit">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modaliedit">Ubah Data Teknisi</h2>
                </div>

                <form id="form_edit" method="post" role="form" action="">
                    <div class="modal-body" id="info-teknisi">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="ubah" class="btn btn-primary " id="ubah">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal ubah Teknisi -->

    <!-- Modal hapus Teknisi -->
    <div id="modal-hapus" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalhapus">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalhapus">Hapus Data Teknisi</h2>
                </div>

                <form id="form_hapus" method="post" role="form" action="">
                    <div class="modal-body" id="info_hapus">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-primary" id="hapus">Hapus</button>
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

    <script>
        $(document).ready(function() {

            // Script ubah teknisi
            $(document).on('click', '.ubah_data', function() {

                var edit_nik = $(this).attr('id');
                $.ajax({
                    url: "update_teknisi.php",
                    method: "POST",
                    data: {
                        edit_nik: edit_nik
                    },
                    success: function(data) {
                        $("#info-teknisi").html(data);
                        $("#modal-edit").modal("show");
                    }
                });

            });
            // Script ubah teknisi

            // Script hapus teknisi
            $(document).on('click', '.hapus_data', function() {

                var hapus_nik = $(this).attr('id');
                $.ajax({
                    url: "hapus_teknisi.php",
                    method: "POST",
                    data: {
                        hapus_nik: hapus_nik
                    },
                    success: function(data) {
                        $("#info_hapus").html(data);
                        $("#modal-hapus").modal("show");
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