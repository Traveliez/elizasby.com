<?php
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }

    require 'include/fungsi.php'; 
    require 'include/header.php'; 

    $jumlahd = "SELECT COUNT(id_member) AS total_id FROM member "; //perintah untuk menjumlahkan
    $hasild = mysqli_query($conn, $jumlahd) ;//melakukan query dengan varibel $jumlahkan
    $td = mysqli_fetch_array($hasild); //menyimpan hasil query ke variabel $t
    $tid = $td['total_id'];

    $jumlahaff = "SELECT COUNT(aff) AS total_aff FROM member WHERE aff !='wb'"; //perintah untuk menjumlahkan
    $hasilaff = mysqli_query($conn, $jumlahaff) ;//melakukan query dengan varibel $jumlahkan
    $taff = mysqli_fetch_array($hasilaff); //menyimpan hasil query ke variabel $t
    $taf = $taff['total_aff'];

    $jumlahak = "SELECT COUNT(id) AS total_ak FROM validasi WHERE status = 2 "; //perintah untuk menjumlahkan
    $hasilak = mysqli_query($conn, $jumlahak) ;//melakukan query dengan varibel $jumlahkan
    $tak = mysqli_fetch_array($hasilak); //menyimpan hasil query ke variabel $t
    $ta = $tak['total_ak'];

    $jumlahd = "SELECT SUM(deposit) AS total_d FROM deposit WHERE status = 2 "; //perintah untuk menjumlahkan
    $hasild = mysqli_query($conn, $jumlahd) ;//melakukan query dengan varibel $jumlahkan
    $td = mysqli_fetch_array($hasild); //menyimpan hasil query ke variabel $t
    $gtd = $td['total_d'];     

    $fw = "firewoodfx";
    $jumlahdfw = "SELECT SUM(deposit) AS total_dfw FROM deposit WHERE broker = '".$fw."'"; //perintah untuk menjumlahkan
    $hasildfw = mysqli_query($conn, $jumlahdfw) ;//melakukan query dengan varibel $jumlahkan
    $tdfw = mysqli_fetch_array($hasildfw); //menyimpan hasil query ke variabel $t
    $gtdfw = $tdfw['total_dfw'];

    $jumlahwdfw = "SELECT SUM(withdrawal) AS total_wdfw FROM withdraw WHERE broker = '".$fw."'"; //perintah untuk menjumlahkan
    $hasilwdfw = mysqli_query($conn, $jumlahwdfw) ;//melakukan query dengan varibel $jumlahkan
    $twdfw = mysqli_fetch_array($hasilwdfw); //menyimpan hasil query ke variabel $t
    $gtwdfw = $twdfw['total_wdfw'];

    $if = "insta forex";
    $jumlahdif = "SELECT SUM(deposit) AS total_dif FROM deposit WHERE broker = '".$if."'"; //perintah untuk menjumlahkan
    $hasildif = mysqli_query($conn, $jumlahdif) ;//melakukan query dengan varibel $jumlahkan
    $tdif = mysqli_fetch_array($hasildif); //menyimpan hasil query ke variabel $t
    $gtdif = $tdif['total_dif'];

    $jumlahwdif = "SELECT SUM(withdrawal) AS total_wdif FROM withdraw WHERE broker = '".$if."'"; //perintah untuk menjumlahkan
    $hasilwdif = mysqli_query($conn, $jumlahwdif) ;//melakukan query dengan varibel $jumlahkan
    $twdif = mysqli_fetch_array($hasilwdif); //menyimpan hasil query ke variabel $t
    $gtwdif = $twdif['total_wdif'];

    $jumlahw = "SELECT SUM(withdrawal) AS total_w FROM withdraw WHERE status = 2 "; //perintah untuk menjumlahkan
    $hasilw = mysqli_query($conn, $jumlahw) ;//melakukan query dengan varibel $jumlahkan
    $tw = mysqli_fetch_array($hasilw); //menyimpan hasil query ke variabel $t
    $gtw = $tw['total_w'];

    $jumlahdrp = "SELECT SUM(total) AS total_drp FROM deposit WHERE status = 2 "; //perintah untuk menjumlahkan
    $hasildrp = mysqli_query($conn, $jumlahdrp) ;//melakukan query dengan varibel $jumlahkan
    $tdrp = mysqli_fetch_array($hasildrp); //menyimpan hasil query ke variabel $t
    $gtdrp = $tdrp['total_drp'];

    $jumlahwrp = "SELECT SUM(total) AS total_wrp FROM withdraw WHERE status = 2 "; //perintah untuk menjumlahkan
    $hasilwrp = mysqli_query($conn, $jumlahwrp) ;//melakukan query dengan varibel $jumlahkan
    $twrp = mysqli_fetch_array($hasilwrp); //menyimpan hasil query ke variabel $t
    $gtwrp = $twrp['total_wrp'];     

    $deposit = query("SELECT * FROM deposit ORDER BY id DESC LIMIT 5");
    $withdraw = query("SELECT * FROM withdraw ORDER BY id DESC LIMIT 5");
    $validasi = query("SELECT * FROM validasi ORDER BY id DESC LIMIT 5");

    $juhal = "dashboard";
?>

<body class="theme-blue">
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
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="number count-to"><h3><?= $tid  ?></h3></div>
                            <div class="text">Total Member</div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $tid  ?>" data-speed="15" data-fresh-interval="20"></div> -->

                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="number count-to"><h3><?= $taf  ?></h3></div>
                            <div class="text">Total Affiliasi</div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $taf  ?>" data-speed="15" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </div>
                    
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <div class="content">
                            <div class="number count-to"><h3><?= number_format($gtd,2)  ?></h3></div>
                            <div class="text">Total Deposit</div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $gtd ;  ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <div class="content">
                            <div class="number count-to"><h3><?= number_format($gtw,2)  ?></h3></div>
                            <div class="text">Total Withdrawal</div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $gtw  ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="number count-to"><h3><?= $ta  ?></h3></div>
                            <div class="text">Total Akun</div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $ta  ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>Validasi Akun</h2>
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
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. Akun</th>
                                            <th>Broker</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($validasi as $row ) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $row["no_akun"] ?></td>
                                            <?php
                                                
                                                if($row['broker'] == 'xm'){
                                                    $b = strtoupper($row['broker']);
                                                } elseif($row['broker'] == 'fbs'){
                                                    $b = strtoupper($row['broker']);
                                                } else{
                                                    $b = ucwords($row['broker']);
                                                }
                                            ?>    
                                            <td><?= $b ?></td>
                                            <?php
                                                
                                                if($row['status'] == '1'){
                                                    $s = "Proses";
                                                    $warna = "label bg-blue" ;

                                                } elseif ($row['status'] == '2'){
                                                    $s = "Sukses";
                                                    $warna = "label bg-green" ;

                                                } elseif ($row['status'] == '3'){
                                                    $s = "Gagal";
                                                    $warna = "label bg-red" ;
                                                }
                                            ?>
                                            <td><a href="validasi"><span class="<?= $warna  ?>"><?= $s  ?></span></a></td>
                                            
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->
            

                <!-- Deposit -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>Deposit</h2>
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
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. Akun</th>
                                            <th>Deposit</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($deposit as $row ) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $row["no_akun"] ?></td>
                                            <td>$<?= number_format($row["deposit"],2) ?></td>
                                            <?php
                                                
                                                    if($row['status'] == '1'){
                                                        $s = "Proses";
                                                        $warna = "label bg-blue" ;

                                                    } elseif ($row['status'] == '2'){
                                                        $s = "Sukses";
                                                        $warna = "label bg-green" ;

                                                    } elseif ($row['status'] == '3'){
                                                        $s = "Gagal";
                                                        $warna = "label bg-red" ;
                                                    }
                                                ?>
                                            <td><a href="deposit"><span class="<?= $warna  ?>"><?= $s  ?></span></a></td>
                                            
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- #END# Deposit -->

                <!-- Deposit -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>Withdrawal</h2>
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
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. Akun</th>
                                            <th>Withdrawal</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($withdraw as $row ) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $row["no_akun"] ?></td>
                                            <td>Rp. <?= number_format($row["total"]) ?></td>
                                            <?php
                                                
                                                    if($row['status'] == '1'){
                                                        $s = "Proses";
                                                        $warna = "label bg-blue" ;

                                                    } elseif ($row['status'] == '2'){
                                                        $s = "Sukses";
                                                        $warna = "label bg-green" ;

                                                    } elseif ($row['status'] == '3'){
                                                        $s = "Gagal";
                                                        $warna = "label bg-red" ;
                                                    } elseif ($row['status'] == '4'){
                                                        $s = "Confirm";
                                                        $warna = "label bg-amber" ;
                                                    }elseif ($row['status'] == '5'){
                                                        $s = "Confirmed";
                                                        $warna = "label bg-cyan" ;
                                                    }
                                                ?>
                                            <td><a href="withdrawal"><span class="<?= $warna  ?>"><?= $s  ?></span></a></td>
                                            
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- #END# Withdrawal -->

            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>
