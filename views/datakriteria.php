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

    </head>

    <!-- header -->
    <?php
        include('../config/koneksi.php');
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
                                            <td><a href="update_kriteria.php?id_kriteria=<?php echo $data['id_kriteria']; ?>">
                                                    <button type="button" class="btn btn-primary btn-xs edit_data"><i class="fa fa-wrench"></i></button>
                                                </a>
                                                <a href="tambah_subkriteria.php?id_kriteria=<?php echo $data['id_kriteria']; ?>">
                                                    <button type="button" class="btn btn-success btn-xs tambahsub_data"><i class="fa fa-plus"></i></button>
                                                </a>
                                                <a href="datasubkriteria.php?id_kriteria=<?php echo $data['id_kriteria']; ?>">
                                                    <button type="button" class="btn btn-warning btn-xs detail_data"><i class="fa fa-book"></i></button>
                                                </a>
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
                            <input type="text" name="id_kriteria" class="form-control" id="id_kriteria" Value="<?php echo $kode ?>" required="" readonly />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama_kriteria">
                                Nama Kriteria
                            </label>
                            <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" autofocus="" />
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="bobot_kriteria">
                                Bobot Kriteria
                            </label>
                            <input type="number" name="bobot_kriteria" class="form-control" id="bobot_kriteria" placeholder="Bobot Kriteria (1-100)">
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

    <!-- Modal Data Subkriteria -->

    <div id="modal-subkriteria" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalinput">Ubah Data Sub Kriteria</h2>

                </div>

                <form id="form_tambah" method="post" role="form" action="">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">

                                <input type='hidden' class="form-control" name="id_sub_kriteria" id="id_sub_kriteria" />

                                <div class='col-sm-4'>
                                    <label> Nama Kriteria </label>
                                    <div class="form-group">
                                        <input type='text' class="form-control" name="id_kriteria" id="id_kriteria" readonly />
                                    </div>
                                </div>

                                <div class='col-sm-4'>
                                    <label> Nama Sub Kriteria </label>
                                    <div class="form-group">
                                        <input type='text' class="form-control" name="nama_sub_kriteria" id="nama_sub_kriteria" autofocus required />
                                    </div>
                                </div>

                                <div class='col-sm-4'>
                                    <label> Nilai Sub Kriteria</label>
                                    <div class="form-group">
                                        <input type='text' name="nilai_sub_kriteria" id="nilai_sub_kriteria" class="form-control" required />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-primary" id="tambah">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Data Subkriteria -->

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

            $('#form_tambah').on('submit', function(event) {
                event.preventDefault();
                if ($('#id_kriteria').val() == "") {
                    alert('Data Id Kriteria Tidak Boleh Kosong!!!');

                } else if ($('#nama_kriteria').val() == '') {
                    alert('Data Nama Kriteria Tidak Boleh Kosong!!!');
                } else if ($('#bobot_kriteria').val() == '') {
                    alert('Data Bobot Kriteria Tidak Boleh Kosong !!!');
                } else {
                    $.ajax({
                        url: "tambah_kriteria.php",
                        method: "POST",
                        data: $('#form_tambah').serialize(),
                        success: function(data) {
                            $('#form_tambah')[0].reset();
                            $('#modal-input').modal('hide');
                        }

                    });
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