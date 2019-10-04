<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0; background-color:#d73925;">
                        <a href="" class="site_title ">
                            SPK CORPORATE
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="../assets/logoccan.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <h2>Admin</h2>
                            <a href="#" style="color:white;"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>MENU UTAMA</h3>
                            <div class="separator"></div>
                            <ul class="nav side-menu">
                                <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="datateknisi.php"><i class="fa fa-user"></i> Data Teknisi <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="datakriteria.php"><i class="fa fa-pie-chart"></i> Data Kriteria <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="dataperiode.php"><i class="fa fa-calendar-o"></i> Data Periode <span class="fa fa-chevron-right"></span></a></li>
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
                <div class="nav_menu" style="border: 0; background-color:#dd4b39;">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars" style="color:white;"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/logoccan.jpg" alt=""><b style="color:white;">Hallo, Admin</b>
                                    <span class=" fa fa-angle-down" style="color:white;"></span>
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
                            <button class="btn btn-default" type="button" data-dismiss="modal">Tidak</button>
                            <a class="btn btn-primary" href="index.php?aksi=logout">Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Logout Modal-->