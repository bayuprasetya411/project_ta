<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SPK | Login</title>

    <!-- Bootstrap -->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="assets/build/css/custom.min.css" rel="stylesheet">

</head>
Prema Waisnawa EDit
<body class="login" style="background-color:grey">
    <div class="login_wrapper">
        <div class="card-body">
 IYESSSSSSSSSSSSSSSSSSSSSSSSS
            <form method="post" action="" class="form-horizontal form-label-left input_mask">
                <div class="" style="text-align:center; color:white;">
                    <?php

                    include 'koneksi.php';
                    session_start();

                    if (isset($_POST['submit'])) {
                        $user = $_POST['username'];
                        $pass = $_POST['password'];

                        if ($user != 'admin' or $pass != 'telkom135') { ?>
                    <div class="alert alert-danger alert-dismissible fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                        <strong>Login Gagal!!!</strong> Username atau Password Salah
                    </div>
                    <?php } else {
                            if ($user == 'admin' or $pass == 'telkom135') {
                                $_SESSION['login'] = true;
                                $_SESSION['username'] = $user;
                            }
                            if ((isset($_SESSION['login'])) and ($_SESSION['login'] = true)) { ?>
                    <script type="text/javascript">
                        alert('Anda Berhasil login');
                        window.location.href = "index.php";
                    </script>";
                    <?php
                            }
                        }
                    } ?>
                    <div style="text-align:center">
                        <h4><b>SISTEM PENDUKUNG KEPUTUSAN TEKNISI CORPORATE SERVICE</b></h4>
                    </div>
                    <div class="separator">
                    </div>
                    <h4>Silahkan Login</h4>
                </div>

                <div class="clearfix"></div>
                <p></p>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <input type="text" class="form-control has-feedback-left" id="username" name="username" placeholder="Username" required="" autofocus="autofocus" />
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <input type="password" class="form-control has-feedback-left" id="password" name="password" class="form-control" placeholder="Password" required="" />
                    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div>
                    <button class="btn btn-primary btn-block" name="submit" id="tombollogin" type="submit" style="color:antiquewhite; background-color:red;">Login</button>
                </div>
                <div class="clearfix"></div>

                <div class="separator">

                    <div style="text-align:center; color:white;">
                        <p>© 2019 All Rights Reserved. SPK Teknisi Corporate Service</p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="assets/vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="assets/build/js/custom.min.js"></script>
</body>

</html>