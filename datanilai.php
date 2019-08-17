<?php
session_start();
if (isset($_SESSION['login'])) {

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPK | Data Nilai</title>


    <!-- Bootstrap -->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jquery -->
    <link href="assets/jquery-ui/jquery-ui.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">

</head>

<body class="nav-md">

    <?php include('header.php');
        include('koneksi.php');


        ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Data Nilai </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabel Data Nilai<small>Corporate Service</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <button class="btn btn-success" id="btn-input" name="btn-input" href="#" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Nilai</button>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Presensi</th>
                                    <th>Disiplin</th>
                                    <th>Produktifitas</th>
                                    <th>Gaul</th>
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>I Gede Suartama</td>
                                    <td>100</td>
                                    <td>80</td>
                                    <td>65</td>
                                    <td>0</td>
                                    <td>Maret-2019</td>
                                    <td><button type="button" id="" name="hapus" class="btn btn-danger btn-sm hapus_data"><i class="fa fa-trash"></i> Hapus </button>
                                        <button type="button" id="" name="edit" class="btn btn-primary btn-sm edit_data"><i class="fa fa-wrench"></i> Ubah </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>I Gede Suartama</td>
                                    <td>100</td>
                                    <td>80</td>
                                    <td>65</td>
                                    <td>0</td>
                                    <td>Maret-2019</td>
                                    <td><button type="button" id="" name="hapus" class="btn btn-danger btn-sm hapus_data"><i class="fa fa-trash"></i> Hapus </button>
                                        <button type="button" id="" name="edit" class="btn btn-primary btn-sm edit_data"><i class="fa fa-wrench"></i> Ubah </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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

    <!-- Modal Tambah Nilai -->

    <div id="modal-input" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modalinput">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalinput">Tambah Data Nilai</h2>

                </div>

                <form id="form_tambah" method="post" role="form" action="">
                    <div class="modal-body">
                        <div class="form-group" id="tabel_tambah">
                            <label class="control-label" for="nik">
                                <h4>Periode</h4>
                            </label>
                            <input type="text" name="periode" class="form-control" id="periode" placeholder="Periode" required="" autofocus="autofocus" />
                        </div>

                        <?php
                            $query_area = mysqli_query($conn, "SELECT * FROM tb_teknisi ORDER BY nik DESC");
                            ?>

                        <div class="form-group">
                            <label class="control-label" for="nik">
                                <h4>Nama Teknisi</h4>
                            </label>
                            <select name="nik" class="form-control" aria-controls="dataTable" id="nik" required>
                                <option>Pilih Teknisi</option>
                                <?php while ($tampil = mysqli_fetch_array($query_area)) { ?>
                                <option value="<?php echo $tampil['nik']; ?>"><?php echo $tampil['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="id_sub_kriteria">
                                <h4>Nama Kriteria</h4>
                            </label>
                            <select name="id_sub_kriteria" class="form-control" aria-controls="dataTable" id="id_sub_kriteria" required>
                                <option>Pilih Sub Kriteria</option>
                                <option value=""></option>
                            </select>
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
    <!-- /Modal Tambah Teknisi -->

    <!-- Modal ubah Teknisi-->
    <div class="modal fade" id="modal-ubah" role="dialog" aria-labelledby="modalubah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="#modalubah">Ubah Data Teknisi</h2>

                </div>

                <form method="post" id="form_ubah" role="form" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="nik">
                                <h4>Nik Karyawan</h4>
                            </label>
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="Nik Karyawan" required readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama">
                                <h4>Nama Karyawan</h4>
                            </label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Karyawan" autofocus="autofocus" required>
                        </div>

                        <?php
                            $query_area = mysqli_query($conn, "SELECT * FROM tb_area ORDER BY id_area DESC");
                            ?>

                        <div class="form-group">
                            <label class="control-label" for="id_area">
                                <h4>Area</h4>
                            </label>
                            <select name="id_area" class="form-control" aria-controls="dataTable" id="id_area">
                                <option>Pilih Area</option>
                                <?php while ($data = mysqli_fetch_array($query_area)) { ?>
                                <option value="<?php echo $tampil['id_area']; ?>"><?php echo $data['area']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="no_telpon">
                                <h4>No Telpon (08xxxxxxxxxxxxxx)</h4>
                            </label>
                            <input type="text" name="no_telpon" class="form-control" id="no_telpon" placeholder="Notel Karyawan" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="reset" class=" btn btn-danger">Reset</button>
                        <button type="submit" name="editdata" id="editdata" class=" btn btn-primary">Simpan</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal ubah Teknisi-->

    <!-- Modal hapus teknisi -->
    <div id="modal-hapus" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="modalhapus">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modalhapus">Hapus Data Teknisi</h2>

                </div>

                <form method="post" role="form" action="crudteknisi.php">
                    <div class="modal-body">
                        <input type="hidden" name="nik" class="form-control" id="nik">
                        <H4>Anda Akan Menghapus Data???</H4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" btn btn-delfaut" data-dismiss="modal">Tidak</button>
                        <button type="submit" name="hapusdata" class=" btn btn-primary">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal hapus teknisi -->


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

    <!-- Script tambah teknisi -->
    <script>
        $(document).ready(function() {

            $(document).on('click', '.edit_data', function() {
                var nik = $(this).attr('nik');
                $.ajax({
                    url: "ubahteknisi.php",
                    method: "POST",
                    data: {
                        nik: nik
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#nik').val(data.nik);
                        $('#nama').val(data.nama);
                        $('#id_area').val(data.id_area);
                        $('#no_telpon').val(data.no_telpon);

                        $('#editdata').val("Update");
                        $('#modal-ubah').modal('show');
                    }


                });

            });

            $('#form_tambah').on('submit', function(event) {
                event.preventDefault();

                if ($('#nik').val() == '') {
                    alert('Data Nik Tidak Boleh Kosong!!!');
                } else if ($('#nama').val() == "") {
                    alert('Data Nama Tidak Boleh Kosong!!!');
                } else if ($('#no_telpon').val() == "") {
                    alert('Data No Telpon Tidak Boleh Kosong!!!');
                } else {
                    $.ajax({
                        url: "tambahteknisi.php",
                        type: "POST",
                        data: $('#form_tambah').serialize(),
                        success: function(data) {
                            $('#form_tambah')[0].reset();
                            $('#modal-input').modal('hide');
                            $('#tabel_tambah').html(data);
                        }
                    });
                }
            });
        });
    </script>
    <!-- Script tambah teknisi -->


    <?php
    } else {
        echo "<script>
        alert('Anda Belum Login!!!');window.location=(href='login.php');
    </script>";
    }


    ?>
</body>

</html>