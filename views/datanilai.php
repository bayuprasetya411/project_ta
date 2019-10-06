<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah periode
    if (isset($_POST['tambah_nilai'])) {
        $id_periode = $_POST['id_periode'];
        $nik = $_POST['nik'];
        $data_sub_kriteria = $_POST['id_sub_kriteria'];
        foreach ($data_sub_kriteria as $id_sub_kriteria) {
            $query_tambah =  "INSERT INTO tb_nilai (nik, id_sub_kriteria,id_periode) value ('$nik','$id_sub_kriteria','$id_periode')";
            $tambah = mysqli_query($conn, $query_tambah);
        }
        // echo "<pre>";
        // print($nama_periode);
        // print_r($id_kriteria);
        // echo "</pre>";
        // exit();

        if ($tambah) {
            echo "<script>
            alert('Data Berhasil di Simpan');
            window.location = (href = 'datanilai.php');
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal di Simpan');
            window.location = (href = 'datanilai.php')
            </script>";
        }
    }
    // aksi tambah periode

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
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>SPK | Data Nilai</title>
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
    <?php include('header.php');
        include('../config/function.php');
        $periode = tgl_indo(date('Y-m')); ?>

    <!-- Page Content -->

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

                    <form action="" method="get">
                        <div class="input-group col-md-4 col-md-offset-8">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                            <select type="submit" name="periode" class="form-control select-search-periode" id="periode" style="width:100%;">
                                <option></option>
                                <?php
                                    $queryperiode = mysqli_query($conn, "SELECT * FROM tb_periode");
                                    while ($row = mysqli_fetch_array($queryperiode)) { ?>
                                    <option value="<?php echo $row['id_periode'] ?>"><?php echo $row['nama_periode'] ?></option>
                                <?php
                                    } ?>
                            </select>
                        </div>
                    </form>

                    <button class="btn btn-success" id="modal_tambah_nilai_btn" name="modal_tambah_nilai_btn" href="#" data-toggle="modal" data-target="#modal-tambah-nilai"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Nilai</button>
                    <div class="table-responsive">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:60%">Nama Teknisi</th>
                                    <th style="width:30%">Periode</th>
                                    <th style="width:10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $query_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai
                                    INNER JOIN tb_periode
                                    ON tb_nilai.id_periode = tb_periode.id_periode
                                    INNER JOIN tb_teknisi
                                    ON tb_nilai.nik = tb_teknisi.nik
                                    INNER JOIN tb_subkriteria
                                    on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                    where tb_periode.nama_periode ='maret-2019'
                                    group by tb_nilai.nik ");
                                    // echo "<pre>";

                                    // print_r($row = mysqli_fetch_array($query_nilai));
                                    // echo "</pre>";
                                    // exit();

                                    while ($row = mysqli_fetch_array($query_nilai)) { ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" id="nik" name="nik" value="<?php echo $row['nik'] ?>"><?php echo $row['nama'] ?>
                                        </td>
                                        <td>
                                            <input type="hidden" id="id_periode" name="id_periode" value="<?php echo $row['id_periode'] ?>"><?php echo $row['nama_periode'] ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-xs edit_nilai" id="edit_nilai_btn"><i class="fa fa-wrench"></i> Edit</button>
                                            <button type="button" class="btn btn-warning btn-xs detail_periode" id="detail_nilai_btn"><i class="glyphicon glyphicon-resize-full"></i> Detail</button>
                                        </td>
                                    </tr>
                                <?php }
                                    ?>

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


    <!-- Modal Tambah Data Nilai -->

    <div id="modal-tambah-nilai" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaltambahnilai">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modaltambahnilai">Tambah Data Nilai</h2>
                </div>

                <form id="form_tambah_nilai" method="post" role="form" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="id_periode">
                                Periode
                            </label>
                            <select class="form-control select-periode" id="id_periode" name="id_periode" style="width:100%;" required>
                                <option></option>
                                <?php
                                    $queryperiode = mysqli_query($conn, "SELECT * FROM tb_periode");
                                    while ($row = mysqli_fetch_array($queryperiode)) { ?>
                                    <option value="<?php echo $row['id_periode'] ?>"><?php echo $row['nama_periode'] ?></option>
                                <?php
                                    } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nik">
                                Nama Teknisi
                            </label>
                            <select name="nik" class="form-control select-teknisi" id="nik" style="width:100%;" required>
                                <option></option>
                                <?php
                                    $query_teknisi = mysqli_query($conn, "SELECT * FROM tb_teknisi ORDER BY nik DESC");
                                    ?>
                                <?php while ($tampil = mysqli_fetch_array($query_teknisi)) { ?>
                                    <option value="<?php echo $tampil['nik']; ?>"><?php echo $tampil['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <table class="table">
                                <thead style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th style="width:50%">Sub Kriteria</th>
                                    </tr>
                                </thead>

                                <tbody id="load-data">
                                    <tr>

                                    </tr>
                                </tbody>

                                <tfoot style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th style="width:50%">Sub Kriteria</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah_nilai" class="btn btn-primary" id="tambah_nilai_btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Tambah Nilai -->

    <!-- Modal Edit Nilai-->
    <div id="modal-edit-nilai" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaleditnilai">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title" id="modaleditnilai">Ubah Data Nilai</h2>

                </div>

                <form id="form_edit_nilai" method="post" role="form" action="">
                    <div class="modal-body" id="info-edit-nilai">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="update_nilai" class="btn btn-primary" id="update_nilai">Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Edit Nilai -->

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

            $(".select-search-periode").select2({
                placeholder: "-- Pilih Periode --",
                allowClear: true
            });

            $('.select-periode').select2({
                dropdownParent: $('#modal-tambah-nilai'),
                placeholder: "-- Pilih Periode --",
                allowClear: true
            });

            $('.select-teknisi').select2({
                dropdownParent: $('#modal-tambah-nilai'),
                placeholder: "-- Pilih Teknisi --",
                allowClear: true
            });


            // Script change periode
            $(document).on('change', '.select-periode', function() {
                var id_periode = $(this).val();
                $.ajax({
                    url: "fill_periode.php",
                    method: "POST",
                    data: {
                        id_periode: id_periode
                    },
                    success: function(result) {
                        var resultObj = JSON.parse(result);
                        console.log(resultObj);

                        var html = '';
                        $.each(resultObj, function(key, val) {

                            html += `<tr>
                            <td><input type="hidden" name="id_kriteria[]" class="form-control item-kriteria" id="id_kriteria" value ="` + val.id_kriteria + `" />` + val.nama_kriteria + `</td>
                            <td><select  name="id_sub_kriteria[]" class="form-control   select-subkriteria" id="id_sub_kriteria` + val.id_kriteria + `" style="width:100%;" ><option value="` + val.id_kriteria + `">-- Pilih Sub Kriteria --</option></select></td>`;

                        });
                        $('#load-data').html(html);
                    }
                })

            });
            // Script change periode

            // script edit data nilai
            $(document).on('click', '#edit_nilai_btn', function() {

                var id_periode = $(this).parent().prev().children('input').val();
                var nik = $(this).parent().prev().prev().children('input').val();
                console.log(nik);
                $.ajax({
                    url: "update_nilai.php",
                    method: "GET",
                    data: {
                        'id_periode': id_periode,
                        'nik': nik
                    },
                    success: function(data) {
                        var dataEdit = JSON.parse(data);
                        console.log();
                        $('#modal-edit-nilai').modal("show");
                        var junk = "";
                        var item_nilai = "";
                        for (var key in dataEdit.nilai) {

                            junk += `
                            <tr>
                                <td><input type="hidden" name="id_kriteria[]" class="form-control item-kriteria" id="id_kriteria" value ="` + dataEdit.nilai[key].id_kriteria + `" />` + dataEdit.nilai[key].nama_kriteria + `</td>
                                <td>
                                    <input type="hidden" name="id_kriteria" value="` + dataEdit.nilai[key].id_kriteria + `" > 
                                    <select  name="id_sub_kriteria[]" class="form-control select-subkriteria" id="id_sub_kriteria` + dataEdit.nilai[key].id_kriteria + `" style="width:100%;" ><option value="` + dataEdit.nilai[key].id_sub_kriteria + `">` + dataEdit.nilai[key].nama_sub_kriteria + `</option></select>
                                </td>
                            </tr>
                            `;
                        }
                        item_nilai += `<div class="form-group">
                            <label class = "control-label" 'for = "id_periode">Periode</label>
                            <input type = "text" name = "id_periode" class = "form-control" id = "id_periode" value = "` + dataEdit.nama_periode + `"  readonly / ></div>

                            <div class="form-group">
                            <label class = "control-label" 'for = "nik">Nama Teknisi</label>
                            <input type = "text" name = "nik" class = "form-control" id = "nik" value = "` + dataEdit.nama + `"  readonly / ></div>

                            <div class="form-group">
                            <table class="table">
                                <thead style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th style="width:50%">Sub Kriteria</th>
                                    </tr>
                                </thead>

                                <tbody id="load-data">
                                    ` + junk + `
                                </tbody>

                                <tfoot style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th style="width:50%">Sub Kriteria</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        `;

                        $('#info-edit-nilai').html(item_nilai);
                    }
                });
            });
            // script edit data nilai

            // Script Select Sub Kriteria
            $(document).on('click', '.select-subkriteria', function() {

                console.log($(this).prev('input').val());
                console.log($(this).children().html().toString());
                var id_kriteria = $(this).prev('input').val();
                $.ajax({
                    url: "fill_subkriteria.php",
                    method: "POST",
                    data: {
                        id_kriteria: id_kriteria
                    },
                    success: function(result_subkriteria) {
                        var resultObj_sub = JSON.parse(result_subkriteria);
                        console.log(resultObj_sub);
                        // var html1 = '<option selected value="' + $(this).val() + '">TES</option>';
                        var html1 = '';
                        $.each(resultObj_sub, function(key, val) {


                            html1 += '<option value="' + val.id_sub_kriteria + '">' + val.nama_sub_kriteria + '</option>';
                            // console.log(id_sub_kriteria);

                            $('#id_sub_kriteria' + val.id_kriteria).html(html1);
                        });
                    }
                });

            });
            // Script Select Sub Kriteria

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