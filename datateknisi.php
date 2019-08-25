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

    <title>SPK | Data Teknisi</title>

    <!-- jQuery -->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
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

<!-- header -->
<?php include('header.php');
    include('koneksi.php');
    ?>

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
                    <button class="btn btn-success" id="btn-input" name="btn-input" href="#" data-toggle="modal" data-target="#modal-input"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Teknisi</button>
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped" cellspacing="0" width="100%">
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
                                    $query = mysqli_query($conn, 'SELECT tb_teknisi.nik,tb_teknisi.nama,tb_teknisi.no_telpon, tb_area.area, tb_area.id_area FROM tb_teknisi
                                    inner JOIN tb_area on tb_teknisi.id_area = tb_area.id_area');

                                    while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                <tr>
                                    <td><?php echo $data['nik']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['no_telpon']; ?></td>
                                    <td><?php echo $data['area']; ?></td>
                                    <td><button type="button" id="<?php echo $data['nik']; ?>" name="hapus" class="btn btn-danger btn-sm hapus_data"><i class="fa fa-trash"></i></button>
                                        <button type="button" id="<?php echo $data['nik']; ?>" name="ubah" class="btn btn-primary btn-sm ubah_data"><i class="fa fa-wrench"></i></button>
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
                <div class="modal-body">
                    <div class="form-group" id="tabel_tambah">
                        <label class="control-label" for="nik">
                            <h4>Nik Karyawan</h4>
                        </label>
                        <input type="text" name="nik" class="form-control" id="nik" placeholder="Nik Karyawan" autofocus="autofocus" />
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="nama">
                            <h4>Nama Karyawan</h4>
                        </label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Karyawan">
                    </div>

                    <?php
                        $query_area = mysqli_query($conn, "SELECT * FROM tb_area ORDER BY id_area DESC");
                        ?>

                    <div class="form-group">
                        <label class="control-label" for="id_area">
                            <h4> Area</h4>
                        </label>
                        <select name="id_area" class="form-control" id="id_area">
                            <option></option>
                            <?php while ($tampil = mysqli_fetch_array($query_area)) { ?>
                            <option value="<?php echo $tampil['id_area']; ?>"><?php echo $tampil['area']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="no_telpon">
                            <h4>No Telpon (08xxxxxxxxxxxx)</h4>
                        </label>
                        <input type="number" name="no_telpon" class="form-control" id="no_telpon" placeholder="Notel Karyawan">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="" class=" btn btn-danger">Reset</button>
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
                <div class="modal-body" id="info_ubah">

                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn btn-delfaut" data-dismiss="modal">Batal</button>
                    <button type="submit" name="ubahdata" id="ubahdata" class=" btn btn-primary">Simpan</button>
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


<script>
    $(document).ready(function() {

        // Script ubah teknisi
        $(document).on('click', '.ubah_data', function() {
            var nik = $(this).attr('id');
            $.ajax({
                url: "ubahteknisi.php",
                method: "POST",
                data: {
                    nik: nik
                },
                success: function(data) {

                    $('#info_ubah').html(data);
                    $('#modal-ubah').modal('show');

                }


            });

        });
        // end Script ubah teknisi

        // Script tambah teknisi
        $('#form_tambah').on('submit', function(event) {
            event.preventDefault();

            if ($('#nik').val() == '') {
                alert('Data Nik Tidak Boleh Kosong!!!');
            } else if ($('#nama').val() == "") {
                alert('Data Nama Tidak Boleh Kosong!!!');
            } else if ($('#id_area').val() == "") {
                alert('Pilih Data Area!!!');
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
        // end Script tambah teknisi
    });
</script>



<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
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