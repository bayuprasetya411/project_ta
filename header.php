<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="" class="site_title">
                        SPK CORPORATE
                    </a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="" style="backgroud-color:#fffffff;">
                    <img class="img-responsive" src="assets/telkom2.jpg" style="backgroud-color:#fffffff; width:99%;">
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menu Utama</h3>
                        <ul class="nav side-menu">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="datateknisi.php"><i class="fa fa-table"></i> Data Teknisi <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="datakriteria.php"><i class="fa fa-pie-chart"></i> Data Kriteria <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="datasubkriteria.php"><i class="fa fa-bars"></i> Data Sub Kriteria <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="datanilai.php"><i class="fa fa-calculator"></i> Data Nilai <span class="fa fa-chevron-right"></span></a></li>
                            <li><a href="prosesperangkingan.php"><i class="fa fa-trophy"></i> Proses Perangkingan <span class="fa fa-chevron-right"></span></a></li>
                        </ul>
                    </div>

                </div>
                <!-- sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-user"></span> <b>Hallo, Admin</b>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- top navigation -->

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Keluar</h4>

                    </div>
                    <div class="modal-body">
                        <h5>Anda Akan Keluar dari Halaman Admin?</h5>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                        <a class="btn btn-primary" href="index.php?aksi=logout">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logout Modal-->