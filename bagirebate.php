<?php
if (!isset($_GET["id"])) {
        header("location: rebate");
        exit;
    } 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php';
    require 'include/header.php';
    $validasi = query("SELECT * FROM validasi WHERE status=2 ORDER BY id DESC");
    $juhal = "transaksi";

$idd = $_GET["id"];

$r = query("SELECT * FROM validasi WHERE id = $idd") [0];
$kodemember = $r['kode_member'];
$kodeemail = $r['email'];
$kodenama = $r['nama'];
$kodeaff = $r['aff'];
$kodebroker = $r['broker'];
$kodeakun = $r['no_akun'];



$member = query("SELECT * FROM member WHERE kode_member='$kodemember' AND email_member = '$kodeemail'") [0];


//cek apakah tombol submit sudah di tekan atau belum
if( isset($_POST["bagirebate"]) ) {
    $tangg = ($_POST["tang"]);
    $tang = date('Y-m-d',strtotime($tangg));
    $jam = ($_POST["jam"]);
    //$tanggal = htmlspecialchars($_POST["tanggal"]);
    $email = $kodeemail;
    $nama = htmlspecialchars($_POST["nama"]);
    $noakun = htmlspecialchars($_POST["noakun"]);
    $broker = strtolower(stripcslashes($_POST["broker"]));
    $affi = htmlspecialchars($_POST["aff"]);
    $rebat = htmlspecialchars($_POST["jumlahrebate"]);

    if ($affi==="wb") {
        $rebates = ($rebat*80)/100;
        $kom = 0;
        $rwb = ($rebat*20)/100;
    }elseif ($affi==="efifxpro"){
        $rebates = ($rebat*30)/100;
        $kom = 0;
        $rwb = ($rebat*70)/100;
    }else{
        $rebates = ($rebat*80)/100;
        $kom = ($rebat*10)/100;
        $rwb = ($rebat*10)/100;
    }

    

    $rate = query("SELECT * FROM rate WHERE broker = '$broker' ")[0];
    $dollar = $rate['withdrawal'];

    $rebatewb = $rwb*$dollar;
    $rebaterp = $rebates*$dollar;
    $rebatdollar = $rebates;
    $komisirp = $kom*$dollar;
    
    
    //query isi rebate
    $querybr = "INSERT INTO bagirebate 
                VALUES 
                ('','$email','$rebat','$affi','$kom','$komisirp','$nama','$noakun','$broker','$tang','$jam','$rebatdollar','$rebaterp','$rebatewb')
            ";
    mysqli_query($conn, $querybr);

    if ($affi==="wb") {
        
    }elseif ($affi==="efifxpro") {
        
    }else{
        $km = query("SELECT * FROM member WHERE id_aff='$kodeaff' ") [0];
        $kkodemember = $km['kode_member'];
        $kkodeemail = $km['email_member'];
        $ko = query("SELECT * FROM komisi WHERE kode_member='$kkodemember' AND email = '$kkodeemail' ORDER BY id DESC LIMIT 1")[0];

        $sk = $ko['saldo'];
        $saldok = $sk+$komisirp;
        
        //query isi rebate
        $queryk = "INSERT INTO komisi
                    VALUES 
                    ('','$kkodemember','$kkodeemail','$tang','$jam','komisi','$noakun','$komisirp','0','$saldok')
                ";
        mysqli_query($conn, $queryk);
    }



    $rb = query("SELECT * FROM rebate WHERE kode_member='$kodemember' AND email = '$kodeemail' ORDER BY id DESC LIMIT 1")[0];
    $srb = $rb['saldo'];
    $saldo = $srb+$rebaterp;
    
    //query isi rebate
    $queryr = "INSERT INTO rebate
                VALUES 
                ('','$kodemember','$email','$tang','$jam','rebate','$noakun','$rebates','$rebaterp','0','$saldo')
            ";
    mysqli_query($conn, $queryr);

        

        
    //cek apakh data berhasil di tambahkan
    if( mysqli_affected_rows($conn) > 0 ) {
        echo "
            <script>
                alert('rebate berhasil di masukkan'); 
                document.location.href = 'rebate';
            </script>            
            ";

    } else {
        echo "
            <script>
                alert('rebate gagal di masukkan');                
                document.location.href = 'rebate';                
            </script>
            ";
    }

}
?>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

    <?php require 'include/topbar.php'; ?>
    
    <section>
        <?php require 'include/leftbar.php'; ?>
        <?php require 'include/rightbar.php'; ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- Exportable Table -->
                <div class="row clearfix">
                    <!-- Task Info -->
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header">
                                <h2>Bagi Rebate Member</h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:void(0);">Action</a></li>
                                            <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal" action=""  method="post">
                                    <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                                    <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="email_address_2">Nama :</label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?= $kodenama  ?>" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password_2">No. Akun :</label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="noakun" name="noakun" class="form-control" value="<?= $kodeakun  ?>" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password_2">Broker :</label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="broker" name="broker" class="form-control" value="<?= $kodebroker  ?>" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password_2">UpLine :</label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="aff" name="aff" class="form-control" value="<?= $kodeaff  ?>" readonly="" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password_2">Rebate $ :</label>
                                        </div>
                                        <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="jumlahrebate" name="jumlahrebate" class="form-control" placeholder="Jumlah Rebate" required="" onkeypress="return hanyaAngka(event)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" name="bagirebate" class="btn btn-primary m-t-15 waves-effect" onClick="if(confirm('Periksa lagi apakah jumlah rebate sudah benar')){return true}else{return false}">Bagi Rebate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- #END# Validasi -->
                </div>
            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>