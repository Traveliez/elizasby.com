<?php
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
    require 'include/fungsi.php'; 
    require 'include/header.php';
    $juhal = "laporan"; 
    
    $laporan = query("SELECT * FROM laporan ORDER BY id DESC ");
    
    if( isset($_POST["tampilrebate"]) ) {
        $start = htmlspecialchars($_POST["tanggalawal"]);
        $end = htmlspecialchars($_POST["tanggalakhir"]);
        
        $t = $start;
        $ta = substr($t,0,2);
        $bu = substr($t,3,2);
        $tah = substr($t,6,4);
        $mulai = $tah.'-'.$bu.'-'.$ta;

        $te = $end;
        $tae = substr($te,0,2);
        $bue = substr($te,3,2);
        $tahe = substr($te,6,4);
        $sampai = $tahe.'-'.$bue.'-'.$tae;
        
        $rebate = query("SELECT * FROM bagirebate  WHERE tang between '$mulai' AND '$sampai' ORDER BY id DESC");

        $jumlahr = "SELECT SUM(rebatewb) AS total_r FROM bagirebate WHERE tang between '$mulai' AND '$sampai'"; //perintah untuk menjumlahkan
        $hasilr = mysqli_query($conn, $jumlahr) ;//melakukan query dengan varibel $jumlahkan
        $rebt = mysqli_fetch_array($hasilr); //menyimpan hasil query ke variabel $t
        $rebate = $rebt['total_r'];

        $laporan = query("SELECT * FROM laporan WHERE keterangan='rebate' ORDER BY id DESC ");
        
    }

    if (isset($_POST["masukkanlaporan"])) {
        $tangg = ($_POST["tang"]);
        $tang = date('Y-m-d',strtotime($tangg));
        $jam = ($_POST["jam"]);

        $jrebate = ($_POST["jrebate"]);
        $l = query("SELECT * FROM laporan ORDER BY id DESC LIMIT 1")[0];
        $sl = $l['saldo'];
        $saldo = (int)$sl+$jrebate;

        $laporan = query("SELECT * FROM laporan WHERE keterangan='rebate' ORDER BY id DESC ");

        //query isi rebate
        $queryl = "INSERT INTO laporan
                    VALUES 
                    ('','$tang','$jam','rebate','$jrebate','0','$saldo')
                ";
        mysqli_query($conn, $queryl);

        //cek apakh data berhasil di tambahkan
        if( mysqli_affected_rows($conn) > 0 ) {
            echo "
                <script>
                    alert('Laporan Rebate di masukkan'); 
                    document.location.href = 'laporanrebate';
                </script>            
                ";

        } else {
            echo "
                <script>
                    alert('Laporan Rebate di masukkan');                
                    document.location.href = 'laporanrebate';                
                </script>
                ";
        }
    }
    
    if (isset($_POST["masuk"])) {
        $tangg = ($_POST["tang"]);
        $tang = date('Y-m-d',strtotime($tangg));
        $jam = ($_POST["jam"]);

        $keterangan = htmlspecialchars(($_POST["tmasuk"]));
        $jmasuk = htmlspecialchars(($_POST["jmasuk"]));
        $l = query("SELECT * FROM laporan ORDER BY id DESC LIMIT 1")[0];
        $sl = $l['saldo'];
        $saldo = (int)$sl+$jmasuk;


        //query isi rebate
        $queryl = "INSERT INTO laporan
                    VALUES 
                    ('','$tang','$jam','$keterangan','$jmasuk','0','$saldo')
                ";
        mysqli_query($conn, $queryl);

        //cek apakh data berhasil di tambahkan
        if( mysqli_affected_rows($conn) > 0 ) {
            echo "
                <script>
                    alert('Input data pemasukkan berhasil'); 
                    document.location.href = 'laporanrebate';
                </script>            
                ";

        } else {
            echo "
                <script>
                    alert('Input data pemasukkan gagal');                
                    document.location.href = 'laporanrebate';                
                </script>
                ";
        }
    }

    if (isset($_POST["keluar"])) {
        $tangg = ($_POST["tang"]);
        $tang = date('Y-m-d',strtotime($tangg));
        $jam = ($_POST["jam"]);

        $keterangan = htmlspecialchars(($_POST["tkeluar"]));
        $jkeluar = htmlspecialchars(($_POST["jkeluar"]));
        $l = query("SELECT * FROM laporan ORDER BY id DESC LIMIT 1")[0];
        $sl = $l['saldo'];
        $saldo = (int)$sl-$jkeluar;


        //query isi rebate
        $queryl = "INSERT INTO laporan
                    VALUES 
                    ('','$tang','$jam','$keterangan','0','$jkeluar','$saldo')
                ";
        mysqli_query($conn, $queryl);

        //cek apakh data berhasil di tambahkan
        if( mysqli_affected_rows($conn) > 0 ) {
            echo "
                <script>
                    alert('Input data pengeluaran berhasil'); 
                    document.location.href = 'laporanrebate';
                </script>            
                ";

        } else {
            echo "
                <script>
                    alert('Input data pengeluaran gagal');                
                    document.location.href = 'laporanrebate';                
                </script>
                ";
        }
    }
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
                <h2>LAPORAN REBATE</h2>

            </div>

            

            <!-- Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="demo-masked-input">
                                <form  action=""  method="post">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <b>Tanggal Awal</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" placeholder="dd/mm/yyyy" id="tanggalawal" name="tanggalawal" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <b>Tanggal Akhir</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" placeholder="dd/mm/yyyy" id="tanggalakhir" name="tanggalakhir" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        
                                        <div class="input-group">
                                            
                                            <div class="form-line">
                                                <button type="submit" name="tampilrebate" class="btn bg-cyan btn-block btn-sm waves-effect">Tampilkan Rebate</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <?php if( isset($_POST["tampilrebate"]) ) : ?>
                            <form  action=""  method="post">
                            <div class="row clearfix">
                                <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                                <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                                <input type="hidden" class="form-control date" value="<?= $rebate ?>" id="jrebate" name="jrebate" readonly="">
                                <div class="col-md-3">
                                    <b>Tanggal Awal</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" value="<?= $start  ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <b>Tanggal Akhir</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" value="<?= $end  ?>"  readonly="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <b>Pendapatan Rebate</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" value="Rp. <?= number_format($rebate)  ?>" readonly="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    
                                    <div class="input-group">
                                        
                                        <div class="form-line">
                                            <button type="submit" name="masukkanlaporan" class="btn bg-cyan btn-block btn-sm waves-effect">Masukkan Laporan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <?php endif ; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Select -->

                <!-- Task Info -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Transaksi Laporan Warung Broker</h2>

                            <ul class="header-dropdown m-r--5">
                                <button type="button" class="btn bg-blue waves-effect" data-toggle="modal" data-target="#pemasukan">Pemasukan</button>
                                <button type="button" class="btn bg-red waves-effect" data-toggle="modal" data-target="#pengeluaran">Pengeluaran</button>
                                <li class="dropdown">

                                    <!-- <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul> -->
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Pemasukan</th>
                                            <th>Pengeluaran</th>
                                            <th>Saldo</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($laporan as $row ) : ?>
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
                                                    echo $ta.'/'.$bul.'/'.$tah
                                                ?>
                                            </td>                       
                                            <td><?= ucwords($row["keterangan"]) ?></td>
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
    <!-- Small Size -->
    <div class="modal fade" id="pemasukan" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post" class="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="smallModalLabel">Transaksi Pemasukan</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                        <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                        
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="password_2">Keterangan</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="tmasuk" name="tmasuk" class="form-control" placeholder="Transaksi">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="password_2">Jumlah</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="jmasuk" name="jmasuk" class="form-control" placeholder="Rupiah">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-blue waves-effect" name="masuk">Submit</button>
                    <!-- <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Small Size -->
    <div class="modal fade" id="pengeluaran" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post" class="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="smallModalLabel">Transaksi Pengeluaran</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                        <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                        
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="password_2">Keterangan</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="tkeluar" name="tkeluar" class="form-control" placeholder="Transaksi">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="password_2">Jumlah</label>
                            </div>
                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="jkeluar" name="jkeluar" class="form-control" placeholder="Rupiah">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-red waves-effect" name="keluar">Submit</button>
                    <!-- <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php require 'include/scripts.php'; ?>
