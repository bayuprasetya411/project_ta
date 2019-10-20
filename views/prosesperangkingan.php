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

        <title>SPK | Proses Perangkingan</title>


        <!-- Bootstrap -->
        <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../assets/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- jquery -->
        <link href="../assets/jquery-ui/jquery-ui.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../assets/build/css/custom.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="../assets/build/select2/select2.min.css" rel="stylesheet">

    </head>

    <!-- header -->
    <?php include('header.php');
        include('../config/koneksi.php');
        include('../config/function.php');
        ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Proses Perangkingan</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabel Ranking Teknisi<small>Corporate Service</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form action="" method="get">
                            <div class="input-group col-md-4 col-md-offset-8">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
                                <select type="submit" name="filter_periode" class="form-control select-search-periode" id="filter_periode" style="width:100%;">
                                    <option></option>
                                    <?php
                                        $queryperiode = mysqli_query($conn, "SELECT tb_nilai.id_periode, tb_periode.nama_periode FROM tb_nilai
                                    inner join tb_periode
                                    on tb_nilai.id_periode = tb_periode.id_periode 
                                    group by tb_nilai.id_periode");
                                        while ($row = mysqli_fetch_array($queryperiode)) { ?>
                                        <option value="<?php echo $row['id_periode'] ?>"><?php echo $row['nama_periode'] ?></option>
                                    <?php
                                        } ?>
                                </select>
                            </div>
                        </form>


                        <label>
                            <h2><b>Peringkat Teknisi Periode <a style="color:blue;">Maret-2019</a></b></h2>
                        </label>
                        <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead id="data-th">
                                <tr>
                                    <th>Nama Teknisi</th>

                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Periode</th>
                                    <th>Total Nilai</th>
                                    <th>Rank</th>


                            </thead>




                        </table>
                        <button type="button" class="btn btn-primary" name="cetak_laporan" id="cetak_laporan"><i class="fa fa-print"></i> Cetak Laporan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- /page content -->

    <?php include('footer.php'); ?>

    </div>
    </div>

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
        $(".select-search-periode").select2({
            placeholder: "-- Pilih Periode --",
            allowClear: true
        });

        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true
            });
        });

        $.ajax({
            type: "GET",
            data: "",
            url: "data_proses_nilai.php",
            success: function(data) {

            }


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