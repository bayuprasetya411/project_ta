<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');
    include('../config/function.php');

    // aksi tambah periode
    if (isset($_POST['tambah_periode'])) {
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
    // aksi tambah periode

    // aksi ubah periode
    if (isset($_POST['update_periode'])) {
        $id_periode = $_POST['id_periode'];
        $nama_periode = $_POST['nama_periode'];
        $query_update = "UPDATE tb_periode SET nama_periode ='" . $nama_periode . "' WHERE id_periode = '" . $id_periode . "'";
        $update = mysqli_query($conn, $query_update);
        if ($update) {
            echo "<script>
            alert('Data Berhasil di Ubah');
            window.location = (href = 'data_periode2.php');
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal di Ubah');
            window.location = (href = 'data_periode2.php')
            </script>";
        }
    }
    // aksi ubah periode

    // aksi hapus periode

    if (isset($_POST['hapus_periode'])) {
        $id_periode = $_POST['id_periode'];
        $query_deleted_periode = "DELETE FROM tb_periode WHERE id_periode ='$id_periode'";
        $deleted = mysqli_query($conn, $query_deleted_periode);

        if ($deleted) {
            echo "<script>
        alert('Data Berhasil di Hapus');
            window.location=(href='data_periode2.php')
        </script>";
        } else {
            echo "<script>
        alert('Data Gagal di Hapus');
            window.location=(href='data_periode2.php')
        </script>";
        }
    }


    // aksi hapus periode

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
        <!-- <link href="../assets/build/css/style.css" rel="stylesheet"> -->
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

                    <button class="btn btn-success" id="tambah_periode_btn" name="tambah_periode_btn" href="#" data-toggle="modal" data-target="#modal-tambah-periode"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Periode</button>
                    <div class="table-responsive">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:80%">Nama Periode</th>
                                    <th class="text-center" style="width:20%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $query_periode = "SELECT * FROM tb_periode";
                                    $result_periode = mysqli_query($conn, $query_periode);
                                    while ($dataperiode = mysqli_fetch_array($result_periode)) { ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id_periode" value="<?php echo $dataperiode['id_periode'] ?>"><?php echo $dataperiode['nama_periode'] ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-xs " id="edit_periode_btn"><i class="fa fa-wrench"></i> Edit</button>
                                            <button type="button" class="btn btn-danger btn-xs " id="hapus_periode_btn"><i class="fa fa-trash"></i> Hapus</button>
                                            <button type="button" class="btn btn-warning btn-xs " id="detail_periode_btn"><i class="glyphicon glyphicon-resize-full"></i> Detail</button>
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
    <div id="modal-tambah-periode" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaltambahperiode">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modaltambahperiode">Tambah Data Periode</h2>
                </div>

                <form id="form_tambah_periode" method="post" role="form" action="">
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
                                    while ($dataselect = mysqli_fetch_array($queryselect)) { ?>
                                    <option value="<?php echo $dataselect['id_kriteria'] ?>"><?php echo $dataselect['nama_kriteria'] ?></option>
                                <?php
                                    } ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah_periode" class="btn btn-primary" id="tambah_periode_btn">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /Modal Tambah Periode -->

    <!-- Modal Edit Periode -->
    <div id="modal-edit-periode" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalieditperiode">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modalieditperiode">Ubah Data Periode</h2>
                </div>

                <form id="form_edit" method="post" role="form" action="">
                    <div class="modal-body" id="info-edit-periode">
                        <!-- info-edit-periode -->
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="update_periode" class="btn btn-primary" id="update_periode_btn">Ubah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /Modal Edit periode -->

    <!-- Modal Detail Periode -->
    <div id="modal-detail-periode" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalidetailperiode">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modalidetailperiode">Detail Data Periode</h2>
                </div>

                <form id="form_detail" method="post" role="form" action="">
                    <div class="modal-body" id="info-detail-periode">
                        <!-- info-detail-periode -->
                    </div>

                    <div class="modal-footer">
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /Modal Detail periode -->

    <!-- Modal Hapus Periode -->
    <div id="modal-hapus-periode" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalihapusperiode">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modalihapusperiode">Hapus Data Periode</h2>
                </div>

                <form method="post" role="form" action="">
                    <div class="modal-body" id="info-hapus-periode">
                        <!-- info-hapus-periode -->
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus_periode" class="btn btn-primary" id="hapus_periode_btn">Hapus</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- /Modal Hapus periode -->

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
                dropdownParent: $('#modal-tambah-periode')
            });

            // script edit periode
            $(document).on('click', '#edit_periode_btn', function() {

                var edit_id_periode = $(this).parent().prev().children('input').val();
                console.log(edit_id_periode);
                $.ajax({
                    url: "update_periode2.php",
                    method: "GET",
                    data: {
                        'edit_id_periode': edit_id_periode
                    },
                    success: function(data) {
                        $("#modal-edit-periode").modal("show");
                        $("#info-edit-periode").html(data);
                    }
                });
            });
            // script edit periode

            // script detail periode
            $(document).on('click', '#detail_periode_btn', function() {

                var detail_id_periode = $(this).parent().prev().children('input').val();
                console.log(detail_id_periode);
                $.ajax({
                    url: "detail_periode.php",
                    method: "GET",
                    data: {
                        'detail_id_periode': detail_id_periode
                    },
                    success: function(data) {
                        var dataDetail = JSON.parse(data);
                        console.log(dataDetail);
                        $("#modal-detail-periode").modal('show');
                        var detail_kriteria = '';
                        var detail_periode = '';
                        for (var key in dataDetail.periode) {
                            detail_kriteria += `
                            <tr>
                                <td>` + dataDetail.periode[key].nama_kriteria + `</td>
                                <td class ="text-center">` + dataDetail.periode[key].bobot_normalisasi + `</td>
                            </tr>
                            `;
                        }

                        detail_periode += `
                        
                            <div class="form-group">
                                <label class = "control-label" >Periode</label>
                                <td> : </td>
                                <td>` + dataDetail.nama_periode + `</td>
                            </div>

                            <div class="form-group">
                            <table class="table">
                                <thead style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th class ="text-center" style="width:50%">Bobot Normalisasi Kriteria</th>
                                    </tr>
                                </thead>

                                <tbody id="load-data">
                                    ` + detail_kriteria + `
                                </tbody>

                                <tfoot style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th class ="text-center" style="width:50%">Bobot Normalisasi Kriteria</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        `;
                        $("#info-detail-periode").html(detail_periode);
                    }
                });
            });
            // script detail periode

            // script hapus periode
            $(document).on('click', '#hapus_periode_btn', function() {

                var hapus_id_periode = $(this).parent().prev().children('input').val();
                console.log(hapus_id_periode);
                $.ajax({

                    url: "hapus_periode.php",
                    method: "GET",
                    data: {
                        'hapus_id_periode': hapus_id_periode
                    },
                    success: function(data) {

                        $("#modal-hapus-periode").modal('show');
                        $("#info-hapus-periode").html(data);

                    }
                });
            });
            // script hapus periode

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