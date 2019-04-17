<?php
session_start();
    if (isset($_SESSION["username"])) {
        header("location: dashboard");
        exit;
    }
require 'include/fungsi.php';


    //cek apakah tombol submit sudah di tekan atau belum
if( isset($_POST["login"]) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $ceklogin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' ");

        
    //cek password
    if( mysqli_num_rows($ceklogin) === 1 ) {
        
        //$_SESSION['email'] = $email;
        //cek password
        $row = mysqli_fetch_assoc($ceklogin);
        if (password_verify ($password, $row["password"])) {
            $_SESSION['username'] = $username;

            // //cek remember me
            // if (isset($_POST['remember']) ) {
            //  //buat cookie
            //  setcookie('email','true', time()+360);

            // }

            header("location: dashboard");
            exit;
        }
    }
    
    $error = true;
    
} 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Rebate (Cashback) Forex | WarungBroker.Com | IB Lintas Broker</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Warung<b>Broker</b></a>
            <small>Rebate (Cashback) Forex |IB Lintas Broker</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="post" action="">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                     <?php if(isset($error)) :?>
                      <p style="color:red; font-style: italic">username / password salah</p>
                      <?php endif; ?>
                    <div class="row">
                       <!--  <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div> -->
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" name="login" >SIGN IN</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>