<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SPK | Login</title>

    <!-- Bootstrap -->
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../assets/build/css/custom.min.css" rel="stylesheet">

</head>

<body class="login">
    <div class="login_wrapper">
        <div class="card-body">

            <form method="post" action="" class="form-horizontal form-label-left input_mask">
                <div class="" style="text-align:center; color:white; ">
                    <?php

                    include('../config/koneksi.php');
                    session_start();

                    if (isset($_POST['submit'])) {
                        $user = $_POST['username'];
                        $pass = $_POST['password'];

                        if ($user != 'admin' or $pass != 'telkom135') { ?>
                            <div class="alert alert-danger alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                <strong>Login Gagal!!!</strong> Username atau Password Salah
                            </div>
                            <?php
                                } else {
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
                    <div style="text-align:center; color:grey;">
                        <h4><b>SPK TEKNISI </b> CORPORATE SERVICE</h4>
                    </div>

                    <div class="separator"></div>
                    <div style="background:red; border:black; height: 70px;  color:white; padding:2%; width:90%; border-radius:3%; position: relative; margin-left:5%; 
                    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);">
                        <h5>Log On Application</h5>
                    </div>
                    <div style="background:white; border:grey; height: 250px; color:black; padding:2%; border-radius:3%; margin-top:-8%; box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);">
                        <div style="background:white; border:black; color:black; border-radius:2%; margin-top:20%">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="username" name="username" placeholder="Username" required="" autofocus="autofocus" />
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                <input type="password" class="form-control has-feedback-left" id="password" name="password" class="form-control" placeholder="Password" required="" />
                                <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            
                            <button class="btn btn-primary btn-block" name="submit" id="tombollogin" type="submit" style="color:antiquewhite; background-color:red; width:94%; margin-left:3%">Login</button>
                           
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
        </div>

        <div class="separator">

            <div style="text-align:center; color:grey;">
                <p>©2019 All Rights Reserved. SPK | Telkom Corporate Service</p>
            </div>
        </div>
        </form>
    </div>
    </div>

    <!-- sweetalert -->
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
    <!-- jQuery -->
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="../assets/vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../assets/build/js/custom.min.js"></script>
</body>

</html>