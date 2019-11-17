<?php
session_start();
if (isset($_SESSION['login'])) {

    include('../config/koneksi.php');

    // aksi tambah nilai
    if (isset($_POST['tambah_nilai'])) {

        $id_periode = $_POST['id_periode'];
        $nik = $_POST['nik'];
        $query_kriteria = mysqli_query($conn, "SELECT * FROM tb_periode_has_kriteria where id_periode = '" . $id_periode . "'");
        while ($data_kriteria = mysqli_fetch_array($query_kriteria)) {
            $id_kri = $data_kriteria['id_kriteria'];
            $id_kriteria = $_POST['id_kriteria'][$id_kri];
            $id_sub_kriteria = $_POST['id_sub_kriteria'][$id_kri];
            $query_tambah =  "INSERT INTO tb_nilai (nik,id_kriteria, id_sub_kriteria, id_periode) value ('$nik','$id_kriteria','$id_sub_kriteria','$id_periode')";
            $tambah_nilai = mysqli_query($conn, $query_tambah);
        }

        if ($tambah_nilai) {
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
    // aksi tambah nilai

    // aksi ubah nilai
    if (isset($_POST['update_nilai'])) {

        for ($i = 0; $i < count($_POST['id_sub_kriteria']); $i++) {
            $id_periode =  $_POST['id_periode'][$i];
            $nik = $_POST['nik'][$i];
            $id_nilai = $_POST['id_nilai'][$i];
            $id_sub_kriteria =  $_POST['id_sub_kriteria'][$i];
            $query_update_nilai = "UPDATE tb_nilai SET id_sub_kriteria ='" . $id_sub_kriteria . "' WHERE id_nilai ='" . $id_nilai . "'";
            $update_nilai = mysqli_query($conn, $query_update_nilai);
        }

        if ($update_nilai) {
            echo "<script>  window.alert('Data Berhasil di Ubah');
                window.location = (href = 'datanilai.php');
                    </script>";
        } else {
            echo "<script>
                        window.alert('Data Gagal di Ubah');
                        window.location = (href = 'datanilai.php');
                </script>";
        }
    }
    // aksi ubah nilai

    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>SPK | Data Nilai</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <?php include('../config/stylesheet.php'); ?>
    </head>

    <!-- header -->
    <?php
        include('header.php');
        include('../config/function.php');
        // error_reporting(0);
        $periode = tgl_indo(date('Y-m'));
        ?>

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
                        <div class="clearfix"></div>
                    </div>

                    <form action="" method="get">
                        <div class="container">
                            <div class="row">
                                <div class='col-sm-4 col-sm-offset-8'>
                                    <div class="form-group">
                                        <div class='input-group'>
                                            <select name="periode" class="form-control select-search-periode" id="filter_periode" style="width:100%;">
                                                <option></option>
                                                <?php
                                                    $queryperiode = mysqli_query($conn, "SELECT tb_nilai.id_periode, tb_periode.nama_periode FROM tb_nilai
                                                        inner join tb_periode
                                                        on tb_nilai.id_periode = tb_periode.id_periode 
                                                        group by tb_nilai.id_periode");
                                                    while ($row = mysqli_fetch_array($queryperiode)) { ?>
                                                    <option value="<?php echo $row['nama_periode'] ?>"><?php echo $row['nama_periode'] ?></option>
                                                <?php
                                                    } ?>
                                            </select>

                                            <span class="input-group-btn">
                                                <button type="submit" style="height: 38px;" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <button class="btn btn-success" id="modal_tambah_nilai_btn" name="modal_tambah_nilai_btn" href="#" data-toggle="modal" data-target="#modal-tambah-nilai"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Nilai</button>
                    <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:60%">Nama Teknisi</th>
                                <th style="width:25%">Periode</th>
                                <th class="text-center" style="width:15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>


                            <?php
                                // filter berdasarkan Periode
                                if (!empty($_GET)) {
                                    $query_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai
                                        INNER JOIN tb_periode
                                        ON tb_nilai.id_periode = tb_periode.id_periode
                                        INNER JOIN tb_teknisi
                                        ON tb_nilai.nik = tb_teknisi.nik
                                        INNER JOIN tb_subkriteria
                                        on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                        where tb_periode.nama_periode ='" . $_GET['periode'] . "'
                                        group by tb_nilai.nik ");
                                    // echo "<pre>";

                                    // print_r($row = mysqli_fetch_array($query_nilai));
                                    // echo "</pre>";
                                    // exit();

                                    while ($datanilai = mysqli_fetch_array($query_nilai)) { ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" id="nik" name="nik" value="<?php echo $datanilai['nik'] ?>"><?php echo $datanilai['nama'] ?>
                                        </td>
                                        <td>
                                            <input type="hidden" id="id_periode" name="id_periode" value="<?php echo $datanilai['id_periode'] ?>"><?php echo $datanilai['nama_periode'] ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-xs edit_nilai" id="edit_nilai_btn"><i class="fa fa-wrench"></i> Edit</button>
                                            <button type="button" class="btn btn-warning btn-xs detail_periode" id="detail_nilai_btn"><i class="glyphicon glyphicon-resize-full"></i> Detail</button>
                                        </td>
                                    </tr>
                                <?php }
                                    }
                                    // filter berdasarkan Periode

                                    // filter berdasarkan bulan sekarang
                                    else {
                                        $query_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai
                                    INNER JOIN tb_periode
                                    ON tb_nilai.id_periode = tb_periode.id_periode
                                    INNER JOIN tb_teknisi
                                    ON tb_nilai.nik = tb_teknisi.nik
                                    INNER JOIN tb_subkriteria
                                    on tb_nilai.id_sub_kriteria = tb_subkriteria.id_sub_kriteria
                                    where tb_periode.nama_periode ='" . $periode . "'
                                    group by tb_nilai.nik
                                    ");
                                        // echo "<pre>";

                                        // print_r($row = mysqli_fetch_array($query_nilai));
                                        // echo "</pre>";
                                        // exit();

                                        while ($datanilai = mysqli_fetch_array($query_nilai)) { ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" id="nik" name="nik" value="<?php echo $datanilai['nik'] ?>"><?php echo $datanilai['nama'] ?>
                                        </td>
                                        <td>
                                            <input type="hidden" id="id_periode" name="id_periode" value="<?php echo $datanilai['id_periode'] ?>"><?php echo $datanilai['nama_periode'] ?>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-xs edit_nilai" id="edit_nilai_btn"><i class="fa fa-wrench"></i> Edit</button>
                                            <button type="button" class="btn btn-warning btn-xs detail_periode" id="detail_nilai_btn"><i class="glyphicon glyphicon-resize-full"></i> Detail</button>
                                        </td>
                                    </tr>
                            <?php   }
                                }
                                // filter berdasarkan bulan sekarang
                                ?>
                        </tbody>
                    </table>
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
                    <h2 class="modal-title text-center" id="modaltambahnilai">Tambah Data Nilai</h2>
                </div>

                <form id="form_tambah_nilai" method="post" role="form" data-parsley-validate action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label" for="id_periode">
                                Periode
                            </label>
                            <select class="form-control select-periode" id="id_periode" name="id_periode" style="width:100%;" required>
                                <option></option>
                                <?php
                                    $queryperiode = mysqli_query($conn, "SELECT * FROM tb_periode");
                                    while ($dataperiode = mysqli_fetch_array($queryperiode)) { ?>
                                    <option value="<?php echo $dataperiode['id_periode'] ?>"><?php echo $dataperiode['nama_periode'] ?></option>
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
                                <?php while ($datateknisi = mysqli_fetch_array($query_teknisi)) { ?>
                                    <option value="<?php echo $datateknisi['nik']; ?>"><?php echo $datateknisi['nama']; ?></option>
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
                    <h2 class="modal-title text-center" id="modaleditnilai">Ubah Data Nilai</h2>
                </div>

                <form id="form_edit_nilai" method="post" role="form" action="">
                    <div class="modal-body" id="info-edit-nilai">
                        <!-- info-edit-nilai -->
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

    <!-- Modal Detail Nilai-->
    <div id="modal-detail-nilai" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="#modaldetailnilai">
        <div class="modal-dialog" role="documnet">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title text-center" id="modaldetilnilai">Detail Data Nilai</h2>
                </div>
                <form id="form_detail_nilai" method="post" role="form" action="">
                    <div class="modal-body" id="info-detail-nilai">
                        <!-- info-detail-nilai -->
                    </div>
                    <div class="modal-footer">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal Detail Nilai -->

    <?php include('../config/javascript.php'); ?>

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
                        // console.log(resultObj);
                        var html = '';
                        $.each(resultObj, function(key, val) {

                            html += `<tr>
                            <td>
                                <input type="hidden" name="id_kriteria[` + val.id_kriteria + `]" class="form-control item-kriteria" id="id_kriteria" value ="` + val.id_kriteria + `" />` + val.nama_kriteria + `
                            </td>
                            <td>
                                <input type="hidden" value="` + val.id_kriteria + `" > 
                                <select  name="id_sub_kriteria[` + val.id_kriteria + `]" class="form-control   select-subkriteria" id="id_sub_kriteria` + val.id_kriteria + `" style="width:100%; required " >
                                    <option value="0">-- Pilih Sub Kriteria --</option>
                                </select>
                            </td>`;

                        });

                        $('#load-data').html(html);
                        $.each(resultObj, function(key, val) {

                            $.getJSON("fill_subkriteria.php?id_kriteria=" + val.id_kriteria, function(data) {
                                console.log(data);
                                for (var key in data) {
                                    // console.log(data[key].nama_sub_kriteria);
                                    // console.log('#id_sub_kriteria' + data[key].id_kriteria);
                                    $('#id_sub_kriteria' + data[key].id_kriteria).append(`<option value="` + data[key].id_sub_kriteria + `">` + data[key].nama_sub_kriteria + `</option>`);
                                }
                            });
                        });
                    }
                });
            });
            // Script change periode

            // script edit data nilai
            $(document).on('click', '#edit_nilai_btn', function() {

                var id_periode = $(this).parent().prev().children('input').val();
                var nik = $(this).parent().prev().prev().children('input').val();
                // var id_periode = $('#id_periode').val();
                // var nik = $('#nik').val();
                console.log(nik);
                console.log(id_periode);
                $.ajax({
                    url: "update_nilai.php",
                    method: "GET",
                    data: {
                        'id_periode': id_periode,
                        'nik': nik
                    },
                    success: function(data) {
                        i = 0;
                        var dataEdit = JSON.parse(data);
                        console.log(dataEdit);
                        $('#modal-edit-nilai').modal("show");
                        var junk = "";
                        var item_nilai = "";
                        for (var key in dataEdit.nilai) {

                            junk += `
                            <tr>

                                <td>
                                    <input type="hidden" name="id_nilai[` + i + `]" class="form-control" id="id_nilai" value ="` + dataEdit.nilai[key].id_nilai + `" />
                                    <input type="hidden" name="id_kriteria[` + i + `]" class="form-control item-kriteria" id="id_kriteria" value ="` + dataEdit.nilai[key].id_kriteria + `" />` + dataEdit.nilai[key].nama_kriteria + `
                                </td>
                                <td>
                                    <input type="hidden" name="id_kriteria" value="` + dataEdit.nilai[key].id_kriteria + `" > 
                                    <select  name="id_sub_kriteria[` + i + `]" class="form-control select-subkriteria" id="id_sub_kriteria` + dataEdit.nilai[key].id_kriteria + `" style="width:100%; required" >
                                        <option value="` + dataEdit.nilai[key].id_sub_kriteria + `">` + dataEdit.nilai[key].nama_sub_kriteria + `</option>
                                    </select>
                                </td>
                            </tr>
                            `;
                            i++;
                        }
                        $.each(dataEdit.nilai, function(key, val) {

                            $.getJSON("fill_subkriteria.php?id_kriteria=" + val.id_kriteria, function(data) {
                                console.log(data);
                                for (var key in data) {
                                    // console.log(data[key].nama_sub_kriteria);
                                    // console.log('#id_sub_kriteria' + data[key].id_kriteria);
                                    $('#id_sub_kriteria' + data[key].id_kriteria).append(`<option value="` + data[key].id_sub_kriteria + `">` + data[key].nama_sub_kriteria + `</option>`);
                                }
                            });
                        });
                        item_nilai += ` 
                        
                            <div class="form-group">
                                <label class = "control-label" 'for = "id_periode">Periode</label>
                                <input type = "text" name = "id_periode" class = "form-control" id = "id_periode" value = "` + dataEdit.nama_periode + `"  readonly / >
                            </div>

                            <div class="form-group">
                                <label class = "control-label" 'for = "nik">Nama Teknisi</label>
                                <input type = "text" name = "nik" class = "form-control" id = "nik" value = "` + dataEdit.nama + `"  readonly / >
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

            // Script detail data nilai
            $(document).on('click', '#detail_nilai_btn', function() {

                var id_periode = $(this).parent().prev().children('input').val();
                var nik = $(this).parent().prev().prev().children('input').val();
                console.log(nik);

                $.ajax({
                    url: "detail_nilai.php",
                    method: "GET",
                    data: {
                        'id_periode': id_periode,
                        'nik': nik
                    },
                    success: function(data) {
                        var dataDetail = JSON.parse(data);
                        console.log();
                        $("#modal-detail-nilai").modal("show");
                        var junk = "";
                        var item_nilai = "";
                        for (var key in dataDetail.nilai) {

                            junk += `
                            <tr>
                                <td>` + dataDetail.nilai[key].nama_kriteria + `</td>
                                <td class ="text-center">` + dataDetail.nilai[key].nilai_sub_kriteria + `</td>
                            </tr>
                            `;
                        }
                        item_nilai += ` 

                            <div class = "row">
                                <div class="form-group">
                                    <div class="col-xs-3 col-sm-3 col-md-3"><label class = "control-label" >PERIODE</label></div>
                                    <div>` + dataDetail.nama_periode + `</div>
                                </div>
                            </div>

                            <div class = "row">
                                <div class="form-group">
                                    <div class="col-xs-3 col-sm-3 col-md-3"><label class = "control-label">NAMA TEKNISI</label></div>
                                    <div>` + dataDetail.nama + ` </div>
                                </div>
                            </div>
                            <p></p>

                            <div class="form-group">
                            <table class="table">
                                <thead style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th class ="text-center" style="width:50%">Nilai</th>
                                    </tr>
                                </thead>

                                <tbody id="load-data">
                                    ` + junk + `
                                </tbody>

                                <tfoot style="background-color:#ddffdd; border: 1px solid #ddffdd;">
                                    <tr>
                                        <th style="width:50%">Kriteria</th>
                                        <th class ="text-center" style="width:50%">Nilai</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        `;
                        $('#info-detail-nilai').html(item_nilai);
                    }
                });
            });
            // Script detail data nilai

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