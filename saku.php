<?php
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php'; 
    require 'include/header.php';
    $juhal = "member" ;

    $jumlahik = "SELECT SUM(input) AS total_ik FROM komisi "; //perintah untuk menjumlahkan
    $hasilik = mysqli_query($conn, $jumlahik) ;//melakukan query dengan varibel $jumlahkan
    $ik = mysqli_fetch_array($hasilik); //menyimpan hasil query ke variabel $t
    $totalik = $ik['total_ik'];

    $jumlahok = "SELECT SUM(output) AS total_ok FROM komisi "; //perintah untuk menjumlahkan
    $hasilok = mysqli_query($conn, $jumlahok) ;//melakukan query dengan varibel $jumlahkan
    $ok = mysqli_fetch_array($hasilok); //menyimpan hasil query ke variabel $t
    $totalok = $ok['total_ok'];     

    $totalkomisi=(int)$totalik-$totalok;

    $jumlahir = "SELECT SUM(input) AS total_ir FROM rebate "; //perintah untuk menjumlahkan
    $hasilir = mysqli_query($conn, $jumlahir) ;//melakukan query dengan varibel $jumlahkan
    $ir = mysqli_fetch_array($hasilir); //menyimpan hasil query ke variabel $t
    $totalir = $ir['total_ir'];

    $jumlahor = "SELECT SUM(output) AS total_or FROM rebate "; //perintah untuk menjumlahkan
    $hasilor = mysqli_query($conn, $jumlahor) ;//melakukan query dengan varibel $jumlahkan
    $or = mysqli_fetch_array($hasilor); //menyimpan hasil query ke variabel $t
    $totalor = $or['total_or'];     

    $totalrebate=(int)$totalir-$totalor;
    
    $jumlahis = "SELECT SUM(input) AS total_is FROM saku "; //perintah untuk menjumlahkan
    $hasilis = mysqli_query($conn, $jumlahis) ;//melakukan query dengan varibel $jumlahkan
    $is = mysqli_fetch_array($hasilis); //menyimpan hasil query ke variabel $t
    $totalis = $is['total_is'];

    $jumlahos = "SELECT SUM(output) AS total_os FROM saku "; //perintah untuk menjumlahkan
    $hasilos = mysqli_query($conn, $jumlahos) ;//melakukan query dengan varibel $jumlahkan
    $os = mysqli_fetch_array($hasilos); //menyimpan hasil query ke variabel $t
    $totalos = $os['total_os'];     

    $totalsaku=(int)$totalis-$totalos;

    $komisi = query("SELECT * FROM komisi WHERE keterangan!='registrasi' ORDER BY id DESC ");
    $rebate = query("SELECT * FROM rebate WHERE keterangan!='registrasi' ORDER BY id DESC ");
    $saku = query("SELECT * FROM saku WHERE keterangan!='registrasi' ORDER BY id DESC ");
    
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
                <h2>SAKU MEMBER</h2>

            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <img src="images/rp.png" width="48" height="80" alt="rp" />
                            <!-- <i class="material-icons">playlist_add_check</i> -->
                        </div>
                        <div class="content">

                            <div class="text">Komisi Member</div>
                            <div class="number count-to" ><?= number_format($totalkomisi)  ?></div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $totalkomisi  ?>" data-speed="15" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <img src="images/rp.png" width="48" height="80" alt="rp" />
                            <!-- <i class="material-icons">help</i> -->
                        </div>
                        <div class="content">
                            <div class="text">Rebate Member</div>
                            <div class="number count-to" ><?= number_format($totalrebate)  ?></div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $totalrebate  ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <img src="images/rp.png" width="48" height="80" alt="rp" />
                            <!-- <i class="material-icons">forum</i> -->
                        </div>
                        <div class="content">
                            <div class="text">Saku Member</div>
                            <div class="number count-to" ><?= number_format($totalsaku)  ?></div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?= $totalsaku  ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">  
                            <img src="images/rp.png" width="48" height="80" alt="rp" />
                            <!-- <i class="material-icons">person_add</i> -->
                        </div>
                        <div class="content">
                            <div class="text">Total Kas Member</div>
                            <div class="number count-to" ><?= number_format($totalkomisi+$totalrebate+$totalsaku)  ?></div>
                            <!-- <div class="number count-to" data-from="0" data-to="<?php //$totalkomisi+$totalrebate+$totalsaku  ?>" data-speed="1000" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            
            

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Transaksi Rebate</h2>
                            <!-- <ul class="header-dropdown m-r--5">
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
                            </ul> -->
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Email</th>
                                            <th>Keterangan</th>
                                            <th>No Akun</th>
                                            <th>Input</th>
                                            <th>Output</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($komisi as $row ) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td>
                                                <?php 
                                                    $t = $row['tang'];
                                                    $ta = substr($t,8,2);
                                                    $bu = substr($t,5,2);
                                                    $tah = substr($t,0,4);
                                                    if ($bu === '01' ) {
                                                        $bul = "Jan";
                                                    }elseif ($bu === '02' ) {
                                                        $bul = "Feb";
                                                    }elseif ($bu === '03' ) {
                                                        $bul = "Maret";
                                                    }elseif ($bu === '04' ) {
                                                        $bul = "April"; 
                                                    }elseif ($bu === '05' ) {
                                                        $bul = "Mei";
                                                    }elseif ($bu === '06' ) {
                                                        $bul = "Juni";
                                                    }elseif ($bu === '07' ) {
                                                        $bul = "Juli";
                                                    }elseif ($bu === '08' ) {
                                                        $bul = "Agust";
                                                    }elseif ($bu === '09' ) {
                                                        $bul = "Sept";
                                                    }elseif ($bu === '10' ) {
                                                        $bul = "Okt";
                                                    }elseif ($bu === '11' ) {
                                                        $bul = "Nov";
                                                    }else{
                                                        $bul = "Des";
                                                    }
                                                    echo $ta.'/'.$bul.'/'.$tah.' || '.substr($row["jam"],0,5) 
                                                ?>
                                            </td>                       
                                            <td><?= $row["email"] ?></td>
                                            <td><?= $row["keterangan"] ?></td>
                                            <td><?= $row["no_akun"] ?></td>
                                            <td>Rp. <?= number_format($row["input"]) ?></td>
                                            <td>Rp. <?= number_format($row["output"]) ?></td>
                                            <td>Rp. <?= number_format($row["saldo"]) ?></td>
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->
            

                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Transaksi Rebate</h2>
                            <!-- <ul class="header-dropdown m-r--5">
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
                            </ul> -->
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Email</th>
                                            <th>Keterangan</th>
                                            <th>No Akun</th>
                                            <th>Input</th>
                                            <th>Output</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rebate as $row ) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td>
                                                <?php 
                                                    $t = $row['tang'];
                                                    $ta = substr($t,8,2);
                                                    $bu = substr($t,5,2);
                                                    $tah = substr($t,0,4);
                                                    if ($bu === '01' ) {
                                                        $bul = "Jan";
                                                    }elseif ($bu === '02' ) {
                                                        $bul = "Feb";
                                                    }elseif ($bu === '03' ) {
                                                        $bul = "Maret";
                                                    }elseif ($bu === '04' ) {
                                                        $bul = "April"; 
                                                    }elseif ($bu === '05' ) {
                                                        $bul = "Mei";
                                                    }elseif ($bu === '06' ) {
                                                        $bul = "Juni";
                                                    }elseif ($bu === '07' ) {
                                                        $bul = "Juli";
                                                    }elseif ($bu === '08' ) {
                                                        $bul = "Agust";
                                                    }elseif ($bu === '09' ) {
                                                        $bul = "Sept";
                                                    }elseif ($bu === '10' ) {
                                                        $bul = "Okt";
                                                    }elseif ($bu === '11' ) {
                                                        $bul = "Nov";
                                                    }else{
                                                        $bul = "Des";
                                                    }
                                                    echo $ta.'/'.$bul.'/'.$tah.' || '.substr($row["jam"],0,5) 
                                                ?>
                                            </td>                       
                                            <td><?= $row["email"] ?></td>
                                            <td><?= $row["keterangan"] ?></td>
                                            <td><?= $row["no_akun"] ?></td>
                                            <td>Rp. <?= number_format($row["input"]) ?></td>
                                            <td>Rp. <?= number_format($row["output"]) ?></td>
                                            <td>Rp. <?= number_format($row["saldo"]) ?></td>
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->

                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Transaksi Saku</h2>
                            <ul class="header-dropdown m-r--5">
                                <!-- <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Email</th>
                                            <th>Keterangan</th>
                                            <th>Kode Saku</th>
                                            <th>Input</th>
                                            <th>Output</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($saku as $row ) : ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td>
                                                <?php 
                                                    $t = $row['tanggal'];
                                                    $ta = substr($t,8,2);
                                                    $bu = substr($t,5,2);
                                                    $tah = substr($t,0,4);
                                                    if ($bu === '01' ) {
                                                        $bul = "Jan";
                                                    }elseif ($bu === '02' ) {
                                                        $bul = "Feb";
                                                    }elseif ($bu === '03' ) {
                                                        $bul = "Maret";
                                                    }elseif ($bu === '04' ) {
                                                        $bul = "April"; 
                                                    }elseif ($bu === '05' ) {
                                                        $bul = "Mei";
                                                    }elseif ($bu === '06' ) {
                                                        $bul = "Juni";
                                                    }elseif ($bu === '07' ) {
                                                        $bul = "Juli";
                                                    }elseif ($bu === '08' ) {
                                                        $bul = "Agust";
                                                    }elseif ($bu === '09' ) {
                                                        $bul = "Sept";
                                                    }elseif ($bu === '10' ) {
                                                        $bul = "Okt";
                                                    }elseif ($bu === '11' ) {
                                                        $bul = "Nov";
                                                    }else{
                                                        $bul = "Des";
                                                    }
                                                    echo $ta.'/'.$bul.'/'.$tah.' || '.substr($row["jam"],0,5) 
                                                ?>
                                            </td>                       
                                            <td><?= $row["email"] ?></td>
                                            <td><?= $row["keterangan"] ?></td>
                                            <td><?= $row["kodesaku"] ?></td>
                                            <td>Rp. <?= number_format($row["input"]) ?></td>
                                            <td>Rp. <?= number_format($row["output"]) ?></td>
                                            <td>Rp. <?= number_format($row["saldo"]) ?></td>
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->

            </div>
        </div>
    </section>

    <?php require 'include/scripts.php'; ?>
