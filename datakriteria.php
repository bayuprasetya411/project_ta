<?php
session_start();
if (isset($_SESSION['login'])) {

    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>SPK | Data Kriteria</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap -->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">

</head>

<body class="nav-md">
    <?php
        include('koneksi.php');
        include('header.php');
        ?>

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
                        <p></p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot Kriteria</th>
                                    <th>Bobot Normaliasi Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>C1</td>
                                    <td>Presensi</td>
                                    <td>15</td>
                                    <td>0.15</td>
                                    <td><button type="button" id="" name="hapus" class="btn btn-danger btn-sm hapus_data"><i class="fa fa-trash"></i> Hapus </button>
                                        <button type="button" id="" name="edit" class="btn btn-primary btn-sm edit_data"><i class="fa fa-wrench"></i> Ubah </button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!--/Page Content -->
    </div>
    <?php include('footer.php'); ?>
    </div>
    <!-- /menu content -->

    <!-- Modal Tambah kriteria -->
    <?php
        error_reporting(0);
        $query = mysqli_query($conn, "SELECT id_kriteria FROM td_kriteria ORDER BY id_kriteria DESC");
        $id = mysqli_fetch_array($query);
        $id_kriteria = $id['id_kriteria'];
        $no = substr($id_kriteria, 2);
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
                                <h4>ID Kriteria</h5>
                            </label>
                            <input type="text" name="id_kriteria" class="form-control" id="id_kriteria" Value="<?php echo $kode; ?>" required="" readonly />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama_kriteria">
                                <h4>Nama Kriteria</h4>
                            </label>
                            <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" autofocus="" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="bobot_kriteria">
                                <h4>Bobot Kriteria</h4>
                            </label>
                            <input type="number" name="bobot_kriteria" class="form-control" id="bobot_kriteria" placeholder="Bobot Kriteria (1-100)">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class=" btn btn-danger">Reset</button>
                        <button type="submit" name="tambah" class="btn btn-primary" id="tambah">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /Modal Tambah kriteria -->

    <!-- Modal Ubah kriteria -->

    <div id="modal-input" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalinput">Ubah Data Kriteria</h2>

                </div>

                <form id="form_ubah" method="post" role="form" action="">
                    <div class="modal-body">
                        <div class="form-group" id="tabel_ubah">
                            <label class="control-label" for="id_kriteria">
                                <h4>ID Kriteria</h5>
                            </label>
                            <input type="text" name="id_kriteria" class="form-control" id="id_kriteria" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama_kriteria">
                                <h4>Nama Kriteria</h4>
                            </label>
                            <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" autofocus="autofocus">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="bobot_kriteria">
                                <h4>Bobot Kriteria</h4>
                            </label>
                            <input type="number" name="bobot_kriteria" class="form-control" id="bobot_kriteria" placeholder="Bobot Kriteria (1-100)">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class=" btn btn-danger">Reset</button>
                        <button type="submit" name="tambah" class="btn btn-primary" id="ubah">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /Modal Ubah kriteria -->

    <!-- jQuery -->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="assets/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="assets/vendors/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- Datatables -->
    <script src="assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="assets/build/js/custom.min.js"></script>

    <!-- script tambah kriteria -->
    <script>
        $(document).ready(function() {

            $('#form_tambah').on('submit', function(event) {
                event.preventDefault();
                if ($('#id_kriteria').val() == "") {
                    alert('Data Id Kriteria Tidak Boleh Kosong!!!');

                } else if ($('#nama_kriteria').val() == '') {
                    alert('Data Nama Kriteria Tidak Boleh Kosong!!!');
                } else if ($('#bobot_kriteria').val() == '') {
                    alert('Data Bobot Kriteria Tidak Boleh Kosong!!!');
                }

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