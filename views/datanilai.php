<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah data nilai
    if (isset($_POST['tambah'])) {
        $periode = $_POST['periode'];
        $nik = $_POST['nik'];
        $query_sub = mysqli_query($conn, "SELECT *FROM tb_kriteria");
        while ($data = mysqli_fetch_array($query_sub)) {
            if ($data['id_kriteria'] == true) {
                $id_kriteria = $data['id_kriteria'];
                $kri = $_POST['kri'][$id_kriteria];
                $subkri = $_POST['subkri'][$id_kriteria];
                $query_tambah = "INSERT INTO tb_nilai (id_nilai, nik, id_kriteria, periode, id_sub_kriteria ) VALUE ('','$nik','$kri','$periode','$subkri')";
                $tambah = mysqli_query($conn, $query_tambah);
                if ($tambah) {
                    echo "<script>window.alert('Data Berhasil Disimpan');
                    window.location=(href='datanilai.php')</script>";
                } else {
                    echo "<script>window.alert('Data Gagal Disimpan');
                    window.location=(href='datanilai.php')</script>";
                }
            }
        }
    }
    // aksi tambah data nilai

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
                    <h3>Data Nilai</h3>
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
                        <div class="table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <?php
                                            $kriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria");
                                            while ($row1 = mysqli_fetch_array($kriteria)) { ?>
                                            <th><?php echo $row1['nama_kriteria'] ?></th>
                                        <?php } ?>
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <?php
                                            $query_nilai = mysqli_query($conn, "SELECT tb_nilai.id_nilai, tb_teknisi.nama, tb_nilai.id_kriteria, tb_nilai.periode, tb_nilai.id_sub_kriteria , tb_nilai.nik FROM `tb_nilai` 
                                            INNER JOIN tb_teknisi
                                            on tb_nilai.nik = tb_teknisi.nik
                                            INNER JOIN tb_subkriteria
                                            on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria");
                                            while ($row2 = mysqli_fetch_array($query_nilai)) {
                                                $nik = $row2['nik'];
                                                $nama = $row2['nama']; ?>

                                            <td><?php echo $nama ?></td>

                                            <?php
                                                    $kriteria1 = mysqli_query($conn, "SELECT * FROM tb_kriteria");
                                                    while ($row4 = mysqli_fetch_array($kriteria1)) {
                                                        $id_kriteria1 = $row4['id_kriteria'] ?>
                                                <td>
                                                    <?php
                                                                $query_nilai_ultility = mysqli_query($conn, "SELECT tb_nilai.id_kriteria, tb_nilai.nik ,tb_subkriteria.nilai_sub_kriteria, tb_nilai.id_sub_kriteria FROM `tb_nilai` 
                                                                INNER JOIN tb_subkriteria
                                                                on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                                                WHERE tb_nilai.id_kriteria = '$id_kriteria1'  and tb_nilai.nik = $nik ");

                                                                // echo "<pre>";
                                                                // print_r(mysqli_query($conn, "SELECT tb_subkriteria.nilai_sub_kriteria, tb_nilai.id_sub_kriteria FROM `tb_nilai` 
                                                                // INNER JOIN tb_subkriteria
                                                                // on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                                                // WHERE id_kriteria = '" . $row4['id_kriteria'] . "'and nik = '" . $row2['nik'] . "'"));
                                                                // echo "</pre>";

                                                                // exit();

                                                                while ($row3 = mysqli_fetch_array($query_nilai_ultility)) {
                                                                    echo $row3['nilai_sub_kriteria'];
                                                                }
                                                                ?>
                                                </td>
                                            <?php } ?>
                                            <td><?php echo $row2['periode'] ?></td>
                                            <td><button type="button" id="" name="edit" class="btn btn-primary btn-xs edit_data"><i class="fa fa-wrench"></i></button>
                                                <button type="button" id="" name="hapus" class="btn btn-danger btn-xs hapus_data"><i class="fa fa-trash"></i></button>
                                            </td>
                                    </tr>
                                <?php } ?>

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
                                Periode
                            </label>
                            <input type="text" name="periode" class="form-control" id="periode" placeholder="Periode" required="" autofocus="autofocus" />
                        </div>

                        <?php
                            $query_teknisi = mysqli_query($conn, "SELECT * FROM tb_teknisi ORDER BY nik DESC");
                            ?>

                        <div class="form-group">
                            <label class="control-label" for="nik">
                                Nama Teknisi
                            </label>
                            <select name="nik" class="form-control" aria-controls="dataTable" id="nik" required>
                                <option>Pilih Teknisi</option>
                                <?php while ($tampil = mysqli_fetch_array($query_teknisi)) { ?>
                                    <option value="<?php echo $tampil['nik']; ?>"><?php echo $tampil['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <?php
                            $query_kriteria = "SELECT * FROM tb_kriteria";
                            $result_kriteria = mysqli_query($conn, $query_kriteria);
                            while ($row = mysqli_fetch_array($result_kriteria)) {
                                ?>
                            <div class="form-group">
                                <label class="control-label" for="id_kriteria">
                                    <input type="hidden" name="kri[<?php echo $row['id_kriteria'] ?>]" value="<?php echo $row['id_kriteria'] ?>">
                                    <?php echo $row['nama_kriteria'] ?>
                                </label>
                                <select name="subkri[<?php echo $row['id_kriteria'] ?>]" class="form-control" aria-controls="dataTable" id="id_kriteria" required>
                                    <option>Pilih Sub Kriteria</option>
                                    <?php
                                            $query_subkriteria = "SELECT * FROM tb_subkriteria where id_kriteria ='" . $row['id_kriteria'] . "'";
                                            $result_subkriteria = mysqli_query($conn, $query_subkriteria);
                                            while ($data = mysqli_fetch_array($result_subkriteria)) {
                                                ?>
                                        <option value="<?php echo $data['id_sub_kriteria'] ?>"> <?php echo $data['nama_sub_kriteria'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-primary" id="tambah">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Tambah Nilai -->


    <!-- Modal hapus teknisi -->
    <!-- <div id="modal-hapus" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="modalhapus">
    <div class="modal-dialog" role="documnet">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                <h2 class="modal-title" id="modalhapus">Hapus Data Teknisi</h2>

            </div>

            <form method="post" id="form_hapus" role="form" action="">
                <div class="modal-body" id="info_hapus">
                    <input type="hidden" name="nik" class="form-control" id="nik">
                    <H4>Anda Akan Menghapus Data???</H4>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn btn-delfaut" data-dismiss="modal">Tidak</button>
                    <button type="submit" name="hapus" id="hapus" class="btn btn-primary">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
    <!-- /Modal hapus teknisi -->


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


<?php
} else {
    echo "<script>
        alert('Anda Belum Login!!!');window.location=(href='login.php');
    </script>";
}


?>
</body>

    </html>