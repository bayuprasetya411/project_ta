<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah periode
    if (isset($_POST['tambah'])) {
        $nama_periode = $_POST['nama_periode'];
        $data_kriteria = $_POST['id_kriteria'];
        // echo "<pre>";
        // print($nama_periode);
        // print_r($id_kriteria);
        // echo "</pre>";
        // exit();
        $query_tambah =  "INSERT INTO tb_periode (nama_periode) value ('$nama_periode')";
        $tambah = mysqli_query($conn, $query_tambah);
        $id_periode = mysqli_insert_id($conn);
        foreach ($data_kriteria as $id_kriteria) {
            $query_tambah2 =  "INSERT INTO tb_periode_has_kriteria (id_periode, id_kriteria) value ('$id_periode','$id_kriteria')";
            $tambah2 = mysqli_query($conn, $query_tambah2);
        }
        if ($tambah) {
            echo "<script>
            alert('Data Berhasil di Simpan');
            window.location = (href = 'dataperiode.php');
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal di Simpan');
            window.location = (href = 'dataperiode.php')
            </script>";
        }
    }

    // aksi tambah kriteria

    // aksi ubah kriteria

    // aksi ubah kriteria

    // aksi tambah sub Kriteria

    // aksi tambah sub Kriteria

    // aksi ubah sub kriteria
    // if (isset($_POST['edit_subkriteria'])) {
    //     for ($i = 0; $i < count($_POST['id_sub_kriteria']); $i++) {

    //         $id_kriteria =  $_POST["id_kriteria"][$i];
    //         $id_sub_kriteria =  $_POST["id_sub_kriteria"][$i];
    //         $nama_sub_kriteria =  $_POST["nama_sub_kriteria"][$i];
    //         $nilai_sub_kriteria =  $_POST["nilai_sub_kriteria"][$i];
    //         $query_ubah = "UPDATE tb_subkriteria SET nama_sub_kriteria ='" . $nama_sub_kriteria . "', nilai_sub_kriteria ='" . $nilai_sub_kriteria . "' WHERE id_sub_kriteria ='" . $id_sub_kriteria . "'";
    //         $ubah = mysqli_query($conn, $query_ubah);
    //     }
    //     if ($ubah) {
    //         echo "<script>  window.alert('Data Berhasil di Ubah');
    //         window.location = (href = 'datakriteria.php');
    //             </script>";
    //     } else {
    //         echo "<script>
    //                 window.alert('Data Gagal di Ubah');
    //                 window.location = (href = 'datakriteria.php');
    //         </script>";
    //     }
    // }
    // aksi ubah sub kriteria

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $bulan[(int) $pecahkan[1]] . '-' . $pecahkan[0];
    }
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>SPK | Data Periode</title>
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
        <!-- Select2 -->
        <link href="../assets/build/select2/select2.min.css" rel="stylesheet">

    </head>

    <!-- header -->
    <?php include('header.php'); ?>

    <!-- Page Content -->

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Data Periode</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabel Data Periode<small>Corporate Service</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <button class="btn btn-success" id="btn-input" name="btn-input" href="#" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Periode</button>
                    <div class="table-responsive">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query_tampil = "SELECT * FROM tb_periode";
                                    $tampil = mysqli_query($conn, $query_tampil);
                                    while ($row = mysqli_fetch_array($tampil)) { ?>
                                    <tr>
                                        <td><?php echo $row['nama_periode'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs edit_periode" id=""><i class="fa fa-wrench"></i></button>
                                            <button type="button" class="btn btn-warning btn-xs detail_periode" id=""><i class="fa fa-book"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>

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


    <!-- Modal Tambah Periode -->

    <div id="modal-input" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalinput">Tambah Data Periode</h2>
                </div>

                <form id="form_tambah" method="post" role="form" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="nama_periode">
                                Nama Periode
                            </label>
                            <input type="text" name="nama_periode" class="form-control" id="nama_periode" value="<?php echo tgl_indo(date('Y-m')); ?>" required />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama_kriteria">
                                Kriteria
                            </label>
                            <select class="form-control select-kriteria" id="id_kriteria" name="id_kriteria[]" multiple="multiple" style="width:100%;" autofocus required>
                                <?php

                                    $queryselect = mysqli_query($conn, "SELECT * FROM tb_kriteria");
                                    while ($row = mysqli_fetch_array($queryselect)) { ?>
                                    <option value="<?php echo $row['id_kriteria'] ?>"><?php echo $row['nama_kriteria'] ?></option>
                                <?php
                                    } ?>
                            </select>
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
    <!-- /Modal Tambah kriteria -->

    <!-- Modal edit kriteria -->
    <!-- <div id="modal-edit-kriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaleditkriteria">
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
    </div> -->
    <!-- /Modal edit kriteria -->

    <!-- Modal Data Subkriteria -->
    <!-- <div id="modal-subkriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
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
                        <button type="submit" name="tambah_sub" class="btn btn-primary" id="tambah_sub">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div> -->
    <!-- Modal Data Subkriteria -->

    <!-- Modal edit subkriteria -->
    <!-- <div id="modal-edit-subkriteria" class="modal fade bs-example-modal-lg" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaledit">
        <div class="modal-dialog  modal-lg" role="documnet">
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
    </div> -->
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
    <script src="../assets/build/select2/select2.min.js"></script>


    <script>
        $(document).ready(function() {

            $(document).ready(function() {
                $('.select-kriteria').select2({
                    placeholder: "-- Pilih Kriteria --",
                    allowClear: true
                });
            });

            $('.select-teknisi').select2({
                dropdownParent: $('#modal-input')
            });
            // script edit kriteria
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
            // script edit kriteria

            // script tambah sub kriteria
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
            // script tambah sub kriteria

            // script detail sub kriteria
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