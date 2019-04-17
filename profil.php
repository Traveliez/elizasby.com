<?php 
if (!isset($_GET["email"])) {
        header("location: member");
        exit;
    } 
session_start();
    if (!isset($_SESSION["username"])) {
        header("location: index");
        exit;
    }
require 'include/fungsi.php'; 
require 'include/header.php'; 

$idemail = $_GET["email"];

$member = query("SELECT * FROM member WHERE email_member = '$idemail' ")[0];
$profile = query("SELECT * FROM profile WHERE email = '$idemail' ")[0];
$validasi = query("SELECT * FROM validasi WHERE email = '$idemail' ORDER BY id DESC");
$juhal = "member";



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
            <div class="row clearfix">
                <!-- Deposit -->
                

                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>Profil Member <?= $member['username_member'] ?></h2>
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
                                        <label for="email_address_2">Email</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="broker" name="broker" class="form-control" readonly="" value="<?= $member['email_member'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Username</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="deposit" name="deposit" class="form-control" value="<?= $member['username_member'] ?>" readonly="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Link Affiliasi</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="http://warungbroker/reg.php?reg=<?= $member['username_member'] ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Nama</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="<?= $profile['nama'] ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Handphone</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="<?= $profile['hp'] ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Alamat</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="<?= $profile['alamat'] ?>" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->
            
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>Profil Member</h2>
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
                                        <label for="email_address_2">Deposit</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="broker" name="broker" class="form-control" readonly="" value=" ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Witdrawal</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="deposit" name="deposit" class="form-control" value=" " readonly="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Komisi</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value=" " readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Rebate</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Saku</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Bank</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" value="" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- #END# Validasi -->
                
                <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Akun Trading <?= $member['username_member'] ?>
                            </h2>
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
                                            <th>No</th>
                                            <th class="sorting_desc">Tgl</th>                                                
                                            <th>Email</th>
                                            <th>Nama</th>                                                
                                            <th>Broker</th>
                                            <th>No Akun</th>
                                            <th>Status</th>                                                
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th class="sorting_desc">Tgl</th>                                                
                                            <th>Email</th>
                                            <th>Nama</th>                                                
                                            <th>Broker</th>
                                            <th>No Akun</th>
                                            <th>Status</th>                                                
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($validasi as $row ) : ?> 
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
                                                    echo $ta.'/'.$bul.'/'.$tah.' <br> '.substr($row["jam"],0,5) 
                                                ?>
                                            </td>                                                
                                            <td><?= $row["email"] ?></td>
                                            <td><?= $row["nama"] ?></td>

                                            <?php if ($row["broker"]==="xm" OR $row["broker"]==="fbs") : ?>
                                            <td><?= strtoupper($row["broker"]) ?></td>
                                            <?php else: ?>
                                            <td><?= ucwords($row["broker"]) ?></td>
                                            <?php endif; ?>

                                            <td><?= $row["no_akun"] ?></td>
                                            <td>
                                                <?php
                                            $p = "<span class='label label-primary'>Proses</span>";
                                            $s = "<span class='label label-success'>Sukses</span>";
                                            $g = "<span class='label label-danger'>Gagal</span>";
                                                if($row['status'] == '1'){

                                                echo $p ;

                                                } elseif ($row['status'] == '2'){

                                                echo $s ;

                                                } elseif ($row['status'] == '3'){
                                                echo $g ;
                                                }
                                            ?>
                                            </td>
                                            <td class="actions">
                                                <a href="add/validasisukses.php?id=<?= $row["id"] ?>" >
                                                    <span class="badge bg-cyan"><i class="material-icons">done</i></span> 
                                                </a>
                                                <a href="add/validasiga.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin validasi gagal ?')){return true}else{return false}">
                                                    <span class="badge bg-orange"><i class="material-icons">close</i></span>
                                                </a>
                                                <a href="add/hapusvalidasi.php?id=<?= $row["id"] ?>" onClick="if(confirm('Apakah anda yakin menghapus validasi akun member ?')){return true}else{return false}">
                                                    <span class="badge bg-pink"><i class="material-icons">delete</i></span>
                                                </a>
                                            </td> 
                                        </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>    


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            </div>
            
        </div>
    </section>

        <!-- For Material Design Colors -->
            <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Kurs Broker</h4>
                        </div>
                        <form class="form-horizontal" action=""  method="post">
                        <div class="modal-body">
                                <input type="hidden" id="tang" name="tang" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('Y-m-d'); ?>" readonly="">
                                <input type="hidden" id="jam" name="jam" class="form-control" placeholder="" value="<?php date_default_timezone_set('Asia/Jakarta'); $date = new DateTime(); echo $date->format('H:i:s'); ?>" readonly="">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Broker</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                                                            
                                            <select class="form-control show-tick" name="broker" id="broker" required="">
                                                <option value="">-- Please Broker --</option>
                                                <?php foreach ($rate as $row ) : ?>
                                                    <?php if ($row["broker"]==="xm" OR $row["broker"]==="fbs") : ?>
                                                    <option ><?= "<b>" . strtoupper($row["broker"]) . " </b>" ?></option>
                                                    <?php else: ?>
                                                    <option ><?= "<b>" . ucwords($row["broker"]) . " </b>" ?></option>
                                                    <?php endif; ?> 
                                                
                                                <?php endforeach; ?>    
                                            </select>
                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Deposit</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="deposit" name="deposit" class="form-control" placeholder="Rate Deposit" onkeypress="return hanyaAngka(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Withdrawal</label>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="withdrawal" name="withdrawal" class="form-control" placeholder="Rate Withdrawal" onkeypress="return hanyaAngka(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect" name="updaterate">UPDATE KURS</button>
                           <!--  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button> -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php require 'include/scripts.php'; ?>